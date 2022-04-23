 <?php
ob_start();
session_start();

if (!isset($_SESSION['admin_login_user'])) {
  header("Location:login.php");
}
 include '../include/config.php';
    if (isset($_POST['submit'])) {
        
         $date_time = date("Y-m-d h:i:s");
        
        $title = $_POST["title"];        
        $description = "";         
        $status = $_POST['status'];
        $slug = "";
        $parent_id = "";
        $thumbnail = '';
  

    if (isset($_FILES['Image']['name']) && $_FILES['Image']['name'] != '') { 


      
          $ImageName =  $_FILES['Image']['name'];
          @$tempName  = $_FILES['Image']['temp_name'];
       
          $ext = strtolower(pathinfo($ImageName,PATHINFO_EXTENSION));

      
          $allowed_extension = array("jpg","jpeg","png","gif");

          @$target_dir = "uploads/gallary/";
          @$thumbnail = $ImageName.time().'.'.$ext;
          @$uploadpath = $target_dir.$ImageName.time().'.'.$ext;        

         if( in_array($ext,$allowed_extension) ){
   

      

 $sql = "INSERT INTO `images` ( `title`, `slug`, `description`, `thumbnail`, `parent`, `status`, `created_on`) 
              VALUES ('$title', '$slug', '$description', '$thumbnail', '$parent_id', '$status', '$date_time')";              

        
        
                if ($conn->query($sql)) {
                echo "<script type= 'text/javascript'>alert('Saved successfully');</script>";
                 $status_file=  move_uploaded_file($_FILES['Image']['tmp_name'], $uploadpath);
                    //echo "Image Uploaded";
                    $_SESSION['msg']="Data Submitted..";

                } 
                else {
                echo "<script type= 'text/javascript'>alert('Error: " . $sql . "<br>" . $conn->error."');</script>";
                }

         
               
         }
            
      }


      else{

        
            $thumbnail = 'noname.jpg';
        
             echo   $sql = "INSERT INTO `images` ( `title`, `slug`, `description`, `thumbnail`,  `parent`, `status`, `created_on`) 
              VALUES ('$title', '$slug', '$description', '$thumbnail', '$parent_id', '$status', 'date_time')";               


        
        
                if ($conn->query($sql)) {
                echo "<script type= 'text/javascript'>alert('Saved successfully');</script>";

                if ($thumbnail != 'noname.jpg') {
                      move_uploaded_file($_FILES['Image']['tmp_name'],$thumbnail);               
                }

                 // move_uploaded_file($_FILES['Image']['tmp_name'],$newimgname);
                    //echo "Image Uploaded";

                    $_SESSION['msg']="Data Submitted..";

                } 
                else {
                echo "<script type= 'text/javascript'>alert('Error: " . $sql . "<br>" . $conn->error."');</script>";
                }
      } 


    }

 if (isset($_GET['edit'])&&isset($_GET['id']) ) {
          $id = $_GET['id'];
          $query = "SELECT * FROM images  WHERE id =$id";
           $stmt = $conn->prepare($query);
           $stmt->execute();

          $num = $stmt->rowCount(); 
          if($num>0){   
              $row = $stmt->fetch(PDO::FETCH_ASSOC);
              extract($row);
              $id_edit = $id;
              $title_edit = $title;
              $description_edit = $description;             
              $status_edit = $status;
              $parent_id_edit = $parent;
              $edit_slug = $slug;
              $thumbnail_edit = '';
              }
      }

    if(isset($_POST['edit_value'])){

       $id= $_POST['id_edit'];
        $title = $_POST["title"];        
        $description = $_POST["description"];         
        $status = $_POST['status'];
        $parent_id = $_POST['parent_id'];
        $slug = $_POST["slug"];
        $thumbnail = '';     

    if (isset($_FILES['Image']) && $_FILES['Image']['error']==0) { 
          $ImageName =  $_FILES['Image']['name'];
          @$tempName  = $_FILES['Image']['temp_name'];          
          $ext = strtolower(pathinfo($ImageName,PATHINFO_EXTENSION));        
          $allowed_extension = array("jpg","jpeg","png","gif");

          @$target_dir = "uploads/gallary/";
          @$thumbnail = $ImageName.time().'.'.$ext;
          @$uploadpath = $target_dir.$ImageName.time().'.'.$ext;          
         if( in_array($ext,$allowed_extension) ){   
        



        $sql="UPDATE images SET title ='$title',  slug='$slug', description='$description', thumbnail='$thumbnail', parent='$parent_id', status='$status' WHERE id = $id";

        
        
                if ($conn->query($sql)) {
                echo "<script type= 'text/javascript'>alert('Updated successfully');</script>";
                echo $status_file=  move_uploaded_file($_FILES['Image']['tmp_name'], $uploadpath);
                    // echo "Image Uploaded";
                    $_SESSION['msg']="Data Submitted..";

                } 
                else {
                echo "<script type= 'text/javascript'>alert('Error:');</script>";
                }

         
               
         }
            
      }
      else{
              echo  $thumbnail = 'noname.jpg';
    $sql="UPDATE images SET title ='$title',  slug='$slug', description='$description', parent='$parent_id',  status='$status' WHERE id = $id";
            
                    if ($conn->query($sql)) {
                    echo "<script type= 'text/javascript'>alert('Updated Successfully');</script>";
                    
                       // echo "Data Uploaded";

                        $_SESSION['msg']="Data Submitted..";

                    } 
                    else {
                    echo "<script type= 'text/javascript'>alert('Error: ');</script>";
                    }
         } 


        

    }


?>





<!DOCTYPE html>
<html>
    <head>
        <title>Add Images</title>
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
                    <h1><span class="ion-speedometer"></span> Add Category </h1>
<!--
                    <p>
                        Welcome back, Èrik Campobadal
                    </p>
-->
                    <ul class="uk-breadcrumb">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="images.php">images</a></li>                        
                        <li><a href="add-image.php">Add Images</a></li>
                    </ul>
                </div>
            </div>
            <div class="uk-section-small">
                <div class="uk-container uk-container-large">
                    <div uk-grid class="uk-child-width-1-1@s uk-child-width-1-1@l">
                        <div>
                            <div class="uk-card uk-card-default">
                                <div class="uk-card-header">
                                   

                                    <?php if(isset($_GET['edit'])){ ?>
                                                   Edit                               
                                            <?php }else{ ?>
                                                    Add 
                                             <?php   }

                                                ?>
                                                               
                                </div>
                                <div class="uk-card-body">
                                  <form method="post" action="add-image.php" enctype="multipart/form-data">
                                        <fieldset class="uk-fieldset">

                                            
                                            <input type="hidden" name="id_edit" value="<?php if(isset($id_edit)){echo $id_edit;}?>">

                                            <div class="uk-margin">
                                                <label>Title</label>
                                                <div class="uk-position-relative">
                                                    <span class="uk-form-icon ion-android-person"></span>
                                                    <input name="title" class="uk-input" type="text" placeholder="Title" value="<?php if (isset($title_edit)){echo $title_edit;} ?>">
                                                    
                                                </div>
                                            </div>



                                            <div class="uk-margin">
                                                <label>Select Image</label>
                                                <div class="uk-position-relative">
                                                    <span class="uk-form-icon ion-android-person"></span>
                                                    <input name="Image" class="uk-input" type="file" placeholder="Code">
                                                </div>
                                            </div>

                                         

                                             <div class="uk-margin">
                                                <label>Status</label>
                                                <div class="uk-position-relative">
                                                   <!--  <span class="uk-form-icon ion-edit"></span> -->
                                                    <select class="uk-select" name="status" style="padding-left:25px;">
                                                       <!--  <option <?php if(!isset($status_edit)){echo 'selected="selected"';}?>>Status</option> -->
                                                        <option value="1" <?php if(isset($status_edit) && $status_edit == '1'){echo 'selected="selected"';}?>>Active</option>
                                                        <option value="0" <?php if( isset($status_edit) && $status_edit == '0'){echo 'selected="selected"';}?> >Inactive</option>
                                                    </select>

                                                </div>
                                            </div>


                                            <div class="uk-margin">
                                                <?php if(isset($_GET['edit'])){ ?>
                                                    <input type="submit" value="Edit" name="edit_value" class="uk-button uk-button-primary">
                                                    
                                            <?php }else{ ?>
                                                   <input type="submit" value="Submit" name="submit" class="uk-button uk-button-primary">    


                                             <?php   }

                                                ?>
                                                
                                                   
                                            </div>
                                            <hr />
                                        </fieldset>
                                    </form>
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