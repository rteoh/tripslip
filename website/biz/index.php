<?

$nav_button = 1;

// Call Header Page
include('../include/header.php');


// Get ID from URL
$id = str_replace("/biz/", "", $_SERVER['REQUEST_URI']);
$id = str_replace("?delete", "", $id);

// Convert Unicode to UTF-8
$id = urldecode($id);


// Get business data from MySQL database.
$r = mysqli_query($con, "SELECT * FROM yelp_business WHERE id='$id'");
$row = mysqli_fetch_array ($r, MYSQLI_ASSOC);

$category = $row["category"];

$category = rankCategory($category);

// Get time spent from MySQL database.
$r_cat = mysqli_query($con, "SELECT * FROM time_spent WHERE category='$category'");
$row_cat = mysqli_fetch_array ($r_cat, MYSQLI_ASSOC);

$time_spent = $row_cat['time_spent'] / 60;


// If listing cannot be fetched
if($row["id"] == "") {

	fetchListing($id);

}

// Check if country is empty. If empty, add country to database.
else if($row["country"] == "") {

	// Call function to add state and country to database. (Businesses imported to database prior to v0.1)
	updateLocation($id);
}


// Allow user to delete location from there list
$user = $_SESSION['user'];

$remove = FALSE;

if(@isset($user) && @isset($_GET['delete'])) {

    // Change remove variable to make it compatible with the removeListing Function
    $remove = $row["id"];

    removeListing($user,$remove);

    // Change back to boolean
    $remove = TRUE;

}


?>

			<section class="cover height-90 imagebg text-center" data-overlay="2" id="home">
                <div class="background-image-holder" style="background: url(&quot;<? echo $row["image_url"] ?>&quot;); opacity: 1;">
                    <img alt="background" src="img/landing-10.jpg">
                </div>
                <div class="container pos-vertical-center">
                    <div class="row">
                        <div class="col-md-8">
                            <h1>
                                <b><? echo $row["name"] ?></b>
                            </h1>
                        </div>
                    </div>
                    <!--end of row-->
                </div>
                <!--end of container-->
            </section>

            <section class="text-center">
                <div class="container">
                    <div class="row">
                        <? if($remove == TRUE) { echo '<div class="col-md-12">Location has been removed.</div>'; } ?>
                    	<div class="col-md-6">
                    		<? map($row["latitude"],$row["longitude"]); ?>
                    	</div>
                    	<div class="col-md-6">
							<h2>Address:</h2>
							<p><? echo $row["address"] ?>
							<br><? echo $row["city"] . ", " . $row["state"] . " " . $row["postal"] ?></p>

							

							<h2>Phone:</h2>
							<p><? echo $row["phone"] ?></p>

							<? if($time_spent == 24) { ?>
							<h5>People usually spend the whole day here.</h5>
							<? } elseif($time_spent > 1) { ?>
							<h5>People usually spend <? echo $time_spent ?> hours here.</h5>
							<? } elseif($time_spent > 0) { ?>
							<h5>People usually spend <? echo $time_spent ?> hour here.</h5>
							<? } ?>

							<h6>Tags: <? echo $row["category"] ?></h6>
                    	</div>
                        <? if($remove == FALSE) { echo '<div class="col-md-12" style="margin-top:10%"><a href="?delete"><input class="btn btn--sm btn--danger type--uppercase left" style="-webkit-appearance: none;background: #cb2027;color:#fff;border: none;" value="Delete Location from your List"></a></div>'; } ?>
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


