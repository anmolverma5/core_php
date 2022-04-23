 <?php
ob_start();
session_start();

if (!isset($_SESSION['admin_login_user'])) {
  header("Location:login.php");
}
 include '../include/config.php';
 include '../include/functions.php';

?>



<!DOCTYPE html>
<html>
    <head>
        <title>Article Details -canyouth</title>
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
                    <h1><span class="ion-speedometer"></span> Article Detail </h1>
<!--
                    <p>
                        Welcome back, Èrik Campobadal
                    </p>
-->
                    <ul class="uk-breadcrumb">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="tags.php">Tags</a></li>                        
                        <li><span href="add-tag.php">Add Tag</span></li>
                    </ul>
                </div>
            </div>
            <div class="uk-section-small">
                <div class="uk-container uk-container-large">
                    <div uk-grid class="uk-child-width-1-1@s uk-child-width-1-1@l">
                        <div>
                            <div class="uk-card uk-card-default">
                                <?php 


                                    if (isset($_GET['id']) ) {
                                    $id = $_GET['id'];

                                   $data = get_article_by_id($id);
                                   //echo '<pre>';
                      
                                    }
                                 ?>
                                <div class="uk-card-body">
	                                <table class="uk-table uk-table-divider">
                                       
                                        <tbody>
                                            <?php
                                             

                                            $articles = $data;


                                                ?>
                                        <tr>
                                            <td>Id :</td>
                                            <td><?php echo $articles['id']?></td>
                                        </tr>
                                        <tr>
                                            <td>Title : </td>
                                        <td><?php echo $articles['title']?></td>                 
                                        <tr>
                                            <td>Categories : </td>
                                        <td><?php 


                                        foreach ($articles['categories'] as $key => $category) {
                                           echo "<a href='#'>".$category['category_name'].'</a>'.', ';
                                        }?></td>
                                        <tr>
                                            <td>Subcategories : </td>
                                        <td><?php foreach ($articles['topics'] as $key => $topics) {
                                           echo "<a href='#'>".$topics['topic_name'].'</a>'.', ';
                                        }?></td>
                                         <tr>
                                            <td>Tags : </td>
                                         <td><?php foreach ($articles['tags'] as $key => $tags) {
                                           echo "<a href='#'>".$tags['tag_name'].'</a>'.', ';
                                        }?></td>
                                        <tr>
                                        <td>Scientific : </td>
                                        <td><?php echo $articles['scientific']?></td>
                                        <tr>
                                        <td>Created on : </td>
                                        <td><?php echo $articles['created_on']?></td>
                                      

                                            
                                        </tr>
                                  <?php  //} ?>
                  
                                           

                                      
                                        </tbody>
                                    </table>

                                    <div>
                                        <?php echo $articles['content']?>
                                    </div>
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