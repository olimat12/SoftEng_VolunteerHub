<div>
	<?php
	//Handling of invalid session type trying to post an opportunity
	if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'organizer') 
	{
    $errMsg = "inavlidUserType";
	redirect("index.php?page=index&errMsg=$errMsg");
	exit;
	} ?>
	
    <form action="" method="POST">
        <h1 class="form-heading">Post an Opportunity</h1>
    
        <div class="input-wrapper">
            <label for="title">Event Title:</label>
            <input type="text" id="title" name="title" required>
        </div>
    
        <div class="input-wrapper">
            <label for="description">Description:</label>
            <input type="text" id="description" name="description" required>
        </div>
		
		<div class="input-wrapper">
            <label for="location">Location:</label>
            <input type="text" id="location" name="location" required>
        </div>
		
		<div class="input-wrapper">
            <label for="neededVolunteers">Number of Volunteers Needed:</label>
            <input type="int" id="neededVolunteers" name="neededVolunteers" required>
        </div>
    
        <div class="input-wrapper">
            <label for="datetimeStart">Start Date and Time:</label>
            <input type="datetime-local" id="datetimeStart" name="datetimeStart" required>
		</div>
		
		<div class="input-wrapper">
            <label for="datetimeend">End Date and Time:</label>
            <input type="datetime-local" id="datetimeEnd" name="datetimeEnd" required>
		</div>
    
        <button type="submit" name="submit">Post</button>

    </form>
</div>

<?php
if (isset($_POST['submit'])) {
    $errors = ""; // Reset any present errors

    // Clear session variables
    $_SESSION['title']            = ""; 
    $_SESSION['description']      = ""; 
    $_SESSION['location']         = "";
    $_SESSION['neededVolunteers'] = "";
    $_SESSION['datetimeStart']    = "";
    $_SESSION['datetimeEnd']      = "";

    // Retrieve form data
    $organizer_id     = $_SESSION['user_id']; // Ensure this is set in the session
    $title            = ($_POST['title']);
    $description      = ($_POST['description']);
    $location         = ($_POST['location']);
    $neededVolunteers = (int)($_POST['neededVolunteers']);
    $datetimeStart    = ($_POST['datetimeStart']);
    $datetimeEnd      = ($_POST['datetimeEnd']);
	
	$datetimeStart = str_replace("T", " ", $datetimeStart) . ":00";
	$datetimeEnd = str_replace("T", " ", $datetimeEnd) . ":00";

    // Database connection
    $dblink = db_connect("volunteerhub");

    // Title validation
    if (empty($title)) {
        $errors .= "titleNULL";
    } elseif (strlen($title) > 255) {
        $errors .= "titleTooLong";
    } else {
        $_SESSION['title'] = $title;
    }

    // Description validation
    if (empty($description)) {
        $errors .= "descriptionNULL";
    } elseif (strlen($description) > 1000) {
        $errors .= "descriptionTooLong";
    } else {
        $_SESSION['description'] = $description;
    }

    // Location validation
    if (empty($location)) {
        $errors .= "locationNULL";
    } elseif (!preg_match("/^[\w\s,.-]{3,255}$/", $location)) {
        $errors .= "locationInvalid";
    } else {
        $_SESSION['location'] = $location;
    }

    // Needed Volunteers validation
    if (empty($neededVolunteers)) {
        $errors .= "neededVolunteersNULL";
    } elseif (!is_numeric($neededVolunteers) || (int)$neededVolunteers <= 0) {
        $errors .= "neededVolunteersInvalid";
    } else {
        $_SESSION['neededVolunteers'] = $neededVolunteers;
    }

    // Start datetime validation
    if (empty($datetimeStart)) {
        $errors .= "datetimeStartNULL";
    } elseif (!strtotime($datetimeStart)) {
        $errors .= "datetimeStartInvalid";
    } else {
        $_SESSION['datetimeStart'] = $datetimeStart;
    }

    // End datetime validation
    if (empty($datetimeEnd)) {
        $errors .= "datetimeEndNULL";
    } elseif (!strtotime($datetimeEnd)) {
        $errors .= "datetimeEndInvalid";
    } elseif (strtotime($datetimeEnd) <= strtotime($datetimeStart)) {
        $errors .= "datetimeEndBeforeStart";
    } else {
        $_SESSION['datetimeEnd'] = $datetimeEnd;
    }

    // Redirect back with errors if validation fails
    if (!empty($errors)) {
        redirect("index.php?page=post_event&errMsg=$errors");
        exit;
    }

    // Insert into the database if no errors
    $sql = "INSERT INTO opportunities (organizer_id, title, description, location, needed_volunteers, datetime_start, datetime_end)
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $dblink->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("isssiss", $organizer_id, $title, $description, $location, $neededVolunteers, $datetimeStart, $datetimeEnd);
        if ($stmt->execute()) {
            echo "Opportunity posted successfully.";
            redirect("index.php?page=opportunities&msg=postSuccess");
        } else {
            echo "Error posting opportunity: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $dblink->error;
    }
}
?>
	
