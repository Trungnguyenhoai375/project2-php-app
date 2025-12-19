<?php
error_reporting(E_ALL);
ini_set('display_errors', 1); 

$host = "sql204.infinityfree.com"; 
$user = "if0_40712621";            
$pass = "kIQM2OM8uldYT66"; 
$db   = "if0_40712621_project2";   

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Kết nối MySQL thất bại: " . mysqli_connect_error());
}
?>