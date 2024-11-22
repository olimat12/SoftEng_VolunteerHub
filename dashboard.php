<?php

require_once 'functions.php'; // Include the functions.php file to ensure db_connect is available

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$user_type = $_SESSION['user_type'];
$user_id = $_SESSION['user_id'];

// Ensure user is logged in
if (!isset($user_type)) {
    die("Access denied. You must be logged in.");
}

// Connect to the database
$dblink = db_connect("volunteerhub");
if (!$dblink) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Handle delete opportunity logic for organizers
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['opportunity_id'], $_POST['action']) && $_POST['action'] === 'delete') {
    $opportunity_id = (int)$_POST['opportunity_id'];
    if ($user_type === 'organizer') {
        // Delete the opportunity
        $sql_delete = "DELETE FROM opportunities WHERE id = ? AND organizer_id = ?";
        $stmt_delete = $dblink->prepare($sql_delete);
        if (!$stmt_delete) {
            die("Delete query preparation failed: " . $dblink->error);
        }
        $stmt_delete->bind_param("ii", $opportunity_id, $user_id);
        if (!$stmt_delete->execute()) {
            die("Delete query execution failed: " . $stmt_delete->error);
        } else {
            echo "<p style='color: green;'>Successfully deleted opportunity.</p>";
        }
    }
}
?>

<?php
// Fetch company name if the user is an organizer
$company_name = '';
if ($user_type === 'organizer') {
    $company_sql = "SELECT company_name FROM users WHERE id = ?";
    $company_stmt = $dblink->prepare($company_sql);
    if ($company_stmt) {
        $company_stmt->bind_param("i", $user_id);
        $company_stmt->execute();
        $company_result = $company_stmt->get_result();
        if ($company_result && $company_result->num_rows > 0) {
            $company_row = $company_result->fetch_assoc();
            $company_name = $company_row['company_name'];
        }
    }
}
?>

<h2 class="centered-text">Dashboard <?php echo $company_name ? "- " . htmlspecialchars($company_name) : ""; ?></h2>

<?php if ($user_type === 'volunteer'): ?>
    <h3>Opportunities You've Signed Up For</h3>
    <?php
    $sql = "
        SELECT o.id, o.title, o.description, o.location, o.datetime_start, o.datetime_end, u.company_name
        FROM opportunities o
        LEFT JOIN users u ON o.organizer_id = u.id
        INNER JOIN volunteer_signup vs ON o.id = vs.opportunity_id
        WHERE vs.volunteer_id = ?
    ";
    $stmt = $dblink->prepare($sql);
    if (!$stmt) {
        die("Query preparation failed: " . $dblink->error);
    }
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    ?>

    <table border="1">
        <thead>
            <tr>
                <th>Opportunity ID</th>
                <th>Organizer Name</th>
                <th>Title</th>
                <th>Description</th>
                <th>Location</th>
                <th>Start Time / End Time</th>
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
                        <td><?php echo ($row['datetime_start'] . " / " . $row['datetime_end']); ?></td>
                        <td>
                            <form class="opportunity-form" method="POST" action="find_opportunities.php">
                                <input type="hidden" name="opportunity_id" value="<?php echo $row['id']; ?>">
                                <input type="hidden" name="action" value="unregister">
                                <button type="submit">Unregister</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="7">You have not signed up for any opportunities.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

<?php elseif ($user_type === 'organizer'): ?>
    <h3>Opportunities You've Posted</h3>
    <?php
    $sql = "
        SELECT o.id, o.title, o.description, o.location, o.datetime_start, o.datetime_end, COUNT(vs.id) AS signed_up_count, o.needed_volunteers
        FROM opportunities o
        LEFT JOIN volunteer_signup vs ON o.id = vs.opportunity_id
        WHERE o.organizer_id = ?
        GROUP BY o.id
    ";
    $stmt = $dblink->prepare($sql);
    if (!$stmt) {
        die("Query preparation failed: " . $dblink->error);
    }
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    ?>

    <table border="1">
        <thead>
            <tr>
                <th>Opportunity ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Location</th>
                <th>Start Time / End Time</th>
                <th>Signed Up / Needed Volunteers</th>
                <th>Volunteers (Name & Email)</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo ($row['id']); ?></td>
                        <td><?php echo ($row['title']); ?></td>
                        <td><?php echo ($row['description']); ?></td>
                        <td><?php echo ($row['location']); ?></td>
                        <td><?php echo ($row['datetime_start'] . " / " . $row['datetime_end']); ?></td>
                        <td><?php echo ($row['signed_up_count'] . " / " . $row['needed_volunteers']); ?></td>
                        <td>
                            <?php
                            $volunteer_sql = "
                                SELECT u.first_name, u.last_name, u.email
                                FROM volunteer_signup vs
                                INNER JOIN users u ON vs.volunteer_id = u.id
                                WHERE vs.opportunity_id = ?
                            ";
                            $volunteer_stmt = $dblink->prepare($volunteer_sql);
                            if (!$volunteer_stmt) {
                                die("Volunteer query preparation failed: " . $dblink->error);
                            }
                            $volunteer_stmt->bind_param("i", $row['id']);
                            $volunteer_stmt->execute();
                            $volunteer_result = $volunteer_stmt->get_result();
                            if ($volunteer_result && $volunteer_result->num_rows > 0):
                                while ($volunteer = $volunteer_result->fetch_assoc()):
                                    echo ($volunteer['first_name'] . " " . $volunteer['last_name'] . " (" . $volunteer['email'] . ")<br>");
                                endwhile;
                            else:
                                echo "No volunteers signed up.";
                            endif;
                            ?>
                        </td>
                        <td>
                            <form class="opportunity-form" method="POST" action="">
                                <input type="hidden" name="opportunity_id" value="<?php echo $row['id']; ?>">
                                <input type="hidden" name="action" value="delete">
                                <button type="submit">Delete Opportunity</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="8">You have not posted any opportunities.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

<?php endif; ?>

<?php
// Close the database connection
$dblink->close();
?>
