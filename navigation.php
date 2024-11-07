<?php
//Whenever navigation is used, a new session is created only if one does not already exist. The logout button is conditionally shown only if there is an actively assisnged sid.

session_start();
$isLoggedIn = isset($_SESSION['sid']);
?>

<div id="header">
    <div id="logo-dropdown-container">
        <!-- Dropdown Menu for Additional Links -->
        <div id="dropdown">
            <span id="dropdown-icon">&#9776;</span> <!-- Hamburger icon for dropdown -->
            <div id="dropdown-content">
                <a href="index.php?page=find_opportunities"><button>Find Volunteer Opportunities</button></a>
                <a href="index.php?page=about_us"><button>About Us</button></a>
                <a href="index.php?page=faq"><button>FAQs</button></a>
                <a href="index.php?page=contact_us"><button>Contact Us</button></a>
            </div>
        </div>
        
        <!-- Logo Section -->
        <div id="logo">
            <a href="index.php?page=home">
                <img src="images/logo.png" alt="The Logo">
            </a>
        </div>
    </div>
    
    <!-- Buttons Section -->
    <div id="buttons">
        <a href="index.php?page=signup"><button>Sign Up</button></a>
        <a href="index.php?page=signin"><button>Sign In</button></a>
        
        <!-- Profile Dropdown Menu -->
        <div class="dropdown">
            <img src="./images/profile_icon.png" alt="Icon Image" id="dropdownIcon">
            <div class="dropdown-content" id="dropdownContent">
                <a href="index.php?page=dashboard">Dashboard</a>
                <a href="index.php?page=Account_Settings.php">Account Settings</a>
				
				<!-- Conditionally show logout button if logged in -->
                <?php if ($isLoggedIn): ?>
                <a href="index.php?page=logout">Logout</a>
           		<?php endif; ?>
            </div>
        </div>
    </div>
</div>
