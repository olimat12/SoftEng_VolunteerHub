<!-- Show and control layer for volunteer signup -->

<!-- Show signup form -->
<div class="container">
    <form action="" method="POST">
 		<h1 class="signup-heading">Sign Up</h1>

 		<div class="name-container">
 		<div class="input-wrapper">
 		  <label for="firstname">First Name:</label>
 		  <input type="text" id="firstname" name="firstname" required>
 		</div>
 		<div class="input-wrapper">
 		  <label for="lastname">Last Name:</label>
 		  <input type="text" id="lastname" name="lastname" required>
 		</div>
		</div>

        <label for="companyname">Company Name: (Optional)</label>
        <input type="text" id="companyname" name="companyname"><br>

        <label for="zipcode">Zipcode:</label>
        <input type="text" id="zipcode" name="zipcode" required><br>

        <label for="phone">Phone Number:</label>
        <input type="tel" id="phone" name="phone" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <button type="submit" name="submit">Sign Up</button>

        <p>Already have an account? <a href="?page=signin">Login</a></p>
    </form>';
</div>';

<?php
//When submit is pressed, the following checks are performed and variables assigned
if (isset($_POST['submit'])) {
    $errors = ""; //reset any present errors

    $_SESSION['username'] = ""; //clear out username 
    $_SESSION['password'] = ""; //clear out password
	
	//Assign variables
    $username = $_POST['username'];
    $password = $_POST['password'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $companyname = $_POST['companyname'];
    $zipcode = $_POST['zipcode'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    // Input validations * MORE NECESSARY FOR REMAINING FIELDS | USER PROMPTS NEEDED
    if ($username == NULL)
        $errors .= "usernameNULL";
    elseif (!preg_match("/^.{6,}$/", $username)) 
        $errors = "usernameInvalid";
    else
        $_SESSION['username'] = $username;

    if ($password == NULL)
        $errors .= "passwordNULL";
    elseif (!preg_match("/^.{6,}$/", $password)) 
        $errors = "passwordInvalid";
    else
        $_SESSION['password'] = $password;
	
	//If there are errors, redirect and use the new url to show errors to the user
    if ($errors != NULL) {
        redirect("index.php?page=signup&errMsg=$errors");
    } else {
        $username = addslashes($username);
        $passText = $password;
        $salt = "saltoftheearth";
        $dblink = db_connect("volunteerhub");
        $password = hash('sha256', $salt . $passText . $username);

        // Check if username exists
        if (usernameExists($username, $dblink)) {
            redirect("index.php?page=signin&errMsg=usernameExists");
        } else {
            // Insert all fields into the volunteer_accounts table
			$sql = "INSERT INTO `volunteer_accounts` (`first_name`, `last_name`, `company_name`, `zip_code`, `phone`, `email`, `username`, `password`) 
        			VALUES ('$firstname', '$lastname', '$companyname', '$zipcode', '$phone', '$email', '$username', '$password')";
			
			//Validation and redirect to login with success message
			if ($dblink->query($sql)) {
				echo "Data inserted successfully.";
				redirect("index.php?page=signin&msg=registerSuccess");
			} else {
				echo "Error inserting data: " . $dblink->error;
				exit();
			}
        }
    }
}

echo '</section>';

// Function to check if username exists
function usernameExists($username, $dblink) {
    $query = "SELECT * FROM `volunteer_accounts` WHERE `username` = '$username'";
    $result = $dblink->query($query);
    return $result->num_rows > 0;
}
?>

