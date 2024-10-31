<?php
//Whenever navigation is used, a new session is created only if one does not already exist. The logout button is conditionally shown only if there is an actively assisnged sid.

session_start();
$isLoggedIn = isset($_SESSION['sid']);
?>

<div id="header">
    <div class="container">
        <div id="logo">
            <a href="index.php">
                <img src="images/logo.png" alt="The Logo">
            </a>
        </div>
        <div id="buttons">
            <a href="?page=signup"><button>Sign Up</button></a>
            <a href="?page=signin"><button>Sign In</button></a>
            <div class="dropdown">
                <img src="./images/profile_icon.png" alt="Profile Icon">
                <div class="dropdown-content">
                    <a href="?page=dashboard">Dashboard</a>
                    <a href="?page=settings">Settings</a>
                <?php if ($isLoggedIn): ?>
                	<a href="?page=logout">Logout</a>
           		<?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
