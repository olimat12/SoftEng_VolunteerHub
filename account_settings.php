<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Volunteer Hub</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <style>
        body {
            margin: 0;
            padding: 0;
            background: whitesmoke;
            background-size: cover;
            font-family: 'Roboto', Arial, sans-serif;
        }

        .container {
            position: relative;
            width: 100%;
            margin: 0 auto;
            padding: 20px;
            box-sizing: border-box;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .centered-text {
            position: absolute;
            top: 800%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: #140650;
            font-size: 40px;
            font-family: 'Roboto', Arial, sans-serif;
        }

        .name-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .input-wrapper {
            flex: 1;
            margin-right: 10px;
        }

        .input-wrapper label {
            display: block;
        }

        .input-wrapper input {
            width: 100%;
        }

        #header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        #logo-dropdown-container {
            display: flex;
            align-items: center;
        }

                /* Dropdown Styles */
                .dropdown {
        position: relative;
        display: inline-block;
        }

        .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
        z-index: 1;
        right: 0; /* Align dropdown to the right */
        top: 100%; /* Position dropdown below the icon */
        }

        .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        }

        .dropdown-content a:hover {
        background-color: #ddd;
        }

        /* Show the dropdown menu on hover */
        .dropdown:hover .dropdown-content {
        display: block;
        }

        #logo img {
            max-width: 100%;
            height: auto;
            margin-right: 10px; /* Add margin to create space between the logo and the dropdown icon */
        }

        #dropdown-icon {
            cursor: pointer;
            font-size: 24px;
            color: #140650;
        }

        #dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
            z-index: 1;
        }

        #dropdown:hover #dropdown-content {
            display: block;
        }

        #dropdown-content button {
            display: block;
            width: 100%;
            padding: 10px 12px;
            text-align: left;
            border: none;
            background-color: transparent;
            cursor: pointer;
        }

        #dropdown-content button:hover {
            background-color: #ddd;
        }

        #buttons {
            text-align: right;
        }

        #buttons button {
            margin-left: 6px;
            background-color: #140650;
            color: #FFFFFF;
            border: 1px solid #2E6DA4;
            border-radius: 4px;
            padding: 6px 20px;
            font-family: 'Roboto', Arial, sans-serif;
            font-weight: normal;
            font-size: 14px;
            cursor: pointer;
        }

        .signup-heading {
            text-align: center;
            color: #140650;
            margin-bottom: 10px; /* Add margin below the heading */
        }

        form {
            text-align: center;
            /*background: rgba(255, 255, 255, 0.2);*/
            background: #7CC623;
            padding: 20px;
            border-radius: 8px;
            max-width: 400px; /* Increase the max-width to allow more space for the form */
            margin: 100px auto 0; /* Add margin to the top to push the form down */
            position: relative; /* Position the form container for absolute positioning of the delete button */
        }

        form label {
            display: block;
            color: #140650;
            margin-bottom: 8px;
        }

        form input {
            width: 100%;
            padding: 6px;
            margin-bottom: 8px;
            box-sizing: border-box;
        }

        form button {
            background-color: #140650;
            color: #FFFFFF;
            border: 1px solid #2E6DA4;
            border-radius: 4px;
            padding: 6px 20px;
            font-family: 'Roboto', Arial, sans-serif;
            font-weight: normal;
            font-size: 14px;
            cursor: pointer;
        }

        .profile-picture-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 20px;
        }

        .profile-picture {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 4px solid #140650;
            overflow: hidden;
            margin-bottom: 10px;
        }

        .profile-picture img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Add a style for the "Post New Event" button */
        .post-event-button {
            background-color: #140650;
            color: #FFFFFF;
            border: 1px solid #2E6DA4;
            border-radius: 4px;
            padding: 6px 20px;
            font-family: 'Roboto', Arial, sans-serif;
            font-weight: normal;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none; /* Remove underline */
            margin-left: 6px; /* Add margin to align with other buttons */
        }

        /* Style for the button on hover */
        .post-event-button:hover {
            background-color: #2E6DA4;
        }

        /* Added styles for the delete button */
        .delete-button {
            position: absolute;
            top: 0;
            right: 0;
        }

        @media (max-width: 768px) {
            #buttons {
                text-align: center;
                margin-top: 10px;
            }

            #buttons button {
                margin: 6px;
            }
        }

        footer {
            text-align: center;
            background-color: #333;
            color: #fff;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>

<body>

    <div id="header">
        <div class="container">
            <div id="logo-dropdown-container">
                <div id="dropdown">
                    <span id="dropdown-icon">&#9776;</span>
                    <div id="dropdown-content">
                        <a href="./find_volunteer_opportunities.html"><button>Find Volunteer Opportunities</button></a>
                        <a href="./about_us.html"><button>About Us</button></a>
                        <a href="./faq.html"><button>FAQs</button></a>
                        <a href="./contact_us.html"><button>Contact Us</button></a>
                    </div>
                </div>
                <div id="logo">
                    <a href="index.html">
                        <img src="images/logo.png" alt="The Logo">
                    </a>
                </div>
            </div>
            <div id="buttons">
            <a href="./signup.html"><button>Sign Up</button></a>
            <a href="./signin.html"><button>Sign In</button></a>
            <div class="dropdown">
                <img src="./images/profile_icon.png" alt="Icon Image" id="dropdownIcon">
                <div class="dropdown-content" id="dropdownContent">
                    <a href="./dashboard.html">Dashboard</a>
                    <a href="./settings.html">Settings</a>
                    <a href="./logout.html">Logout</a>
                </div>
            </div>
            </div>
        </div>
    </div>

    <div class="container">

        <form>
            <div class="profile-picture-container">
                <div class="profile-picture">
                    <img src="profile_picture.jpg">
                </div>
                <label for="fileInput" class="post-event-button">Update Profile Picture</label>
                <input type="file" id="fileInput" style="display: none;">
            </div>
        
            <!-- Move the delete button into a separate container with absolute positioning -->
            <div class="delete-container">
                <a href="./delete_account.html" class="post-event-button delete-button">Delete Account</a>
            </div>
        
            <h3 class="signup-heading">Update Information</h3>
        
            <div class="name-container">
                <div class="input-wrapper">
                    <label for="firstname">First Name:</label>
                    <input type="text" id="firstname" name="firstname">
                </div>
                <div class="input-wrapper">
                    <label for="lastname">Last Name:</label>
                    <input type="text" id="lastname" name="lastname">
                </div>
            </div>
        
            <label for="companyname">Company Name: (Optional)</label>
            <input type="text" id="companyname" name="companyname"><br>
        
            <label for="zipcode">Zipcode:</label>
            <input type="zipcode" id="zipcode" name="zipcode"><br>
        
            <label for="phone">Phone Number:</label>
            <input type="tel" id="phone" name="phone"><br>
        
            <label for="email">Email:</label>
            <input type="email" id="email" name="email"><br>

            <button type="submit">Update Information</button>
        
            <h3 class="signup-heading">Change password</h3>

            <label for="currentpassword">Current Password:</label>
            <input type="currentpassword" id="currentpassword" name="currentpassword"><br>

            <label for="newpassword">New Password:</label>
            <input type="newpassword" id="newpassword" name="newpassword"><br>

            <label for="confirmpassword">Confirm Password:</label>
            <input type="confirmpassword" id="confirmpassword" name="confirmpassword"><br>
        
            <button type="submit">Change Password</button>

        </form>
        

        
    </div>

    <footer>
        &copy; 2024 Volunteer Hub. All rights reserved.
    </footer>

</body>

</html>
