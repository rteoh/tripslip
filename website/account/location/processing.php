<? 
// Essential for accounts
include("../../includes/check.php");
include("../header.php");



if ($_SERVER['REQUEST_METHOD'] == "POST" || $_SERVER['REQUEST_METHOD'] == "post") {

    // Check if location is empty
    if($_POST['location'] == "") {
        $location = "Fullerton";
    }
    // If location is not empty
    else {
        $location = $_POST['location'];
    }
}

// Remove .php and clean up string for location variable
$location1 = $_SERVER["QUERY_STRING"];
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
                                        <? 
                                        process_location($location,$user);
                                        header('Location: https://tripslip.net/account/');


                                        $array = generateSchedule($location,$user);
                                
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

                                ?>

                                                              
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
    </body>
</html>