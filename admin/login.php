<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('../include/config.php');

session_start();



if (isset($_POST['login'])) {


   $user_name = strip_tags($_POST['user_name']);
   //$password = md5(strip_tags($_POST['password']));
   $password = strip_tags($_POST['password']);

  

  
    $query = "SELECT * FROM admin WHERE user_name='$user_name' AND password= '$password'";// die();
    $stmt = $conn->prepare($query);
    $stmt->execute();

    if (!$stmt) {
        echo $conn->error;
    }        
   $num = $stmt->rowCount();     
   
    if($num == 1){
       
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        extract($row);      

     $_SESSION['admin_login_user'] = $name;
     $_SESSION['admin_login_id'] = $id;
     header("Location:index.php");          
    } 
    else{
          echo "Invalid user";
        header("Location:login.php");
    }




}


?>




<!DOCTYPE html>
<html>
    <head>
        <title>BPS SECURITY - Login</title>

        <meta charset="UTF-8">
        <meta name="description" content="Clean and responsive administration panel">
        <meta name="keywords" content="Admin,Panel,HTML,CSS,XML,JavaScript">
        <meta name="author" content="Erik Campobadal">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="assets/css/uikit.min.css" />
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<link rel="stylesheet" href="assets/css/style.css" />
        <link rel="stylesheet" href="assets/css/notyf.min.css" />
        <script src="assets/js/uikit.min.js" ></script>
	<script src="assets/js/uikit-icons.min.js" ></script>
    </head>
    <body>
<!--
        <div uk-sticky="media: 960" class="uk-navbar-container tm-navbar-container uk-sticky uk-active" style="position: fixed; top: 0px; width: 1903px;">
            <div class="uk-container uk-container-expand">
                <nav uk-navbar>
                    <div class="uk-navbar-left">
                        <a href="#" class="uk-navbar-item uk-logo">
                            Yippee Dashboard
                        </a>
                    </div>
                </nav>
            </div>
        </div>
-->
        <div class="content-background">
            <div class="uk-section-large">
                <div class="uk-container uk-container-large">
                    <div uk-grid class="uk-child-width-1-1@s uk-child-width-2-3@l">
                        <div class="uk-width-1-1@s uk-width-1-5@l uk-width-1-3@xl"></div>
                        <div class="uk-width-1-1@s uk-width-3-5@l uk-width-1-3@xl">
                            <div class="uk-card uk-card-default">
                                <div class="uk-card-header">
                                    BPS SECURITY Admin Login
                                </div>
                                <div class="uk-card-body">
                                    <center>
                                        <h2>Login</h2><br />
                                    </center>
                                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
                                        <fieldset class="uk-fieldset">

                                            <div class="uk-margin">
                                                <div class="uk-position-relative">
                                                    <span class="uk-form-icon ion-android-person"></span>
                                                    <input name="user_name" class="uk-input" type="text" placeholder="user name">
                                                </div>
                                            </div>

                                            <div class="uk-margin">
                                                <div class="uk-position-relative">
                                                    <span class="uk-form-icon ion-locked"></span>
                                                    <input name="password" class="uk-input" type="password" placeholder="Password">
                                                </div>
                                            </div>

<!--
                                            <div class="uk-margin">
                                                <a href="#">Forgot your password?</a>
                                            </div>
-->

                                            <div class="uk-margin">
                                                <button type="submit" name='login' class="uk-button uk-button-primary">
                                                    <span class="ion-forward"></span>&nbsp; Sign In
                                                </button>
                                            </div>

                                            <hr />

<!--
                                            <center>
                                                <p>
                                                    You don't have an account yet?
                                                </p>
                                                <a href="register.php" class="uk-button uk-button-default">
                                                    <span class="ion-android-person-add"></span>&nbsp; Register
                                                </a>
                                            </center>
-->
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="uk-width-1-1@s uk-width-1-5@l uk-width-1-3@xl"></div>
                    </div>
                </div>
            </div>
        </div>
        <script src="assets/js/script.js"></script>
    </body>
</html>
