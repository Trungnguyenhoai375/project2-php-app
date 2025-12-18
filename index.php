<?php 
include 'db.php'; 

// Xử lý khi nhấn nút Thêm (Dùng cho MySQL)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name']) && isset($_POST['email'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    
    $sql = "INSERT INTO users (name, email) VALUES ('$name', '$email')";
    mysqli_query($conn, $sql);
    
    header("Location: index.php");
    exit;
}

// Lấy danh sách user (Dùng cho MySQL)
$result = mysqli_query($conn, "SELECT * FROM users ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Project 2 - Success</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background-color: #f0f2f5; display: flex; justify-content: center; padding: 40px; }
        .card { background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); width: 450px; text-align: center; }
        input { width: 90%; padding: 12px; margin-bottom: 15px; border: 1px solid #ddd; border-radius: 6px; }
        button { width: 95%; padding: 12px; background: #0081ff; color: white; border: none; border-radius: 6px; cursor: pointer; font-weight: bold; }
        .user-item { background: #f8f9fa; margin-top: 10px; padding: 12px; border-radius: 6px; display: flex; justify-content: space-between; border: 1px solid #eee; }
    </style>
</head>
<body>
    <div class="card">
        <h2> Project 2: Kết nối MySQL Thành công!</h2>
        <form method="POST">
            <input type="text" name="name" placeholder="Tên học viên" required>
            <input type="email" name="email" placeholder="Email" required>
            <button type="submit">Thêm vào Database</button>
        </form>
        <hr style="margin: 25px 0;">
        <h3>Danh sách học viên:</h3>
        <div id="list">
            <?php 
            if ($result && mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='user-item'>
                            <strong>".htmlspecialchars($row['name'])."</strong>
                            <span>".htmlspecialchars($row['email'])."</span>
                          </div>";
                }
            } else { echo "Chưa có dữ liệu. Hãy thêm người đầu tiên!"; }
            ?>
        </div>
    </div>
</body>
</html>