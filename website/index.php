<? 
// Call Header Page
include('include/header.php');

// Redirect from old site
if($_SERVER['SERVER_NAME'] == "tripslip.teoh.io") {
    header('Location: https://tripslip.net');
}
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

                            if(isset($_POST["text"])) {
								
								echo "<div class=\"row\">";

								$location = $_POST["text"];

                                // If user is not logged in
                                if(!isset($_SESSION['user'])) {

                                    // There is no user account, so account is 0
                                    $array = generateSchedule($location,0);

                                } else { // If user is logged in

                                    $user = $_SESSION['user'];

                                    $array = generateSchedule($location,$user);
                                }

                                
                                // Produce every listing from JSON to a table
                                for($i = 0; $i < count($array); $i++) {


                                    // If it is 8AM again, add new Table
                                    if($array[$i]->current_time == "8:00AM") {
                                        echo "<h2> Day " . $array[$i]->day . "</h2>";
                                        echo "<table class=\"border--round table--alternate-row\"><tbody>";
                                    }

                                    echo "<tr>";
                                    echo "";
                                    echo "<td><img src=\"" . $array[$i]->image_url . "\" width=100px></td>";
                                    echo "<td><a href=\"https://tripslip.net/biz/" . $array[$i]->id . "\">" . $array[$i]->name . "</a></td>";
                                    echo "<td>" . $array[$i]->type . "</td>";
                                    echo "<td>" . $array[$i]->current_time . "</td>";
                                    echo "</tr>";


                                    // If day is not the same as next day, then end the table
                                    if(@$array[$i]->day != @$array[$i+1]->day) {
                                        echo "</tbody></table>"; // End of table
                                    }


                                }



								echo "</div>";

							} else { ?>

                            <span class="h1">Auto-Generated Travel Itinerary</span>
                            <p class="lead">
                                With our sophisticated algorithm, TripSlip with generate your very own itinerary, based on your preferances and desired location.
                            </p>
                            <a class="btn btn--primary type--uppercase" href="/register">
                                <span class="btn__text">
                                    Register Today!
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
    
	</body>

</html>
