<?php 
include 'db.php'; 

// Xử lý khi nhấn nút Thêm
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name']) && isset($_POST['email'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    
    // Sử dụng pg_query_params để bảo mật hơn (tránh SQL Injection)
    $sql = "INSERT INTO users (name, email) VALUES ($1, $2)";
    pg_query_params($conn, $sql, array($name, $email));
    
    // Refresh trang để thấy user mới ngay lập tức
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// Lấy danh sách user để hiển thị
$result = pg_query($conn, "SELECT * FROM users ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Project 2 - PHP & PostgreSQL</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f0f2f5; display: flex; justify-content: center; padding: 40px; }
        .card { background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); width: 100%; max-width: 500px; }
        h1 { color: #1c1e21; font-size: 24px; text-align: center; }
        form { display: flex; flex-direction: column; gap: 10px; margin-bottom: 20px; }
        input { padding: 12px; border: 1px solid #ddd; border-radius: 6px; font-size: 16px; }
        button { padding: 12px; background-color: #0081ff; color: white; border: none; border-radius: 6px; cursor: pointer; font-size: 16px; font-weight: bold; }
        button:hover { background-color: #0069d9; }
        .user-list { list-style: none; padding: 0; }
        .user-item { background: #f8f9fa; padding: 10px; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; }
        .status { font-size: 12px; text-align: center; color: #666; margin-top: 10px; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Project 2: PHP & PostgreSQL</h1>
        <p style="text-align: center;">Hệ thống triển khai tự động (CI/CD)</p>
        
        <form method="POST">
            <input type="text" name="name" placeholder="Nhập tên học viên" required>
            <input type="email" name="email" placeholder="Nhập email" required>
            <button type="submit">Thêm vào Database</button>
        </form>

        <hr>
        <h3>Danh sách User hiện có:</h3>
        <ul class="user-list">
            <?php 
            if ($result) {
                while($row = pg_fetch_assoc($result)) {
                    echo "<li class='user-item'>
                            <strong>".htmlspecialchars($row['name'])."</strong> 
                            <span>".htmlspecialchars($row['email'])."</span>
                          </li>";
                }
            } else {
                echo "<li>Chưa có dữ liệu.</li>";
            }
            ?>
        </ul>
        <div class="status">Host: project2php.wuaze.com</div>
    </div>
</body>
</html>