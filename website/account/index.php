<? 
// Essential for accounts
include("../includes/check.php");
?>


        <div class="main-container">
            <section class="bg--secondary space--sm">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="boxed boxed--lg boxed--border">
                                <div class="text-block text-center">
                                    <span class="h5"><? echo $_SESSION['user'] ?></span>
                                    <span>Admin</span>
                                    <!--<span class="label">Pro</span> -->
                                </div>
                                <hr>
                                <div class="text-block">
                                    <ul class="menu-vertical">
                                        <!--<li>
                                            <a href="#" data-toggle-class=".account-tab:not(.hidden);hidden|#account-profile;hidden">Profile</a>
                                        </li>
                                        <li>
                                            <a href="#" data-toggle-class=".account-tab:not(.hidden);hidden|#account-notifications;hidden">Email Notifications</a>
                                        </li>
                                        <li>
                                            <a href="#" data-toggle-class=".account-tab:not(.hidden);hidden|#account-billing;hidden">Billing Details</a>
                                        </li>
                                        <li>
                                            <a href="#" data-toggle-class=".account-tab:not(.hidden);hidden|#account-password;hidden">Password</a>
                                        </li>-->
                                        <li>
                                            <a href="/logout" data-toggle-class=".account-tab:not(.hidden);hidden|#account-delete;hidden">Logout</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="boxed boxed--lg boxed--border">
                                <div id="account-profile" class="account-tab">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <h2>Places to Travel</h2>
                                        </div>
                                        <div class="col-md-3" style="text-align:right">
                                            <a class="btn btn--sm btn--primary type--uppercase left" href="add">
                                                <span class="btn__text">+</span>
                                            </a>
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