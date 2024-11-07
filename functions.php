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

function redirect ( $uri )
{ ?>
	<script type="text/javascript">
		document.location.href="<?php echo $uri; ?>";
	</script>
<?php die;
}
?>