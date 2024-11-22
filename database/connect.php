<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "php_project";

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

// Đóng kết nối
// $conn->close();
?>
