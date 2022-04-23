<?php
ob_start();
session_start();

if (!isset($_SESSION['admin_login_user'])) {
  header("Location:login.php");
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>BPS Admin</title>

        <meta charset="UTF-8">
        <meta name="description" content="Clean and responsive administration panel">
        <meta name="keywords" content="Admin,Panel,HTML,CSS,XML,JavaScript">
        <meta name="author" content="Erik Campobadal">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="assets/css/uikit.min.css" />
		<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
		<link rel="stylesheet" href="assets/css/style.css" />
        <link rel="stylesheet" href="assets/css/notyf.min.css" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>        <script src="assets/js/uikit.min.js" ></script>
		<script src="assets/js/uikit-icons.min.js" ></script>
    </head>
    <body>
    
        <?php include('sidebar.php'); ?>
        <div class="content-padder content-background">
            <div class="uk-section-small uk-section-default header">
                <div class="uk-container uk-container-large">
                    <h1><span class="ion-speedometer"></span> Dashboard</h1>
<!--
                    <p>
                        Welcome back, Èrik Campobadal
                    </p>
-->
                    <ul class="uk-breadcrumb">
                        <li><a href="index.php">Home</a></li>
                        <li><span href="">Dashboard</span></li>
                    </ul>
                </div>
            </div>
            <div class="uk-section-small">
                <div class="uk-container uk-container-large">
                    <div uk-grid class="uk-child-width-1-1@s uk-child-width-1-2@m uk-child-width-1-4@xl">
                        <div>
                            <div class="uk-card uk-card-default uk-card-body">
                                <span class="statistics-text">New Registrations</span><br />
                                <span class="statistics-number">
                                    14.164
                                    <span class="uk-label uk-label-success">
                                        8% <span class="ion-arrow-up-c"></span>
                                    </span>
                                </span>
                            </div>
                        </div>
                        <div>
                            <div class="uk-card uk-card-default uk-card-body">
                                <span class="statistics-text">Website Traffic</span><br />
                                <span class="statistics-number">
                                    123.238
                                    <span class="uk-label uk-label-danger">
                                        13% <span class="ion-arrow-down-c"></span>
                                    </span>
                                </span>
                            </div>
                        </div>
                        <div>
                            <div class="uk-card uk-card-default uk-card-body">
                                <span class="statistics-text">Total Invoices</span><br />
                                <span class="statistics-number">
                                    2.316
                                    <span class="uk-label uk-label-success">
                                        37% <span class="ion-arrow-up-c"></span>
                                    </span>
                                </span>
                            </div>
                        </div>
                        <div>
                            <div class="uk-card uk-card-default uk-card-body">
                                <span class="statistics-text">Total Income</span><br />
                                <span class="statistics-number">
                                    6.384€
                                    <span class="uk-label uk-label-success">
                                        26% <span class="ion-arrow-up-c"></span>
                                    </span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div uk-grid class="uk-child-width-1-1@s uk-child-width-1-2@l">
                        <div>
                            <div class="uk-card uk-card-default">
                                <div class="uk-card-header">
                                    Website Traffic
                                </div>
                                <div class="uk-card-body">
                                    <canvas id="chart1"></canvas>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="uk-card uk-card-default">
                                <div class="uk-card-header">
                                    Website Traffic
                                </div>
                                <div class="uk-card-body">
                                    <canvas id="chart2"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<!-- Load More Javascript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.min.js" integrity="sha256-UGwvyUFH6Qqn0PSyQVw4q3vIX0wV1miKTracNJzAWPc=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.transit/0.9.12/jquery.transit.min.js" integrity="sha256-rqEXy4JTnKZom8mLVQpvni3QHbynfjPmPxQVsPZgmJY=" crossorigin="anonymous"></script>
		<script src="assets/js/notyf.min.js"></script>
		<!-- Required Overall Script -->
        <script src="assets/js/script.js"></script>
		<!-- Status Updater -->
		<script src="assets/js/status.js"></script>
		<!-- Sample Charts -->
		<script src="assets/js/charts.js"></script>
		<!-- Sample Notifications -->
		<script src="assets/js/notification.js"></script>
    </body>
</html>
