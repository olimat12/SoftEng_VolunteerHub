<div class="form">
    <form action="" method="POST">
        <h1 class="form-heading">Sign Up</h1>
        
        <div class="name-container">
            <div>
                <label for="firstname">First Name:</label>
                <input type="text" id="firstname" name="firstname" required>
				<?php if (isset($_GET['errMsg']) && strstr($_GET['errMsg'], "firstnameInvalid")) { ?>
					<div class="input-error">
						<p class="input-error-feedback"> Invalid: Must contain at least 2 characters </p><br>
					</div>
				<?php } ?>
            </div>
            <div>
                <label for="lastname">Last Name:</label>
                <input type="text" id="lastname" name="lastname" required>
				<?php if (isset($_GET['errMsg']) && strstr($_GET['errMsg'], "lastnameInvalid")) { ?>
					<div class="input-error">
						<p class="input-error-feedback"> Invalid: Must contain at least 2 characters </p><br>
					</div>
				<?php } ?>
            </div>
        </div>
		
		<!-- No input validation for company name -->
        <label for="companyname">Company Name:</label>
        <input type="text" id="companyname" name="companyname"><br>

        <label for="zipcode">Zipcode:</label>
        <input type="text" id="zipcode" name="zipcode" required><br>
		<?php if (isset($_GET['errMsg']) && strstr($_GET['errMsg'], "zipcodeInvalid")) {?>
			<div class="input-error">
				<p class="input-error-feedback"> Invalid: Proper valid ZIP is XXXXX </p><br>
			</div>
		<?php } ?>

        <label for="phone">Phone Number:</label>
        <input type="tel" id="phone" name="phone" required><br>
		<?php if (isset($_GET['errMsg']) && strstr($_GET['errMsg'], "phoneInvalid")) {?>
			<div class="input-error">
				<p class="input-error-feedback"> Invalid: Proper format is XXX-XXX-XXXX </p><br>
			</div>
		<?php } ?>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>
		<?php if (isset($_GET['errMsg']) && strstr($_GET['errMsg'], "emailInvalid")) {?>
			<div class="input-error">
				<p class="input-error-feedback"> Invalid: Must be in the form of x@x.com </p><br>
			</div>
		<?php } ?>
		
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>
		<?php if (isset($_GET['errMsg']) && strstr($_GET['errMsg'], "usernameInvalid")) {?>
			<div class="input-error">
				<p class="input-error-feedback"> Invalid: Must contain at least 6 characters </p><br>
			</div>
		<?php } ?>
		
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>
		<?php if (isset($_GET['errMsg']) && strstr($_GET['errMsg'], "passwordInvalid")) {?>
			<div class="input-error">
				<p class="input-error-feedback"> Invalid: Must contain at least 6 characters </p><br>
			</div>
		<?php } ?>
		
		<br><label>Account Type:</label><br>
		<div class="radio-wrapper">
			<label for="volunteer">
				<input type="radio" id="volunteer" name="user_type" value="volunteer" required>
				Volunteer
			</label>
			<label for="organizer">
				<input type="radio" id="organizer" name="user_type" value="organizer" required>
				Volunteer Organizer
			</label>
		</div><br>

        <button type="submit" name="submit">Sign Up</button>

        <p>Already have an account? <a href="?page=signin">Login</a></p>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const organizerRadio = document.getElementById('organizer');
        const companyNameInput = document.getElementById('companyname');

        organizerRadio.addEventListener('change', function() {
            if (organizerRadio.checked) {
                companyNameInput.required = true;
            }
        });

        const volunteerRadio = document.getElementById('volunteer');
        volunteerRadio.addEventListener('change', function() {
            if (volunteerRadio.checked) {
                companyNameInput.required = false;
            }
        });
    });
</script>

<?php
if (isset($_POST['submit'])) {
	
    $errors = ""; //reset any present errors
	
	//clear session variables
    $_SESSION['username']    = ""; 
    $_SESSION['password']    = ""; 
    $_SESSION['firstname']   = "";
	$_SESSION['lastname'] 	 = "";
	$_SESSION['companyname'] = "";
	$_SESSION['zipcode'] 	 = "";
	$_SESSION['phone'] 		 = "";
	$_SESSION['email'] 		 = "";
	$_SESSION['user_type']   = "";
	 
	$username 	 =$_POST['username'];
	$password	 =$_POST['password'];
	$firstname	 =$_POST['firstname'];
	$lastname	 =$_POST['lastname'];
	$companyname =$_POST['companyname'];
	$zipcode	 =$_POST['zipcode'];
	$phone	     =$_POST['phone'];
	$email       =$_POST['email'];
	$user_type   =$_POST['user_type'];

	
    // Input validations username
    if ($username == NULL) 
	{
        $errors .= "usernameNULL";
	}
    elseif (!preg_match("/^.{6,}$/", $username))
	{
        $errors .= "usernameInvalid";
	}
    else
	{
        $_SESSION['username'] = $username;
	}

	
	//Input validation password
    if ($password == NULL)
	{
        $errors .= "passwordNULL";
	}
    elseif (!preg_match("/^.{6,}$/", $password)) 
	{
        $errors .= "passwordInvalid";
	}
    else
	{
        $_SESSION['password'] = $password;
	}
	
	
	//First Name Validation
	if ($firstname == NULL)
	{
		$errors .= "firstnameNULL";
	}
    elseif (!preg_match("/^[A-Za-z'-]+$/", $firstname))
	{
		$errors .= "firstnameInvalid";
	}
	else
	{
        $_SESSION['firstname'] = $firstname;
	}
	
	
	//Last name validation
	if ($lastname == NULL)
	{
		$errors .= "lastnameNULL";
	}
    elseif (!preg_match("/^[A-Za-z'-]+$/", $lastname))
	{
		$errors .= "lastnameInvalid";
	}
	else
	{
        $_SESSION['lastname'] = $lastname;
	}
	
	//Zip code validation
    if ($zipcode == NULL) 
	{
    	$errors .= "zipcodeNULL";
	}
	elseif (!preg_match("/^\d{5}(-\d{4})?$/", $zipcode)){
    	$errors .= "zipcodeInvalid";
	}
	else
	{
        $_SESSION['zipcode'] = $zipcode;
	}
	
	//Phone validation
   	if ($phone == NULL) 
	{
    	$errors .= "phoneNULL";
   	}
	elseif (!preg_match("/^\(?\d{3}\)?[-.\s]?\d{3}[-.\s]?\d{4}$/", $phone)) {
    	$errors .= "phoneInvalid";
	}
	else
	{
        $_SESSION['phone'] = $phone;
	}
	
	//email validation
  	if ($email == NULL) 
  	{
    	$errors .= "emailNULL";
  	}
	elseif (!preg_match("/^(([^<>()[\\]\\\\.,;:\\s@\"]+(\\.[^<>()[\\]\\\\.,;:\\s@\"]+)*)|(\".+\"))@((\\[[0-9]{1,3}\\.[0-9]{1,3}\\.[0-9]{1,3}\\.[0-9]{1,3}])|(([a-zA-Z\\-0-9]+\\.)+[a-zA-Z]{2,}))$/", $email)) 
	{
    	$errors .= "emailInvalid";
	}
	else
	{
        $_SESSION['email'] = $email;
	}


    // If there are errors, redirect and use the new URL to show errors to the user
    if ($errors != NULL) {
        redirect("index.php?page=signup&errMsg=$errors");
	} 
	else 
	{
        $username = addslashes($username);
        $passText = $password;
        $salt = "saltoftheearth";
        $dblink = db_connect("volunteerhub");
        $password = hash('sha256', $salt . $passText . $username);

        // Check if username exists
        if (usernameExists($username, $dblink)) {
            redirect("index.php?page=signin&errMsg=usernameExists");
        } else {
            // Insert all fields into the users table
            $sql = "INSERT INTO `users` (`first_name`, `last_name`, `company_name`, `zip_code`, `phone`, `email`, `username`, `password`, `user_type`) 
                    VALUES ('$firstname', '$lastname', '$companyname', '$zipcode', '$phone', '$email', '$username', '$password', '$user_type')";
            
            // Validation and redirect to login with success message
            if ($dblink->query($sql)) {
                // Store user type in session
                $_SESSION['user_type'] = $user_type;

                echo "Data inserted successfully.";
                redirect("index.php?page=signin&msg=registerSuccess");
            } else {
                echo "Error inserting data: " . $dblink->error;
                exit();
            }
        }
    }
}

// Function to check if username exists
function usernameExists($username, $dblink) {
    $query = "SELECT * FROM `users` WHERE `username` = '$username'";
    $result = $dblink->query($query);
    return $result->num_rows > 0;
}
?>

