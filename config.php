<?php
$servername = "localhost";
$username = "root";
$password = "123";
$dbname = "liuyanban";

// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);

// 检查连接
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>