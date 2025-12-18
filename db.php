<?php
// 1. Dán link External Database URL của Trung vào đây
$db_url = "postgresql://project2_db_qwzc_user:eEH31TOiqezuqpAGeGub0ECsqDL0Ozmm@dpg-d51vq8buibrs739ji7c0-a.singapore-postgres.render.com/project2_db_qwzc";

// 2. Thực hiện kết nối
$conn = pg_connect($db_url);

if (!$conn) {
    die("Kết nối database thất bại!");
}

// 3. Tự động tạo bảng 'users' nếu chưa có (Để lưu User giống Project 1)
$sql_create_table = "CREATE TABLE IF NOT EXISTS users (
    id SERIAL PRIMARY KEY,
    name TEXT NOT NULL,
    email TEXT UNIQUE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

$result = pg_query($conn, $sql_create_table);

if (!$result) {
    echo "Lỗi khi tạo bảng: " . pg_last_error($conn);
}
?>