<?php
$host = "sqlxxx.infinityfree.com"; // Lấy trong MySQL Details
$user = "if0_40712621"; // Lấy trong ảnh image_cc89ae.png
$pass = "klQM2OM8uldYT66"; // Lấy trong ảnh image_cc7e51.png
$db   = "if0_40712621_project2"; // Bạn phải vào Control Panel tạo DB trước

$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) { die("Kết nối MySQL thất bại!"); }
?>