<?php 
include 'db.php'; 

// Xử lý khi nhấn nút Thêm
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $sql = "INSERT INTO users (name, email) VALUES ('$name', '$email')";
    pg_query($conn, $sql);
}

// Lấy danh sách user để hiển thị
$result = pg_query($conn, "SELECT * FROM users");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Project 2 - Add User</title>
</head>
<body>
    <h1>Thêm User (PHP & PostgreSQL)</h1>
    
    <form method="POST">
        <input type="text" name="name" placeholder="Nhập tên" required>
        <input type="email" name="email" placeholder="Nhập email" required>
        <button type="submit">Thêm User</button>
    </form>

    <hr>
    <h3>Danh sách User hiện có:</h3>
    <ul>
        <?php while($row = pg_fetch_assoc($result)): ?>
            <li><?php echo $row['name']; ?> - <?php echo $row['email']; ?></li>
        <?php endwhile; ?>
    </ul>
</body>
</html>