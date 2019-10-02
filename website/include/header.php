<?
include("con.php");
include("function.php");

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
                                <a class="btn btn--sm btn--primary type--uppercase" href="/register">
                                    <span class="btn__text">
                                        Register
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