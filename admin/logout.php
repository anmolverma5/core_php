<?php
ob_start();
session_start();

if (isset($_SESSION['admin_login_user'])) {
	unset($_SESSION['admin_login_id']);
	unset($_SESSION['admin_login_user']);

	header("location:login.php");
}


session_destroy();


?>