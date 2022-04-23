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
        <title>Categories list - Sciplify Admin</title>
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
                    <h1><span class="ion-speedometer"></span> News </h1>
<!--
                    <p>
                        Welcome back, Èrik Campobadal
                    </p>
-->
                    <ul class="uk-breadcrumb">
                        <li><a href="index.php">Home</a></li>
                        <li><span href="articles.php">News</span></li>
                    </ul>
                </div>
            </div>
            <div class="uk-section-small">
                <div class="uk-container uk-container-large">
                    <div uk-grid class="uk-child-width-1-1@s uk-child-width-1-1@l">
                        <div>
                            <div class="uk-card uk-card-default">
                                <div class="uk-card-header">
                                    List of News 
                                   <a href='add-article.php' class='uk-button uk-button-primary uk-align-right'>Add New </a>     

                                </div>
                                <div class="uk-card-body">
	                                <table class="uk-table uk-table-responsive uk-table-divider">
		                                <thead>
									        <tr>
									            <th>Id</th>
									            <th>Title</th>
                                                <!-- <th>Categories</th>	 -->
									           <!--  <th>Topics</th>
									            <th>Tags</th> -->
                                                
                                                <th>Views</th>
                                                <th>Exclusive</th>
									            <th>Created On</th>	
                                                <th>Action</th> 
									        </tr>
									    </thead>
                                    <?php
									
                                    $data = get_all_articles();
                                    //echo '<pre>';
                                    //print_r($data);

                                    foreach ($data as $key => $articles) { ?>
                                        <tr>
                                        <td><?php echo $articles['id']?></td>
                                        <td><?php echo $articles['title']?></td>                 
                                       <!--  <td><?php foreach ($articles['categories'] as $key => $category) {
                                           echo "<a href='#'>".$category['category_name'].'</a>'.', ';
                                        }?></td>
                                        <td><?php foreach ($articles['topics'] as $key => $topics) {
                                           echo "<a href='#'>".$topics['topic_name'].'</a>'.', ';
                                        }?></td>
                                         <td><?php foreach ($articles['tags'] as $key => $tags) {
                                           echo "<a href='#'>".$tags['tag_name'].'</a>'.', ';
                                        }?></td> -->
                                        <td><?php echo $articles['view'];?></td>
                                        <td><?php echo ($articles['scientific'] == 1) ? 'Yes' : 'No'; ?></td>
                                        <td><?php echo $articles['created_on']?></td>
                                        <td><a href='add-article.php?id=<?php echo $articles['id']?>&edit=true'>EDIT <a/><a href='article-details.php?edit=1&id=<?php echo $articles['id']?>'>| VIEW<a/></td>

                                            <td>
                                            </td>
                                        </tr>
                                  <?php  }

									// // select all data
									// $query = "SELECT *
									// 		    FROM categories                                                 
									// 		    ORDER BY id DESC";
									// $stmt = $conn->prepare($query);
									// $stmt->execute();

         //                            if (!$stmt) {
         //                                echo $conn->error;
         //                            }
									 
									// // this is how to get number of rows returned
									// $num = $stmt->rowCount();
									 
									
									// echo "";
									
									// if($num>0){
									 	
									
									//      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
									
									//     extract($row);
									
         //                                $created_on = date("d-m-Y", strtotime($created_on));
								
									//     echo "<tr>";
									//         echo "<td>{$id}</td>";
									//         echo "<td>{$title}</td>";                                          
         //                                     echo "<td>{$slug}</td>";
									//         echo "<td style='width: 20%;'>{$description}</td>"; 
									//          echo "<td><img src='uploads/categories/{$thumbnail}' width='60px' height='60px'></td>"; 
         //                                    echo "<td>{$created_on}</td>";
									//         echo "<td>{$status}</td>";
         //                                   echo "<td><a href='add-category.php?id={$id}&edit=true'>EDIT <a/><a href='category-details.php?edit=1&id={$id}'>| VIEW<a/></td>";

									//         echo "<td>";
									//         echo "</td>";
									//     echo "</tr>";
									// }
									// }
									 
									// // if no records found
									// else{
									//     echo "<div class='alert alert-danger'>No records found.</div>";
									// }
									?>
	                                </table>
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