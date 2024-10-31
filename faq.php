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

        .faq-text {
            text-align: left;
            color: #140650;
            font-size: 24px;
            margin-top: 20px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            margin-bottom: 100px; /* Add margin to the bottom of the text */
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
    
    <div class="faq-text">
        <h2 style="color: green;">FAQs for Volunteer Hub</h2>
        <h5 style="color: green;">1. How do I sign up to volunteer?</h5>
        <p>To sign up, simply create an account on our website, browse through the list of available
            volunteer opportunities, and click 'I Want To Volunteer' for the opportunity you choose.
            You'll receive a confirmation once you're successfully registered.</p>
        <h5 style="color: green;">2. What types of volunteer opportunities are available?</h5>
        <p>We offer a diverse range of volunteering opportunities across various sectors, including
            environmental, educational, health, community development, and many more, to suit
            different interests and skill sets.</p>
        <h5 style="color: green;">3. Is there a minimum commitment required?</h5>
        <p>Each volunteer opportunity has its own set of requirements, including time commitment,
            which will be clearly stated on the opportunity page. Some events may require a one-time
            involvement, while others might need a longer-term commitment.</p>
        <h5 style="color: green;">4. How can I track my volunteer hours?</h5>
        <p>Once you have an account, your volunteer hours are tracked on your profile. After you
        participate in an event, your hours will be automatically updated.</p>
        <h5 style="color: green;">5. Do I need any special skills to volunteer?</h5>
        <p>While some opportunities may require specific skills, many do not and are open to
            everyone. Skill requirements, if any, will be detailed in the event's description.</p>
        <h5 style="color: green;">6. How can I find volunteer opportunities that fit my schedule?</h5>
        <p>Our search feature allows you to filter opportunities by date, time, and duration, helping you
            find opportunities that fit into your schedule.</p>
        <h5 style="color: green;">7. Can I cancel my registration for an event?</h5>
        <p>Yes, you can cancel your registration directly from your dashboard. Please try to cancel as
            early as possible to allow others the opportunity to participate.</p>
        <h5 style="color: green;">8. What should I do if I have a question about a specific volunteer event?</h5>
        <p>For event-specific questions, you can contact the volunteer coordinator listed on the event
            page. They can provide detailed information about the opportunity.</p>
        <h5 style="color: green;">9. How do I change my account information?</h5>
        <p>You can update your account information at any time by logging in to your profile and
            accessing the 'Manage Your Account' option.</p>
        <h5 style="color: green;">10. What happens if an event is canceled?</h5>
        <p>In the rare case that an event is canceled, you will be notified via email and will see the
            cancellation on your dashboard. We will do our best to suggest alternative opportunities.</p>
        <h5 style="color: green;">11. How can my organization list volunteer opportunities on Volunteer Hub?</h5>
        <p>Organizations can register on our platform and submit their volunteer opportunities for
            review. Once approved, they will be listed on our site.</p>
        <h5 style="color: green;">12. How secure is my personal information on Volunteer Hub?</h5>
        <p>We prioritize your privacy and the security of your personal information. Our platform uses
            state-of-the-art security measures to protect your data.</p>
    </div>
    

    <footer>
        &copy; 2024 Volunteer Hub. All rights reserved.
    </footer>

</body>

</html>
