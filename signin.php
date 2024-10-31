<!-- Sign-in page show and logic -->

<?php

//Error checking for username, login credentials, and valid sid
if (isset($_GET['errMsg']) && strstr($_GET['errMsg'], "usernameExists")) {
    echo '<h2>Username already exists:</h2>';
} elseif (isset($_GET['errMsg']) && strstr($_GET['errMsg'], "invalidSid")) {
    echo '<h2>Invalid session ID:</h2>';
} elseif (isset($_GET['errMsg']) && strstr($_GET['errMsg'], "invalidLogin")) {
    echo '<h2>Invalid login credentials:</h2>';
}

//Succesful registration message shown after users are redirected from signup
if (isset($_GET['msg']) && strstr($_GET['msg'], "registerSuccess")) {
    echo '<h2>Successfully registered:</h2>';
}
?>

<?php
//If the form is not submitted, show the input boxes
if (!isset($_POST['submit'])) {
?>
    <div class="container">
        <form action="" method="POST">
            <h1 class="signin-heading">Sign In</h1>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br>
            <button type="submit" name="submit">Sign In</button>
            <p>New to Volunteer Hub? <a href="signup.php">Join Today</a></p>
        </form>
    </div>
<?php
}
?>

<?php
//If the form is submitted, perform the following checks and input data into the database
if (isset($_POST['submit'])) {
    $username = addslashes($_POST['username']);
    $passText = $_POST['password'];
    $salt = "saltoftheearth";
    $dblink = db_connect("volunteerhub"); // Connect to the volunteerhub database

    // Hash the password with the salt
    $hashed_password = hash('sha256', $salt . $passText . $username);

    // Query to check if the user exists
    $sql = "SELECT `id` FROM `volunteer_accounts` WHERE `username`='$username' AND `password`='$hashed_password'";
    $result = $dblink->query($sql) or die("Something went wrong with $sql<br>" . $dblink->error);

    if ($result->num_rows > 0) {
        // Successful login, generate a new session ID
        $salt = microtime();
        $sid = hash('sha256', $salt . $hashed_password);
		$_SESSION['sid'] = $sid; //set sid to be used by the idLoggedIn variable to display the logout buton

        // Update the session ID in the database for the authenticated user
        $sql = "UPDATE `volunteer_accounts` SET `session_id`='$sid' WHERE `username`='$username'";
        $dblink->query($sql) or die("Something went wrong with $sql<br>" . $dblink->error);

        // Redirect to the index page with session ID
        redirect("index.php?page=index&sid=$sid");
    } else {
        // Redirect to login with error if credentials are invalid
        redirect("index.php?page=signin&errMsg=invalidLogin");
    }
}
?>

