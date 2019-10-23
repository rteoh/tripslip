<?php

$page = 'Login';
$title = 'Login';

?>

            <section class="height-100 imagebg text-center" data-overlay="4">
                <div class="container pos-vertical-center">
                    <div class="row">
                        <div class="col-md-7 col-lg-5">
                            <h2>Login to continue</h2>
                            <p class="lead">
                            	<?

								if(isset($errors) && !empty($errors)) {

                                    // Display any errors
									foreach ($errors as $msg) {
										echo "$msg<br />\n";
									}

                                // If account has just been created
								} elseif(@$_GET['success']) {
                                    echo "You're account has been created. You may now login.";
                                    
                                // Welcome message
                                } else {
									echo 'Welcome back, sign in with your existing TripSlip account credentials';
								}
                            	?>
                            </p>
                            <form action="login" method="POST">
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" name="user" placeholder="Username">
                                    </div>
                                    <div class="col-md-12">
                                        <input type="password" name="pass" placeholder="Password">
                                    </div>
                                    <div class="col-md-12">
                                        <button class="btn btn--primary type--uppercase" type="submit" name="submit">Login</button>
                                    </div>
                                </div>
                                <!--end of row-->
                            </form>
                            <span class="type--fine-print block">Dont have an account yet?
                                <a href="register">Create account</a>
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