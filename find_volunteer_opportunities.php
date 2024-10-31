<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Volunteer Hub</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <style>
        body {
            margin: 20px; /* Add margin from all sides of the page */
            padding: 0;
            background: whitesmoke;
            background-size: cover;
            font-family: 'Roboto', Arial, sans-serif;
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
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
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

        .container {
            position: relative;
            width: 100%;
            margin: 0 auto;
            padding: 20px;
            box-sizing: border-box;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .centered-text {
            text-align: center;
            color: #140650;
            font-size: 20px;
            font-family: 'Roboto', Arial, sans-serif;
            margin-bottom: 20px;
        }

        .green-area {
            background-color: #7CC623;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            width: 100%; /* Adjust width */
            max-width: 800px; /* Limit maximum width */
        }

        .results-area {
            width: 90%; /* Adjust width */
            max-width: 800px; /* Limit maximum width */
            max-height: 300px; /* Adjust the height as needed */
            overflow-y: auto; /* Enable vertical scrollbar */
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-sizing: border-box;
            margin-bottom: 30px;
            display: flex; /* Use flexbox */
            flex-direction: column; /* Stack items vertically */
            align-items: center; /* Center items horizontally */
            margin: 0 auto; /* Center horizontally */
        }

        .opportunity {
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
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

        .search-container {
            text-align: center;
            margin-bottom: 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .search-container input,
        .search-container select {
            margin: 5px;
            padding: 8px; /* Increase padding for more vertical space */
            width: calc(50% - 10px); /* Adjust width */
            box-sizing: border-box;
        }

        .search-button {
            background-color: #140650;
            color: #FFFFFF;
            border: 1px solid #2E6DA4;
            border-radius: 4px;
            padding: 6px 20px;
            margin-top: 10px;
            font-family: 'Roboto', Arial, sans-serif;
            font-weight: normal;
            font-size: 14px;
            cursor: pointer;
        }

        footer {
            text-align: center;
            background-color: #333;
            color: #fff;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: calc(100% - 40px); /* Adjust width to account for the margins */
        }
    </style>
</head>

<body>

    <div id="header">
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
                    <a href="./Account_Settings.html">Account Settings</a>
                    <a href="./logout.html">Logout</a>
                </div>
            </div>
        </div>
        
    </div>

    <div class="container">
        <div class="centered-text">
            <h3>Find Volunteer Opportunity</h3>
            <!-- Add the green area around the search containers -->
            <div class="green-area">
                <div class="search-container">
                    <input type="text" id="keyword" name="keyword" placeholder="Search by keyword / organization name">
                    <input type="text" id="city" name="city" placeholder="Search by city / zipcode">
                </div>
                <div class="search-container">
                    <select id="sort-by" name="sort-by">
                        <option value="zipcode">Sort by Zipcode</option>
                        <option value="date">Sort by Date</option>
                        <option value="organization">Sort by Organization</option>
                    </select>
                    <select id="filter-by" name="filter-by">
                        <option value="zipcode">Filter by Zipcode</option>
                        <option value="date">Filter by Date</option>
                        <option value="organization">Filter by Organization</option>
                    </select>
                    <button type="button" class="search-button">Search</button>
                </div>
            </div>
            <!-- Results Area -->
<!-- Results Area -->
<div class="results-area">
    <div class="opportunity">
        <p><strong>Event Name:</strong> Volunteer at Local Shelter</p>
        <p><strong>Organization:</strong> Community Outreach Center</p>
        <p><strong>Task:</strong> Serving food to the homeless</p>
        <p><strong>Date:</strong> April 15, 2024</p>
        <p><strong>Time:</strong> 9:00 AM - 12:00 PM</p>
        <p><strong>Location:</strong> New York, NY 10001</p>
        <button type="button" class="search-button">Register</button>
    </div>
    <div class="opportunity">
        <p><strong>Event Name:</strong> Community Clean-up Day</p>
        <p><strong>Organization:</strong> Green Earth Foundation</p>
        <p><strong>Task:</strong> Collecting trash in the community</p>
        <p><strong>Date:</strong> April 20, 2024</p>
        <p><strong>Time:</strong> 10:00 AM - 2:00 PM</p>
        <p><strong>Location:</strong> Los Angeles, CA 90001</p>
        <button type="button" class="search-button">Register</button>
    </div>
    <div class="opportunity">
        <p><strong>Event Name:</strong> Food Drive for the Homeless</p>
        <p><strong>Organization:</strong> Helping Hands Charity</p>
        <p><strong>Task:</strong> Collecting and distributing food items</p>
        <p><strong>Date:</strong> May 1, 2024</p>
        <p><strong>Time:</strong> 11:00 AM - 3:00 PM</p>
        <p><strong>Location:</strong> Chicago, IL 60601</p>
        <button type="button" class="search-button">Register</button>
    </div>
    <div class="opportunity">
        <p><strong>Event Name:</strong> Tutoring Session for Underprivileged Children</p>
        <p><strong>Organization:</strong> Education for All</p>
        <p><strong>Task:</strong> Providing academic support to children</p>
        <p><strong>Date:</strong> May 10, 2024</p>
        <p><strong>Time:</strong> 3:00 PM - 5:00 PM</p>
        <p><strong>Location:</strong> Houston, TX 77001</p>
        <button type="button" class="search-button">Register</button>
    </div>
    <div class="opportunity">
        <p><strong>Event Name:</strong> Beach Cleanup Project</p>
        <p><strong>Organization:</strong> Ocean Conservation Society</p>
        <p><strong>Task:</strong> Cleaning up litter from the beach</p>
        <p><strong>Date:</strong> May 20, 2024</p>
        <p><strong>Time:</strong> 8:00 AM - 11:00 AM</p>
        <p><strong>Location:</strong> Miami, FL 33101</p>
        <button type="button" class="search-button">Register</button>
    </div>
</div>

       
        </div>
    </div>

    <footer>
        &copy; 2024 Volunteer Hub. All rights reserved.
    </footer>

</body>

</html>