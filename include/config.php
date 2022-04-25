<?php

$host = "localhost";
$db_name = "canyouthdmv_canyouthdb";
$username = "root";
$password = "";


$db = new mysqli($host, $username, $password, $db_name);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
try {
    $conn = new PDO("mysql:host={$host};dbname={$db_name}", $username, $password);
    //echo 'connection';
} catch (PDOException $exception) {
    echo "Connection error: " . $exception->getMessage();
}

//echo "connected";

 
// show error
