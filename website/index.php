<? 
// Call Header Page
include('include/header.php');
?>

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
								
								echo "<div class=\"row\">";

								$location = $_POST["text"];
								listing($location);

								echo "</div>";

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
                                    <img style="display:none" src="https://www.cutercounter.com/hits.php?id=gvuqqpko&nd=6&style=44" border="0" alt="hit counter">

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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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
