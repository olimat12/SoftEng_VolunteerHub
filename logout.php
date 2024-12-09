<?php
//On clicking the logout button, the session is destroyed and sid is unset. When navigating to another page, a new session is created through navigation.php
// Unset session variables
unset($_SESSION['sid']); // Remove the session ID or any other session variables

// Destroy session
session_destroy();

// Redirect the user to index
redirect("index.php"); // Redirect to login page
exit();
?>
