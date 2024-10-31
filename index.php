<?php
//include dblink and redirect functions used by most pages
include("functions.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Volunteer Hub</title>
    
    <!-- Link to external stylesheet -->
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>

    <?php 
		//Include navigation, which is used to start sessions and display top banner buttons
		include("navigation.php"); 
	?>
    
    <?php
        // Default page is home
        if (!isset($_GET['page'])) {
            $page = "home";
        } else {
            $page = $_GET['page'];
        }
        
        // Switch case to dynamically load pages
        switch($page) {
            case "find_opportunities":
                include("find_opportunities.php");
                break;
            case "about_us":
                include("about_us.php");
                break;
            case "faq":
                include("faq.php");
                break;
            case "contact_us":
                include("contact_us.php");
                break;
            case "signup":
                include("signup.php");
                break;
            case "signin":
                include("signin.php");
                break;
            case "dashboard":
                include("dashboard.php");
                break;
            case "settings":
                include("settings.php");
                break;
            case "logout":
                include("logout.php");
                break;
            default:
                include("home.php");
                break;
        }
    ?>

    <footer>
        &copy; 2024 Volunteer Hub. All rights reserved.
    </footer>

</body>

</html>
