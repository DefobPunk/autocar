<?php
header('Content-Type: application/json');
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

if (!$data || empty($data['fullname']) || empty($data['email']) || empty($data['phone'])) {
    http_response_code(400);
    echo json_encode(['error' => 'All fields are required']);
    exit;
}

try {
    $db = new DB();

    $sql = "INSERT INTO applications (fullname, email, phone, course) VALUES (:fullname, :email, :phone, :course)";
    $params = [
        'fullname' => $data['fullname'],
        'email' => $data['email'],
        'phone' => $data['phone'],
        'course' => $data['course'] ?? null,
    ];

    $db->query($sql, $params);

    echo json_encode(['success' => true, 'message' => 'Application submitted successfully']);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}
