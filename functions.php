<?php

function db_connect($db) {
    $dbusername = "webuser";
    $dbpassword = "VolHub123!";
    $host = "localhost"; // Replace with your EC2 IP or hostname
    $dblink = new mysqli($host, $dbusername, $dbpassword, $db);

    // Enable SSL for the connection
    $dblink->ssl_set(NULL, NULL, '/etc/mysql/ssl/ca-cert.pem', NULL, NULL);

    // Check connection
    if ($dblink->connect_error) {
        die("Connection failed: " . $dblink->connect_error);
    }

    return $dblink;
}


function redirect ( $uri )
{ ?>
    <script type="text/javascript">
        document.location.href="<?php echo $uri; ?>";
    </script>
    <noscript>
        <meta http-equiv="refresh" content="0;url=<?php echo $uri; ?>">
        <p>JavaScript is required for redirection. Please click <a href="<?php echo $uri; ?>">here</a> if not redirected.</p>
    </noscript>
<?php die;
}
