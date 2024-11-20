<!-- Sign-in page show and logic -->

<?php
// Successful registration message shown after users are redirected from signup
if (isset($_GET['msg']) && strstr($_GET['msg'], "registerSuccess")) { ?>
    <h2 class="success-prompt">Successfully registered, please sign in:</h2>
<?php } ?>

<?php
// If the form is not submitted, show the input boxes
if (!isset($_POST['submit'])) {
?>
    <div class="signin">
        <form action="" method="POST">
            <h1 class="form-heading">Sign In</h1>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br>
			<?php if (isset($_GET['errMsg']) && strstr($_GET['errMsg'], "invalidLogin")) { ?>
    			<h2>Invalid login credentials:</h2>
			<?php } ?>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>
            <button type="submit" name="submit">Sign In</button><br>
            <p>New to Volunteer Hub? <a href="signup.php">Join Today</a></p>
        </form>
    </div>
<?php
}
?>

<?php
// If the form is submitted, perform the following checks and input data into the database
if (isset($_POST['submit'])) {
    $username = addslashes($_POST['username']);
    $passText = $_POST['password'];
    $salt = "saltoftheearth";
    $dblink = db_connect("volunteerhub"); // Connect to the volunteerhub database

    // Hash the password with the salt
    $hashed_password = hash('sha256', $salt . $passText . $username);

    // Query to check if the user exists and get the user type
    $sql = "SELECT `id`, `user_type` FROM `users` WHERE `username`='$username' AND `password`='$hashed_password'";
    $result = $dblink->query($sql) or die("Something went wrong with $sql<br>" . $dblink->error);

    if ($result->num_rows > 0) {
        // Successful login, fetch user type
        $row = $result->fetch_assoc();
        $user_type = $row['user_type'];
		$user_id   = $row['id'];

        // Store user type in session
        $_SESSION['user_type'] = $user_type;
		$_SESSION['user_id']   = $user_id;

        // Generate a new session ID
        $salt = microtime();
        $sid = hash('sha256', $salt . $hashed_password);
        $_SESSION['sid'] = $sid; // Set sid to be used by the idLoggedIn variable to display the logout button

        // Update the session ID in the database for the authenticated user
        $sql = "UPDATE `users` SET `session_id`='$sid' WHERE `username`='$username'";
        $dblink->query($sql) or die("Something went wrong with $sql<br>" . $dblink->error);

        // Redirect to the index page with session ID
        redirect("index.php?page=index&sid=$sid&usertype=$user_type");
    } else {
        // Redirect to login with error if credentials are invalid
        redirect("index.php?page=signin&errMsg=invalidLogin");
    }
}
?>
