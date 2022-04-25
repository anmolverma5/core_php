  <?php
    ob_start();
    session_start();


    // $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    // $parts = parse_url($url);
    // parse_str($parts['query'], $query);
    // $article_id =  $query['article_id'];


    if (!isset($_SESSION['admin_login_user'])) {
        header("Location:login.php");
    }
    include '../include/config.php';
    include '../include/functions.php';

    $categories_list = get_all_categories();
    $tags_list = get_all_tags();
    $topics_list = get_all_topics();
    $get_article_id = get_article_id();

    //print_r($tags_list); die();

    if (isset($_POST['submit'])) {



        //print_r($_POST); 

        $date_time = date("Y-m-d h:i:s");
        $title = $_POST["title"];
        $categories = $_POST["cate"];
        $tags = implode(',', $_POST['tags']);
        $topics = implode(',', $_POST['topics']);
        $status = $_POST['status'];
        // echo '</br>';
        // echo $slug = $_POST["slug"];
        $content = $_POST["description"];
        $thumbnail = '';
        //echo $scientific = $_POST['scientific'];
        $scientific = $_POST['scientific'];
        if ($scientific == 'on') {
            $scientific = 1;
        } else {
            $scientific = 0;
        }

        @$thumbnail = 'noname.jpg';

        if (isset($_FILES['Image']['name']) && $_FILES['Image']['name'] != '') {


            $ImageName =  $_FILES['Image']['name'];
            @$tempName  = $_FILES['Image']['temp_name'];

            $ext = strtolower(pathinfo($ImageName, PATHINFO_EXTENSION));


            $allowed_extension = array("jpg", "jpeg", "png", "gif");

            @$target_dir = "uploads/articles/";
            @$thumbnail = $ImageName . time() . '.' . $ext;
            @$uploadpath = $target_dir . $ImageName . time() . '.' . $ext;

            if (in_array($ext, $allowed_extension)) {

                $sql = "INSERT INTO `articles` ( `title`,`image`, `content`, `topics`, `categories`, `tags`, `scientific`, `status`, `created_on`) 
              VALUES ('$title', '$thumbnail', '$content', '$topics', '$categories', '$tags', '$scientific', '$status', '$date_time')";
            }
        } else {

            $sql = "INSERT INTO `articles` ( `title`, `content`, `topics`, `categories`, `tags`, `scientific`, `status`, `created_on`) 
              VALUES ('$title', '$content', '$topics', '$categories', '$tags', '$scientific', '$status', '$date_time')";
        }


        if ($thumbnail != 'noname.jpg') {
            move_uploaded_file($_FILES['Image']['tmp_name'], $uploadpath);
        }






        //die();            




        if ($conn->query($sql)) {
            echo "<script type= 'text/javascript'>alert('Saved successfully');</script>";


            $_SESSION['msg'] = "Data Submitted..";
        } else {
            echo "<script type= 'text/javascript'>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
        }

        /* ANMOL */
        $targetDir = "./uploads/articles_images/";
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');

        $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = '';
        // var_dump($get_article_id);
        $get_article_id_new = $get_article_id[0]['id'] + 1;
        // var_dump($get_article_id_new);

        $fileNames = array_filter($_FILES['files']['name']);
        if (!empty($fileNames)) {
            foreach ($_FILES['files']['name'] as $key => $val) {
                // File upload path 
                $fileName = basename($_FILES['files']['name'][$key]);
                $targetFilePath = $targetDir . time() . $fileName;

                // Check whether file type is valid 
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
                if (in_array($fileType, $allowTypes)) {
                    // Upload file to server 
                    if (move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)) {
                        // Image db insert sql 
                        $insertValuesSQL .= "('" . time() . $fileName . "', NOW()," . $get_article_id_new . "),";
                    } else {
                        $errorUpload .= $_FILES['files']['name'][$key] . ' | ';
                    }
                } else {
                    $errorUploadType .= $_FILES['files']['name'][$key] . ' | ';
                }
            }

            // Error message 
            $errorUpload = !empty($errorUpload) ? 'Upload Error: ' . trim($errorUpload, ' | ') : '';
            $errorUploadType = !empty($errorUploadType) ? 'File Type Error: ' . trim($errorUploadType, ' | ') : '';
            $errorMsg = !empty($errorUpload) ? '<br/>' . $errorUpload . '<br/>' . $errorUploadType : '<br/>' . $errorUploadType;

            if (!empty($insertValuesSQL)) {
                $insertValuesSQL = trim($insertValuesSQL, ',');
                // Insert image file name into database 
                $insert = $db->query("INSERT INTO articles_images (file_name, created_on,article_id) VALUES $insertValuesSQL");
                if ($insert) {
                    $statusMsg = "Files are uploaded successfully." . $errorMsg;
                } else {
                    $statusMsg = "Sorry, there was an error uploading your file.";
                }
            } else {
                $statusMsg = "Upload failed! " . $errorMsg;
            }
        } else {
            $statusMsg = 'Please select a file to upload.';
        }

        /* ***************************** */
    }

    if (isset($_GET['edit']) && isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "SELECT * FROM articles  WHERE id =$id";
        $stmt = $conn->prepare($query);
        $stmt->execute();

        $num = $stmt->rowCount();
        if ($num > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            extract($row);
            $id_edit = $id;
            $title_edit = $title;
            $description_edit = $content;
            $status_edit = $status;
            $topics_edit = $topics;
            $categories_edit = $categories;
            $tags_edit = $tags;

            // $edit_slug = $slug;
            $thumbnail_edit = '';

            // $date_time = date("Y-m-d h:i:s");        
            // $title = $_POST["title"]; 
            // $categories = $_POST["cate"];
            // $tags = implode(',', $_POST['tags']);
            // $topics = implode(',', $_POST['topics']);      
            // $status = $_POST['status'];

            // $content = $_POST["description"];
            // $thumbnail = '';

            // $scientific = $_POST['scientific'];




        }
    }

    if (isset($_POST['edit_value'])) {
        $id = $_POST['id_edit'];

        $date_time = date("Y-m-d h:i:s");
        $title = $_POST["title"];
        $categories = $_POST["cate"];
        $tags = implode(',', $_POST['tags']);
        $topics = implode(',', $_POST['topics']);
        $status = $_POST['status'];
        // echo '</br>';
        // echo $slug = $_POST["slug"];
        $content = $_POST["description"];
        $thumbnail = '';
        //echo $scientific = $_POST['scientific'];
        $scientific = $_POST['scientific'];
        @$thumbnail = 'noname.jpg';

        if (isset($_FILES['Image']['name']) && $_FILES['Image']['name'] != '') {


            $ImageName =  $_FILES['Image']['name'];
            @$tempName  = $_FILES['Image']['temp_name'];

            $ext = strtolower(pathinfo($ImageName, PATHINFO_EXTENSION));


            $allowed_extension = array("jpg", "jpeg", "png", "gif");

            @$target_dir = "uploads/articles/";
            @$thumbnail = $ImageName . time() . '.' . $ext;
            @$uploadpath = $target_dir . $ImageName . time() . '.' . $ext;

            if ($scientific == 'on') {
                $scientific = 1;
            } else {
                $scientific = 0;
            }
        }
        if ($thumbnail != 'noname.jpg') {
            move_uploaded_file($_FILES['Image']['tmp_name'], $uploadpath);
        }

        $sql = "UPDATE articles SET title ='$title', image='$thumbnail'  ,categories='$categories', tags='$tags',
         topics='$topics', content='$content', scientific='$scientific', status='$status' WHERE id = $id";



        if ($conn->query($sql)) {
            echo "<script type= 'text/javascript'>alert('Updated successfully');</script>";
            // echo $status_file=  move_uploaded_file($_FILES['Image']['tmp_name'], $uploadpath);
            // echo "Image Uploaded";
            $_SESSION['msg'] = "Data Submitted..";
        } else {
            echo "<script type= 'text/javascript'>alert('Error:');</script>";
        }

        $targetDir = "./uploads/articles_images/";
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');

        $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = '';
        // var_dump($get_article_id);
        $get_article_id_new = $id;
        // var_dump($get_article_id_new);

        $fileNames = array_filter($_FILES['files']['name']);
        if (!empty($fileNames)) {
            foreach ($_FILES['files']['name'] as $key => $val) {
                // File upload path 
                $fileName = basename($_FILES['files']['name'][$key]);
                $targetFilePath = $targetDir . time() . $fileName;

                // Check whether file type is valid 
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
                if (in_array($fileType, $allowTypes)) {
                    // Upload file to server 
                    if (move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)) {
                        // Image db insert sql 
                        $insertValuesSQL .= "('" . time() . $fileName . "', NOW()," . $get_article_id_new . "),";
                    } else {
                        $errorUpload .= $_FILES['files']['name'][$key] . ' | ';
                    }
                } else {
                    $errorUploadType .= $_FILES['files']['name'][$key] . ' | ';
                }
            }

            // Error message 
            $errorUpload = !empty($errorUpload) ? 'Upload Error: ' . trim($errorUpload, ' | ') : '';
            $errorUploadType = !empty($errorUploadType) ? 'File Type Error: ' . trim($errorUploadType, ' | ') : '';
            $errorMsg = !empty($errorUpload) ? '<br/>' . $errorUpload . '<br/>' . $errorUploadType : '<br/>' . $errorUploadType;

            if (!empty($insertValuesSQL)) {
                $insertValuesSQL = trim($insertValuesSQL, ',');
                // Insert image file name into database 
                $insert = $db->query("INSERT INTO articles_images (file_name, created_on,article_id) VALUES $insertValuesSQL");
                if ($insert) {
                    $statusMsg = "Files are uploaded successfully." . $errorMsg;
                } else {
                    $statusMsg = "Sorry, there was an error uploading your file.";
                }
            } else {
                $statusMsg = "Upload failed! " . $errorMsg;
            }
        } else {
            $statusMsg = 'Please select a file to upload.';
        }

        header("Location: feature_post.php");
        //die();
    }


    ?>




  <!DOCTYPE html>
  <html>

  <head>
      <title>Add Articles - Dimapur24x7 Admin</title>
      <meta charset="UTF-8">
      <meta name="description" content="Clean and responsive administration panel">
      <meta name="keywords" content="Admin,Panel,HTML,CSS,XML,JavaScript">
      <meta name="author" content="Erik Campobadal">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="assets/css/uikit.min.css" />
      <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
      <link rel="stylesheet" href="assets/css/style.css" />
      <link rel="stylesheet" href="assets/css/notyf.min.css" />
      <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
      <script src="assets/js/uikit.min.js"></script>
      <script src="assets/js/uikit-icons.min.js"></script>


      <script src="ckeditor/ckeditor.js"></script>

  </head>

  <body>


      <?php include('sidebar.php'); ?>

      <div class="content-padder content-background">
          <div class="uk-section-small uk-section-default header">
              <div class="uk-container uk-container-large">
                  <h1><span class="ion-speedometer"></span> Add News </h1>
                  <!--
                    <p>
                        Welcome back, Èrik Campobadal
                    </p>
-->
                  <ul class="uk-breadcrumb">
                      <li><a href="index.php">Home</a></li>
                      <li><a href="articles.php">News</a></li>
                      <li><a href="add-article.php">Add News</a></li>
                  </ul>
              </div>
          </div>
          <div class="uk-section-small">
              <div class="uk-container uk-container-large">
                  <div uk-grid class="uk-child-width-1-1@s uk-child-width-1-1@l">
                      <div>
                          <div class="uk-card uk-card-default">
                              <div class="uk-card-header">


                                  <?php if (isset($_GET['edit'])) { ?>
                                      Edit
                                  <?php } else { ?>
                                      Add
                                  <?php   }

                                    ?>

                              </div>
                              <div class="uk-card-body">
                                  <form method="post" action="add-article.php" enctype="multipart/form-data">
                                      <fieldset class="uk-fieldset">


                                          <input type="hidden" name="id_edit" value="<?php if (isset($id_edit)) {
                                                                                            echo $id_edit;
                                                                                        } ?>">

                                          <div class="uk-margin">
                                              <label>Title</label>
                                              <div class="uk-position-relative">
                                                  <span class="uk-form-icon ion-android-person"></span>
                                                  <input name="title" class="uk-input" type="text" placeholder="Title" value="<?php if (isset($title_edit)) {
                                                                                                                                    echo $title_edit;
                                                                                                                                } ?>">

                                              </div>
                                          </div>

                                          <div class="uk-text-left" uk-grid>
                                              <div class="uk-width-1-3">
                                                  <label>Select Categories</label>
                                                  <select class="uk-select" id="categories" name="cate" style="width:300px">
                                                      <option value="">Select Category</option>
                                                      <?php
                                                        foreach ($categories_list as $category) { ?>
                                                          <option value="<?php echo $category['id']; ?>"><?php echo ucfirst($category['title']); ?></option>
                                                      <?php } ?>

                                                  </select>

                                              </div>
                                              <div class="uk-width-1-3">
                                                  <label>Select Subcategory</label>
                                                  <select class="uk-select" id="topics" name="topics[]" multiple="multiple" style="width:300px">
                                                      <?php
                                                        foreach ($topics_list as $topics) { ?>
                                                          <option value="<?php echo $topics['id']; ?>"><?php echo ucfirst($topics['title']); ?></option>
                                                      <?php } ?>

                                                  </select>
                                              </div>
                                              <div class="uk-width-1-3">
                                                  <label>Select Tags</label>
                                                  <select class="uk-select" id="tags" name="tags[]" multiple="multiple" style="width:300px">
                                                      <?php
                                                        foreach ($tags_list as $tags) { ?>
                                                          <option value="<?php echo $tags['id']; ?>"><?php echo ucfirst($tags['title']); ?></option>
                                                      <?php } ?>

                                                  </select>
                                              </div>
                                          </div>

                                          <div class="uk-text-left" uk-grid>
                                              <!-- <div class="uk-width-1-3">
                                              <label>Slug</label>
                                                <div class="uk-position-relative">
                                                
                                                    <input name="slug" class="uk-input" type="text" placeholder="Slug" value="<?php if (isset($edit_slug)) {
                                                                                                                                    echo $edit_slug;
                                                                                                                                } ?>">
                                                </div>
                                            </div> -->

                                              <div class="uk-width-1-3">
                                                  <label>Status</label>
                                                  <div class="uk-position-relative">
                                                      <!--  <span class="uk-form-icon ion-edit"></span> -->
                                                      <select class="uk-select" name="status" style="padding-left:25px;">
                                                          <!--  <option <?php if (!isset($status_edit)) {
                                                                            echo 'selected="selected"';
                                                                        } ?>>Status</option> -->
                                                          <option value="1" <?php if (isset($status_edit) && $status_edit == '1') {
                                                                                echo 'selected="selected"';
                                                                            } ?>>Active</option>
                                                          <option value="0" <?php if (isset($status_edit) && $status_edit == '0') {
                                                                                echo 'selected="selected"';
                                                                            } ?>>Inactive</option>
                                                      </select>

                                                  </div>
                                              </div>

                                              <div class="uk-width-1-3">
                                                  <label>Select Banner Image</label>
                                                  <div class="uk-position-relative">
                                                      <span class="uk-form-icon ion-android-person"></span>
                                                      <input name="Image" class="uk-input" type="file" placeholder="Code">
                                                  </div>
                                              </div>
                                              <div class="uk-width-1-3">
                                                  <label>Select 4 Images</label>
                                                  <div class="uk-position-relative">
                                                      <span class="uk-form-icon ion-android-person"></span>
                                                      <input name="files[]" class="uk-input" type="file" multiple>
                                                  </div>
                                              </div>
                                              <div class="uk-width-1-3">
                                                  <label>Exclusive News</label>
                                                  <div class="uk-position-relative">
                                                      <!-- <span class="uk-form-icon ion-android-person"></span> -->
                                                      <input name="scientific" class="uk-checkbox" type="checkbox" value="1">
                                                  </div>

                                              </div>
                                          </div>




                                          <div class="uk-margin">
                                              <label>Description</label>
                                              <div class="uk-position-relative">
                                                  <!--  <span class="uk-form-icon ion-android-call"></span> -->
                                                  <textarea name="description" id="txtEditor" class="ckeditor"><?php if (isset($description_edit)) {
                                                                                                                    echo $description_edit;
                                                                                                                } ?></textarea>

                                              </div>
                                          </div>

                                          <!-- <div class="editor"></div> -->

                                          <!--
                                            <div class="uk-margin">
                                                <div class="uk-position-relative">
                                                    <span class="uk-form-icon ion-locked"></span>
                                                    <input name="password_confirmation" class="uk-input" type="password" placeholder="Repeat Password">
                                                </div>
                                            </div>
-->

                                          <div class="uk-margin">
                                              <?php if (isset($_GET['edit'])) { ?>
                                                  <input type="submit" value="Edit" name="edit_value" class="uk-button uk-button-primary">

                                              <?php } else { ?>
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

      <script src="ckeditor/build/ckeditor.js"></script>
      <script src="assets/js/ckeditor-custom.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
      <script type="text/javascript">
          $("#categories").select2({
              //dropdownAutoWidth : true,
              width: '300',
              placeholder: 'Categories'
          });
          $("#topics").select2({
              //dropdownAutoWidth : true,
              width: '300',
              placeholder: 'Subcategories'
          });
          $("#tags").select2({
              //dropdownAutoWidth : true,
              width: '300',
              placeholder: 'Tags'
          });
      </script>
  </body>

  </html>