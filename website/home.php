<?
include("include/con.php");
include("include/function.php");

?>

<html>

	<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="/css/main.css">
	<link rel="stylesheet" href="/css/style.css">


	</head>

<body>
        <div class="nav-container ">
            <div class="bar bar--sm visible-xs">
                <div class="container">
                    <div class="row">
                        <div class="col-3 col-md-2">
                            <a href="index.html">
                                <img class="logo" alt="TripSlip" src="img/logo.svg">
                            </a>
                        </div>
                        <div class="col-9 col-md-10 text-right">
                            <a href="#" class="hamburger-toggle" data-toggle-class="#menu2;hidden-xs hidden-sm">
                                <i class="icon icon--sm stack-interface stack-menu"></i>
                            </a>
                        </div>
                    </div>
                    <!--end of row-->
                </div>
                <!--end of container-->
            </div>
            <!--end bar-->
            <nav id="menu2" class="bar bar-2 hidden-xs bar--transparent bar--absolute" data-scroll-class="100vh:pos-fixed">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-2 text-center text-left-sm hidden-xs order-lg-2">
                        </div>
                        <div class="col-lg-5 order-lg-1">
                            <div class="bar__module">
                                <ul class="menu-horizontal text-left">
                                    <li class="dropdown">
                                        <span style="cursor: pointer;user-select: none;">Home</span>
                                        <!--end dropdown container-->
                                    </li>
                                </ul>
                            </div>
                            <!--end module-->
                        </div>
                        <div class="col-lg-5 text-right text-left-xs text-left-sm order-lg-3">
                            <div class="bar__module">
                                <a class="btn btn--sm type--uppercase" href="login">
                                    <span class="btn__text">
                                        Login
                                    </span>
                                </a>
                                <a class="btn btn--sm btn--primary type--uppercase" href="/signup">
                                    <span class="btn__text">
                                        Sign Up
                                    </span>
                                </a>
                            </div>
                            <!--end module-->
                        </div>
                    </div>
                    <!--end of row-->
                </div>
                <!--end of container-->
            </nav>
            <!--end bar-->
        </div>
        <div class="main-container">
            <section class="cover height-100 text-center imagebg parallax" data-overlay="1">
                <div class="background-image-holder" style="background: url(&quot;img/bg.jpg&quot;); opacity: 1; top: 0px;">
                    <img alt="background" src="img/bg.jpg">
                </div>
                <div class="container pos-vertical-center">
                    <div class="row">
                        <div class="col-md-12">
                        	<img class="logo" style="width:300px" alt="TripSlip" src="img/logo.svg">
                            <h1>Planning Made Easy.</h1>
                            <!--end of modal instance-->
                            <form method="post">
                            	<div class="col-md-6">
                            	<input type="text" name="text" id="location" placeholder="Enter Location" class="validate-required">
	                            <button type="submit" class="btn btn--primary type--uppercase" name="submit">SEARCH</button>
	                            </div>
                            </form>
                        </div>
                    </div>
                    <!--end of row-->
                </div>
                <!--end of container-->
            </section>
            <section class="text-center">
                <div class="container">
                    <div class="row">
                    	<div class="col-md-10 col-lg-12">
							<?

							if(isset($_POST['submit'])){
								
								$location = $_POST["text"];
								listing($location);

							} else { ?>

                            <span class="h1">Auto-Generated Travel Itinerary</span>
                            <p class="lead">
                                With our sophisticated algorithm, TripSlip with generate your very own itinerary, based on your preferances and desired location.
                            </p>
                            <a class="btn btn--primary type--uppercase" href="/signup">
                                <span class="btn__text">
                                    Sign Up Today!
                                </span>
                            </a>

							<? } ?>
                    	</div>
                    </div>
                    <!--end of row-->
                </div>
                <!--end of container-->
            </section>
            <footer class="text-center space--sm footer-5 bg--dark  ">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div>
                                <span class="type--fine-print">©
                                    <span class="update-year">2019</span> Tripslip.net</span>
                            </div>
                        </div>
                    </div>
                    <!--end of row-->
                </div>
                <!--end of container-->
            </footer>
        </div>
        <a class="back-to-top inner-link" href="#start" data-scroll-class="100vh:active">
            <i class="stack-interface stack-up-open-big"></i>
        </a>
        <script src="js/flickity.min.js"></script>
        <script src="js/easypiechart.min.js"></script>
        <script src="js/parallax.js"></script>
        <script src="js/typed.min.js"></script>
        <script src="js/datepicker.js"></script>
        <script src="js/isotope.min.js"></script>
        <script src="js/ytplayer.min.js"></script>
        <script src="js/lightbox.min.js"></script>
        <script src="js/granim.min.js"></script>
        <script src="js/jquery.steps.min.js"></script>
        <script src="js/countdown.min.js"></script>
        <script src="js/twitterfetcher.min.js"></script>
        <script src="js/spectragram.min.js"></script>
        <script src="js/smooth-scroll.min.js"></script>
        <script src="js/scripts.js"></script>
    
	</body>

</html>