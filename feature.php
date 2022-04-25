<?php
ob_start();
session_start();

include 'include/config.php';
function get_all_articles()
{
    include 'include/config.php';
    $query = "SELECT *  FROM articles WHERE status=1 ORDER BY id DESC LIMIT 0,20";

    $stmt = $conn->prepare($query);
    $stmt->execute();
    $num = $stmt->rowCount();
    $res = array();
    if ($num > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            array_push($res, array(
                "id" => $id,
                "title" => $title,
                "categories" => $categories,
                "topics" => $topics,
                "image" => $image,
                "content" => $content,
                "tags" => $tags,
                "scientific" => $scientific,
                "created_on" => Date('d M yy', strtotime($created_on)),
                "status" => $status
            ));
        }
    }

    //print_r($res);
    return $res;
}
// include 'include/functions.php';
$get_all_articles = get_all_articles();


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
                <section class="section">
                    <div class="container">
                        <?php foreach ($get_all_articles as $get_all_article) {        ?>
                            <di class="row">
                                <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                                    <div class="page-wrapper">
                                        <!-- <div class="blog-top clearfix">
                                        <h4 class="pull-left">Recent News <a href="#"><i class="fa fa-rss"></i></a></h4>
                                    </div>end blog-top -->

                                        <div class="blog-list clearfix">
                                            <div class="blog-box row">
                                                <div class="col-md-4">
                                                    <div class="post-media">
                                                        <a href="tech-single.html" title="">
                                                            <img src="./admin/uploads/articles/<?php echo $get_all_article['image']; ?>" alt="" class="img-fluid">
                                                            <div class="hovereffect"></div>
                                                        </a>
                                                    </div><!-- end media -->
                                                </div><!-- end col -->

                                                <div class="blog-meta big-meta col-md-8">
                                                    <h4><a href="feature_details.php?article_id=<?php echo  $get_all_article['id']; ?>" title=""><?php echo $get_all_article['title']; ?></a></h4>
                                                    <?php $string = strip_tags($get_all_article['content']);
                                                    if (strlen($string) > 500) {

                                                        // truncate string
                                                        $stringCut = substr($string, 0, 150);
                                                        $endPoint = strrpos($stringCut, ' ');

                                                        //if the string doesn't contain any space then it will cut without word basis.
                                                        $string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                                        $string .= '... <a href="feature_details.php?article_id=' . $get_all_article["id"] . '">Read More</a>';
                                                    }
                                                    echo $string;    ?>
                                                    <p><?php // echo  $get_all_article['content']; 
                                                        ?></p>
                                                    <small class="firstsmall"><a class="bg-orange" href="tech-category-01.html" title=""><?php echo $get_all_article['categories']; ?></a></small>
                                                    <small><a href="#" title=""><?php echo $get_all_article['created_on']; ?></a></small>
                                                    <!-- <small><a href="tech-author.html" title="">by Matilda</a></small> -->
                                                    <!-- <small><a href="tech-single.html" title=""><i class="fa fa-eye"></i> 1114</a></small> -->
                                                </div><!-- end meta -->
                                            </div><!-- end blog-box -->



                                            <hr class="invis">

                                            <!-- <div class="row">
                                            <div class="col-md-12">
                                                <nav aria-label="Page navigation">
                                                    <ul class="pagination justify-content-start">
                                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                        <li class="page-item">
                                                            <a class="page-link" href="#">Next</a>
                                                        </li>
                                                    </ul>
                                                </nav>
                                            </div>
                                        </div> -->
                                        </div><!-- end col -->
                                    </div>
                                </div>
                            </di <?php   }      ?> </section>

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