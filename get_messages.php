<?php
header('Content-Type: application/json');
require 'config.php';

try {
    $stmt = $conn->prepare("SELECT username, content, created_at FROM messages ORDER BY created_at DESC");
    $stmt->execute();
    $result = $stmt->get_result();
    
    $messages = [];
    while ($row = $result->fetch_assoc()) {
        $messages[] = $row;
    }

    echo json_encode($messages);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        "error" => "无法加载留言: " . $e->getMessage()
    ]);
}

$conn->close();
?>