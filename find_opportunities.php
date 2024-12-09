<?php

require_once 'functions.php'; // Include the functions.php file to ensure db_connect is available

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

//Set ID from session
$volunteer_id = $_SESSION['user_id'];

// Ensure user is logged in as a volunteer
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'volunteer') {
    die("Access denied. You must be logged in as a volunteer.");
}

// Connect to the database
$dblink = db_connect("volunteerhub");
if (!$dblink) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Handle signup and unregister logic
if (($_SERVER['REQUEST_METHOD'] === 'POST') && isset($_REQUEST['opportunity_id'], $_REQUEST['action'])) {
    $opportunity_id = (int)$_REQUEST['opportunity_id'];
    $action = $_REQUEST['action'];

    if ($action === 'signup') {
        // Check if the user is already signed up for the opportunity
        $sql_check_signup = "SELECT * FROM volunteer_signup WHERE opportunity_id = ? AND volunteer_id = ?";
        $stmt_check_signup = $dblink->prepare($sql_check_signup);
        if (!$stmt_check_signup) {
            die("Signup check query preparation failed: " . $dblink->error);
        }
        $stmt_check_signup->bind_param("ii", $opportunity_id, $volunteer_id);
        $stmt_check_signup->execute();
        $result_check_signup = $stmt_check_signup->get_result();
        if ($result_check_signup->num_rows > 0) {
            echo "<p style='color: red;'>You are already signed up for this opportunity.</p>";
            echo "<script type='text/javascript'>setTimeout(function() { window.location.href = 'index.php?page=find_opportunities'; }, 2000);</script>";
            exit;
        }

        // Check if the opportunity exists and is not full
        $sql = "
            SELECT o.needed_volunteers, COUNT(vs.id) AS signed_up_count
            FROM opportunities o
            LEFT JOIN volunteer_signup vs ON o.id = vs.opportunity_id
            WHERE o.id = ?
            GROUP BY o.id;
        ";
        $stmt = $dblink->prepare($sql);
        if (!$stmt) {
            die("Query preparation failed: " . $dblink->error);
        }
        $stmt->bind_param("i", $opportunity_id);
        if (!$stmt->execute()) {
            die("Query execution failed: " . $stmt->error);
        }
        $result = $stmt->get_result();
        if (!$result) {
            die("Error fetching opportunity: " . $stmt->error);
        }
		
		//Opportunity logic
        if ($result->num_rows === 0) {
            echo "<p style='color: red;'>Opportunity not found.</p>";
        } else {
            $row = $result->fetch_assoc();
            if ($row['signed_up_count'] >= $row['needed_volunteers']) {
                echo "<p style='color: red;'>The opportunity is full. Cannot sign up.</p>";
            } else {
                $sql_signup = "INSERT INTO volunteer_signup (opportunity_id, volunteer_id) VALUES (?, ?)";
                $stmt_signup = $dblink->prepare($sql_signup);
                if (!$stmt_signup) {
                    die("Signup query preparation failed: " . $dblink->error);
                }
                $stmt_signup->bind_param("ii", $opportunity_id, $volunteer_id);
                if (!$stmt_signup->execute()) {
                    die("Signup query execution failed: " . $stmt_signup->error);
                }
                echo "<h1 class='centered-text' style='color: green;'>Successfully signed up for opportunity.</h1>";
            }
        }
		//Timeout script for success message
        echo "<script type='text/javascript'>setTimeout(function() { window.location.href = 'index.php?page=find_opportunities'; }, 2000);</script>";
        exit;
    } elseif ($action === 'unregister') {
        // Check if the record exists before deleting
        $sql_check = "SELECT * FROM volunteer_signup WHERE opportunity_id = ? AND volunteer_id = ?";
        $stmt_check = $dblink->prepare($sql_check);
        if (!$stmt_check) {
            die("Check query preparation failed: " . $dblink->error);
        }
        $stmt_check->bind_param("ii", $opportunity_id, $volunteer_id);
        if (!$stmt_check->execute()) {
            die("Check query execution failed: " . $stmt_check->error);
        }
        $result_check = $stmt_check->get_result();
        if ($result_check->num_rows === 0) {
            echo "<p style='color: red;'>No matching record found to unregister.</p>";
        } else {
            $sql = "DELETE FROM volunteer_signup WHERE opportunity_id = ? AND volunteer_id = ?";
            $stmt = $dblink->prepare($sql);
            if (!$stmt) {
                die("Unregister query preparation failed: " . $dblink->error);
            }
            $stmt->bind_param("ii", $opportunity_id, $volunteer_id);
            if (!$stmt->execute()) {
                die("Unregister query execution failed: " . $stmt->error);
            } else {
                echo "<h1 style='color: red;'>Successfully unregistered from opportunity.</h1>";
            }
        }
        echo "<script type='text/javascript'>setTimeout(function() { window.location.href = 'index.php?page=find_opportunities'; }, 2000);</script>";
        exit;
    } else {
        echo "<p style='color: red;'>Invalid action specified.</p>";
    }
} 

// Fetch and display opportunities with current sign-up count and check if the user is signed up
$sql = "
    SELECT o.id, o.title, o.description, o.needed_volunteers, COUNT(vs.id) AS signed_up_count, 
           o.datetime_start, o.datetime_end, u.company_name, o.location,
           EXISTS(SELECT 1 FROM volunteer_signup vs2 WHERE vs2.opportunity_id = o.id AND vs2.volunteer_id = ?) AS is_signed_up
    FROM opportunities o
    LEFT JOIN volunteer_signup vs ON o.id = vs.opportunity_id
    LEFT JOIN users u ON o.organizer_id = u.id
    GROUP BY o.id
";
$stmt = $dblink->prepare($sql);
if (!$stmt) {
    die("Query preparation failed: " . $dblink->error);
}
$stmt->bind_param("i", $volunteer_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<h2 class="centered-text">Available Opportunities</h2>
<table border="1">
    <thead>
        <tr>
            <th>Opportunity ID</th>
            <th>Organizer Name</th>
            <th>Title</th>
            <th>Description</th>
			<th>Location</th>
            <th>Start Time / End Time</th>
            <th>Signed Up / Needed Volunteers</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($result && $result->num_rows > 0): ?>
		<?php while ($row = $result->fetch_assoc()): ?>
			<tr>
				<td><?php echo ($row['id']); ?></td>
				<td><?php echo ($row['company_name']); ?></td>
				<td><?php echo ($row['title']); ?></td>
				<td><?php echo ($row['description']); ?></td>
				<td><?php echo ($row['location']); ?></td>
				<td>
					<?php
					// Parse the datetime strings and format them
					$datetime_start = DateTime::createFromFormat('Y-m-d H:i:s', $row['datetime_start']);
					$datetime_end = DateTime::createFromFormat('Y-m-d H:i:s', $row['datetime_end']);

					if ($datetime_start && $datetime_end) {
						// Format the datetime into a readable format
						echo $datetime_start->format('M d, Y h:i A') . " - " . $datetime_end->format('h:i A');
					} else {
						echo "Invalid date format"; // Fallback in case of unexpected datetime input
					}
					?>
				</td>
				<td><?php echo ($row['signed_up_count'] . " / " . $row['needed_volunteers']); ?></td>
				<td>
					<?php if ($row['is_signed_up']): ?>
						<form class="opportunity-form" method="POST" action="find_opportunities.php">
							<input type="hidden" name="opportunity_id" value="<?php echo $row['id']; ?>">
							<input type="hidden" name="action" value="unregister">
							<button type="submit">Unregister</button>
						</form>
					<?php else: ?>
						<form class="opportunity-form" method="POST" action="find_opportunities.php">
							<input type="hidden" name="opportunity_id" value="<?php echo $row['id']; ?>">
							<input type="hidden" name="action" value="signup">
							<button type="submit">Sign Up</button>
						</form>
					<?php endif; ?>
				</td>
			</tr>
		<?php endwhile; ?>
	<?php else: ?>
		<tr><td colspan="7">No opportunities available</td></tr>
	<?php endif; ?>
    </tbody>
</table>





