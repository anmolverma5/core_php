<?php
ob_start();
session_start();

include 'include/config.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Upcoming Events</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: Eterna - v2.2.0
  * Template URL: https://bootstrapmade.com/eterna-free-multipurpose-bootstrap-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <?php include('include/topbar.php') ?>
    <!-- ======= Header ======= -->
    <?php include('include/header.php') ?>
    <!-- End Header -->

    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <section id="breadcrumbs" class="breadcrumbs">
            <div class="container">

                <h2>Upcoming Events</h2>

            </div>
        </section><!-- End Breadcrumbs -->

        <!-- ======= Portfolio Section ======= -->
        <section id="portfolio" class="portfolio">
            <div class="container">

                <!-- <div class="row">
          <div class="col-lg-12 d-flex justify-content-center">
            <ul id="portfolio-flters">
              <li data-filter="*" class="filter-active">All</li>
              <li data-filter=".filter-app">App</li>
              <li data-filter=".filter-card">Card</li>
              <li data-filter=".filter-web">Web</li>
            </ul>
          </div>
        </div> -->

                <div class="row portfolio-container">

                    <?php

                    // select all data
                    $query = "SELECT *
                          FROM images                                                 
                          ORDER BY id DESC";
                    $stmt = $conn->prepare($query);
                    $stmt->execute();

                    if (!$stmt) {
                        echo $conn->error;
                    }

                    // this is how to get number of rows returned
                    $num = $stmt->rowCount();


                    echo "";

                    if ($num > 0) {


                        /*  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                            extract($row);

                            $created_on = date("d-m-Y", strtotime($created_on)); ?>


                            <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                                <div class="portfolio-wrap">
                                    <img src="admin/uploads/gallary/<?php echo $thumbnail; ?>" class="img-fluid" alt="">
                                    <div class="portfolio-info">
                                        <h4><?php echo $title; ?></h4>
                                        <div class="portfolio-links">
                                            <a href="admin/uploads/gallary/<?php echo $thumbnail; ?>" data-gall="portfolioGallery" class="venobox" title="App 1"><i class="bx bx-plus"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php
                        } */
                    }

                    // if no records found
                    else {
                        echo "<div class='alert alert-danger'>No records found.</div>";
                    }
                    ?>





                </div>
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="https://img.freepik.com/free-vector/happy-people-dancing-party-together_74855-6512.jpg?t=st=1650731621~exp=1650732221~hmac=6ff26048a331726cd51361b9bb1aac5ddfffd58da4fe8d505bdee6801aec54f1&w=1060" alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="https://img.freepik.com/free-vector/flat-people-dancing-illustration_52683-70934.jpg?t=st=1650731621~exp=1650732221~hmac=5a44ab20e45bc8de3f1ed24167f78bdab1a5e1feb774dc160cec9191187f2fcc&w=900" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="https://img.freepik.com/free-vector/silhouettes-party-people-mirror-ball-disco-background_1048-13833.jpg?t=st=1650731621~exp=1650732221~hmac=eb6a6f5e6fa3ef5b6102b740c0a368fdeca4fb5825020645c1f3e9e8a83beb31&w=826" alt="Third slide">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                <!-- ======= Values Section ======= -->
                <section id="values" class="values">
                    <div class="container">

                        <div class="section-title" data-aos="fade-up">
                            <h2>Description</h2>
                            <p>Can youth working towards to enhance the skills of every individual in accordance to their peer groups, by creating a platform for every individual, where they outshine their skills and talents for the welfare of the society and their livelihood. </p>
                        </div>

                        <div class="row">
                            <div class="col-md-6 d-flex align-items-stretch" data-aos="fade-up">
                                <div class="card" style="background-image: url(assets/images/BPS_SECURITY/3espace.jpg);">
                                    <!-- <div class="card-body">
                                        <h5 class="card-title"><a href="">3E SPACE ACTIVITY </a></h5>
                                        <p class="card-text">creating a platform for every individual, where they outshine their skills and talents for the welfare of the society and their livelihood.</p>
                                        <div class="read-more"><a href="3espace.php"><i class="icofont-arrow-right"></i> Read More</a></div>
                                    </div> -->
                                </div>
                            </div>
                            <div class="col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="fade-up" data-aos-delay="100">
                                <div class="card" style="background-image: url(assets/images/BPS_SECURITY/Adol1.jpg);">
                                    <!-- <div class="card-body">
                                        <h5 class="card-title"><a href="">Development For Adolescent </a></h5>
                                        <p class="card-text">Awareness program on Tobacco</p>
                                        <div class="read-more"><a href=""><i class="icofont-arrow-right"></i> Read More</a></div>
                                    </div> -->
                                </div>

                            </div>
                            <div class="col-md-6 d-flex align-items-stretch mt-4" data-aos="fade-up" data-aos-delay="200">
                                <div class="card" style="background-image: url(assets/images/BPS_SECURITY/Childright.jpeg);">
                                    <!-- <div class="card-body">
                                        <h5 class="card-title"><a href="">Other Program</a></h5>
                                        <p class="card-text">Campaign at schools on santsitisation for child rights</p>
                                        <div class="read-more"><a href=""><i class="icofont-arrow-right"></i> Read More</a></div>
                                    </div> -->
                                </div>
                            </div>
                            <div class="col-md-6 d-flex align-items-stretch mt-4" data-aos="fade-up" data-aos-delay="300">
                                <div class="card" style="background-image: url(assets/images/BPS_SECURITY/skilldev.jpg);">
                                    <!-- <div class="card-body">
                                        <h5 class="card-title"><a href="">Skill Development Training</a></h5>
                                        <p class="card-text">Skill training programme on handicraft2</p>
                                        <div class="read-more"><a href=""><i class="icofont-arrow-right"></i> Read More</a></div>
                                    </div> -->
                                </div>
                            </div>

                        </div>
                </section>

            </div>
        </section><!-- End Portfolio Section -->

        <!-- ======= Clients Section ======= -->
        <section id="clients" class="clients">
            <div class="container">

                <div class="section-title">
                    <h2>Clients</h2>
                    <p></p>
                </div>

                <div class="owl-carousel clients-carousel">
                    <img src="assets/img/clients/client-1.png" alt="">
                    <img src="assets/img/clients/client-2.png" alt="">
                    <img src="assets/img/clients/client-3.png" alt="">
                    <img src="assets/img/clients/client-4.png" alt="">
                    <img src="assets/img/clients/client-5.png" alt="">
                    <img src="assets/img/clients/client-6.png" alt="">
                    <img src="assets/img/clients/client-7.png" alt="">
                    <img src="assets/img/clients/client-8.png" alt="">
                </div>

            </div>
        </section><!-- End Clients Section -->

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <?php include('include/footer.php') ?>
    <!-- End Footer -->

    <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="assets/vendor/jquery-sticky/jquery.sticky.js"></script>
    <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
    <script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
    <script src="assets/vendor/counterup/counterup.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/venobox/venobox.min.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>