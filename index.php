<?php 
include 'db.php'; 

// Xử lý khi nhấn nút Thêm (Dùng hàm mysqli)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name']) && isset($_POST['email'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    
    $sql = "INSERT INTO users (name, email) VALUES ('$name', '$email')";
    mysqli_query($conn, $sql);
    
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// Lấy danh sách user (Dùng hàm mysqli)
$result = mysqli_query($conn, "SELECT * FROM users ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Project 2 - PHP & MySQL</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f0f2f5; display: flex; justify-content: center; padding: 40px; }
        .card { background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); width: 100%; max-width: 500px; }
        h1 { color: #1c1e21; font-size: 24px; text-align: center; }
        form { display: flex; flex-direction: column; gap: 10px; margin-bottom: 20px; }
        input { padding: 12px; border: 1px solid #ddd; border-radius: 6px; font-size: 16px; }
        button { padding: 12px; background-color: #0081ff; color: white; border: none; border-radius: 6px; cursor: pointer; font-size: 16px; font-weight: bold; }
        .user-list { list-style: none; padding: 0; }
        .user-item { background: #f8f9fa; padding: 10px; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; margin-bottom: 5px; border-radius: 4px; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Project 2: PHP & MySQL</h1>
        <p style="text-align: center;">Triển khai CI/CD lên InfinityFree</p>
        
        <form method="POST">
            <input type="text" name="name" placeholder="Nhập tên học viên" required>
            <input type="email" name="email" placeholder="Nhập email" required>
            <button type="submit">Thêm vào Database</button>
        </form>

        <hr>
        <h3>Danh sách thành viên:</h3>
        <ul class="user-list">
            <?php 
            if ($result && mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<li class='user-item'>
                            <strong>".htmlspecialchars($row['name'])."</strong> 
                            <span>".htmlspecialchars($row['email'])."</span>
                          </li>";
                }
            } else {
                echo "<li>Chưa có dữ liệu người dùng.</li>";
            }
            ?>
        </ul>
    </div>
</body>
</html>