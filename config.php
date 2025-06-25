<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "warranty_system";

// สร้างการเชื่อมต่อ
$conn = mysqli_connect($servername, $username, $password, $dbname);

// เช็คการเชื่อมต่อ
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
