<?php
// register.php
header('Content-Type: application/json');

$host = 'localhost';
$db = 'autoschool';
$user = 'user';
$pass = 'pass';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Ошибка подключения к базе']);
    exit;
}

// Получаем JSON из тела запроса
$data = json_decode(file_get_contents('php://input'), true);

if (!$data) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Некорректные данные']);
    exit;
}

// Валидация данных
$fullname = trim($data['fullname'] ?? '');
$email = trim($data['email'] ?? '');
$phone = trim($data['phone'] ?? '');
$password = $data['password'] ?? '';

if (!$fullname || !$email || !$phone || !$password) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Заполните все поля']);
    exit;
}

// Проверка формата email и телефона, можно добавить

// Проверка, что email еще не зарегистрирован
$stmt = $pdo->prepare('SELECT id FROM users WHERE email = ?');
$stmt->execute([$email]);
if ($stmt->fetch()) {
    http_response_code(409);
    echo json_encode(['success' => false, 'error' => 'Пользователь с таким email уже существует']);
    exit;
}

// Хешируем пароль
$hash = password_hash($password, PASSWORD_DEFAULT);

// Вставляем пользователя в базу
$stmt = $pdo->prepare('INSERT INTO users (fullname, email, phone, password_hash) VALUES (?, ?, ?, ?)');
try {
    $stmt->execute([$fullname, $email, $phone, $hash]);
    echo json_encode(['success' => true, 'message' => 'Регистрация прошла успешно!']);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Ошибка при регистрации']);
}
