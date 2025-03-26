<?php
header('Content-Type: application/json');
require 'config.php';

try {
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        throw new Exception("Invalid request method");
    }

    // 获取并验证输入
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $content = isset($_POST['content']) ? trim($_POST['content']) : '';

    if (empty($username) || empty($content)) {
        throw new Exception("昵称和内容不能为空");
    }

    if (mb_strlen($username) > 50) {
        throw new Exception("昵称长度超过限制");
    }

    if (mb_strlen($content) > 500) {
        throw new Exception("内容长度超过限制");
    }

    // 使用预处理语句
    $stmt = $conn->prepare("INSERT INTO messages (username, content) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $content);

    if (!$stmt->execute()) {
        throw new Exception("数据库错误: " . $stmt->error);
    }

    // 返回插入的时间戳
    header("Location:index.php");

} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ]);
}

$conn->close();
?>