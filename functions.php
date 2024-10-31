<?php

//function to connect to database
function db_connect($db) {
    $dbusername = "root";
    $dbpassword = "cs3773group2";
    $host = "localhost";
    $dblink = new mysqli($host, $dbusername, $dbpassword, $db);

    // Check connection
    if ($dblink->connect_error) {
        die("Connection failed: " . $dblink->connect_error);
    }

    return $dblink;
}

//simple redirect php function
function redirect($uri) {
    header("Location: $uri");
    exit(); // Ensures no further code executes after the redirect
}
?>