<?php

$host = "localhost";
$db_name = "canyouthdmv_canyouthdb";
$username = "root";
$password = "";

  
try {
    $conn = new PDO("mysql:host={$host};dbname={$db_name}", $username, $password);
     //echo 'connection';
}
catch(PDOException $exception){
    echo "Connection error: " . $exception->getMessage();
}

//echo "connected";

 
// show error
