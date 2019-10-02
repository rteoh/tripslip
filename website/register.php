<?php

// Call Header Page
include('include/header.php');

$title = 'Register';

$page = 'Register';


// Check for form submission

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	require ('include/con.php');

	$errors = array(); // Intialize an error array

	// Checking form submission

	if (empty($_POST['user'])) {
		$errors[] = 'Please enter a username.';
	} else {
		$user = $_POST['user'];
		$uq = mysqli_query($con, "SELECT COUNT(`user`) FROM `users` WHERE `user`= '$user'");
		$ucheck = mysqli_fetch_row($uq);
		if ($ucheck[0] == '0') {
			$u = mysqli_real_escape_string($con, trim($_POST['user']));
		} else {
			$errors[] = 'Username is taken.';
		}
	}

	if (empty($_POST['email'])) {
		$errors[] = 'Please enter an email address.';
	} else {
		if (!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i', $_POST['email'])) {
			$errors[] = 'Please enter a valid email.';
		} else {
			$email = $_POST['email'];
			$eq = mysqli_query($con, "SELECT COUNT(`email`) FROM `users` WHERE `email`= '$email'");
			$echeck = mysqli_fetch_row($eq);
			if ($echeck[0] == '0') {
				$e = mysqli_real_escape_string($con, trim($_POST['email']));
			} else {
				$errors[] = 'Email is taken.';
			}
		}
	}

	// Confirm Password

	if (!empty($_POST['pass1'])) {
		if ($_POST['pass1'] != $_POST['pass2']) {
			$errors[] = 'Your password does not match.';
		} else {
			if (!preg_match('/(?)^(?=.*[a-z])(?=.*[A-Z]).{6,}$/', $_POST['pass1'])) {
				$errors[] = 'Password must be at least 6 characters long and contain at least one uppercase and lowercase letter.';
			} else {
				$p = password_hash($_POST['pass1'], PASSWORD_DEFAULT);
			}
		}
	} else {
		$errors[] = 'Please enter your password.';
	}

	if (!empty($_SERVER['HTTP_CLIENT_IP'])){
  		$ip=$_SERVER['HTTP_CLIENT_IP'];
	// Proxy?
	} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
  		$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
  		$ip=$_SERVER['REMOTE_ADDR'];
}

	if (empty($errors)) {

		// Register the user in the database


		// Make the query

		$q = "INSERT INTO users (user, email, password, registration_date, ip) VALUES ('$u', '$e', '$p', NOW(), '$ip' )";
		$r = @mysqli_query ($con, $q);
		if ($r) {
			$status = 'You are now registered! <br>
			<a href="/login.php">Please click here to login</a>';
			header("Location: https://tripslip.net/login?success=1"); 
		} else {
			$status = 'Unfortunately, we cannot register you at this moment due to a system error. We apologize for any inconvenience.';
		}

		mysqli_close($con);

		exit();

	}

	mysqli_close($con);

}

?>

            <section class="height-100 imagebg text-center" data-overlay="4">
                <div class="container pos-vertical-center">
                    <div class="row">
                        <div class="col-md-7 col-lg-5">
                            <h2>Create an Account</h2>
                            <p class="lead">
                            	<?
								if (isset($errors) && !empty($errors)) {
									foreach ($errors as $msg) {
										echo "$msg<br />\n";
									}
								} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {

									// Display the status of the account info was inputted to the database
									echo $status;

								}

                            	?>
                            </p>
                            <form action="register" method="POST">
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" name="user" placeholder="Username">
                                    </div>
                                    <div class="col-md-12">
                                        <input type="text" name="email" placeholder="Email">
                                    </div>
                                    <div class="col-md-12">
                                        <input type="password" name="pass1" placeholder="Password">
                                    </div>
                                    <div class="col-md-12">
                                        <input type="password" name="pass2" placeholder="Confirm Password">
                                    </div>
                                    <div class="col-md-12">
                                        <button class="btn btn--primary type--uppercase" type="submit" name="submit">Login</button>
                                    </div>
                                </div>
                                <!--end of row-->
                            </form>
                            <span class="type--fine-print block">Already have an account?
                                <a href="login">Sign In</a>
                            </span>
                            <span class="type--fine-print block">Forgot your username or password?
                                <a href="recover">Recover account</a>
                            </span>
                        </div>
                    </div>
                    <!--end of row-->
                </div>
                <!--end of container-->
            </section>
<?php
?>