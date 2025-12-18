<?php
$host = "sql201.infinityfree.com"; // Trung kiểm tra lại số này trong MySQL Details
$user = "if0_40712621";            // Username từ ảnh image_cc89ae.png
$pass = "klQM2OM8uldYT66";         // Password từ ảnh image_cc7e51.png
$db   = "if0_40712621_project2";   // Bạn cần vào Control Panel -> MySQL Databases tạo tên này trước

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Kết nối MySQL thất bại!");
}

// Tự tạo bảng users cho MySQL
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL
)";
mysqli_query($conn, $sql);
?>