<? 
// Essential for accounts
include("../../includes/check.php");
include("../header.php");

// Remove .php and clean up string for location variable
$location = $_SERVER["QUERY_STRING"];
$location = str_replace(".php", "", $location);
$location = str_replace("%20", " ", $location);

$insert = @mysqli_query($con, "INSERT INTO `user_locations`(`user`, `location`) VALUES ('$user','$location')");
?>
                        <div class="col-lg-8">
                            <div class="boxed boxed--lg boxed--border">
                                <div id="account-profile" class="account-tab">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <h2><? echo $location; ?></h2>
                                        </div>
                                        <div class="col-md-3" style="text-align:right">
                                            <a class="btn btn--sm btn--primary type--uppercase left" style="background: #cb2027;border:none" href="/account/">
                                                <span class="btn__text">x</span>
                                            </a>
                                        </div> 
                                         <div class="col-md-12">
                                            <? process_location($location,$user);?>
                                        </div>                            
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end of row-->
                </div>
                <!--end of container-->
            </section>
            <footer class="footer-3 text-center-xs space--xs ">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                        </div>
                        <div class="col-md-6 text-right text-center-xs">
                        </div>
                    </div>
                    <!--end of row-->
                    <div class="row">
                        <div class="col-md-6">
                            <p class="type--fine-print">
                                Plan your next trip
                            </p>
                        </div>
                        <div class="col-md-6 text-right text-center-xs">
                            <span class="type--fine-print">&copy;
                                <span class="update-year"></span> Tripslip.com</span>
                            <a class="type--fine-print" href="#">Privacy Policy</a>
                            <a class="type--fine-print" href="#">Legal</a>
                        </div>
                    </div>
                    <!--end of row-->
                </div>
                <!--end of container-->
            </footer>
        </div>
        <!--<div class="loader"></div>-->
        <a class="back-to-top inner-link" href="#start" data-scroll-class="100vh:active">
            <i class="stack-interface stack-up-open-big"></i>
        </a>
        <script src="js/jquery-3.1.1.min.js"></script>
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