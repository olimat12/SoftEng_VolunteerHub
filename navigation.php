<?php
//Whenever navigation is used, a new session is created only if one does not already exist. Content is conditionally shown based on SESSION variables.

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$isLoggedIn = isset($_SESSION['sid']);
?>

<div id="header">
    <div id="logo-dropdown-container">
        <!-- Dropdown Menu for links to static content pages -->
        <div id="dropdown">
            <span id="dropdown-icon">&#9776;</span> <!-- Hamburger icon for dropdown -->
            <div id="dropdown-content">
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
    
    <!-- Conditionally show buttons on navigation bar based on user type and login status -->
    <div id="buttons">
		<?php if (!$isLoggedIn): ?>
			<a href="index.php?page=signup"><button>Sign Up</button></a>
			<a href="index.php?page=signin"><button>Sign In</button></a>
		<?php else: ?>
			<?php if (isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'organizer'): ?>
				<a href="index.php?page=post_event"><button>Post Opportunity</button></a>
			<?php else: ?>
				<a href="index.php?page=find_opportunities"><button>Find Opportunities</button></a>
			<?php endif; ?>
		<?php endif; ?>
        
        <!-- Profile Dropdown Menu with conditional checks for showing dashboard, account settings, and logout based on login status -->
        <div class="dropdown">
            <img src="./images/profile_icon.png" alt="Icon Image" id="dropdownIcon">
            <div class="dropdown-content" id="dropdownContent">
				<?php if ($isLoggedIn): ?>
                	<a href="index.php?page=dashboard">Dashboard</a>
                	<a href="index.php?page=account_settings">Account Settings</a>
					<a href="index.php?page=logout">Logout</a>
				<?php else: ?>
					<a href="index.php?page=signin">Sign In</a>
				<?php endif; ?>
            </div>
        </div>
    </div>
</div>
