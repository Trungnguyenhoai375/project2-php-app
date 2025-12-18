<?php 
include 'db.php'; 

// Xử lý thêm User cho MySQL
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name']) && isset($_POST['email'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    
    $sql = "INSERT INTO users (name, email) VALUES ('$name', '$email')";
    mysqli_query($conn, $sql);
    
    header("Location: index.php");
    exit;
}

// Lấy danh sách cho MySQL
$result = mysqli_query($conn, "SELECT * FROM users ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Project 2 - PHP & MySQL</title>
    <style>
        body { font-family: sans-serif; background-color: #f0f2f5; display: flex; justify-content: center; padding: 40px; }
        .card { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); width: 400px; }
        input { width: 90%; padding: 10px; margin-bottom: 10px; border: 1px solid #ddd; }
        button { width: 100%; padding: 10px; background: #0081ff; color: white; border: none; cursor: pointer; }
        .user-item { background: #eee; margin-top: 5px; padding: 8px; border-radius: 4px; }
    </style>
</head>
<body>
    <div class="card">
        <h2>Project 2: PHP & MySQL</h2>
        <form method="POST">
            <input type="text" name="name" placeholder="Tên" required>
            <input type="email" name="email" placeholder="Email" required>
            <button type="submit">Thêm User</button>
        </form>
        <hr>
        <h3>Danh sách:</h3>
        <?php 
        if ($result) {
            while($row = mysqli_fetch_assoc($result)) {
                echo "<div class='user-item'>".$row['name']." - ".$row['email']."</div>";
            }
        }
        ?>
    </div>
</body>
</html>