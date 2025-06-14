<?php
session_start();

class Database {
    private $host;
    private $db;
    private $user;
    private $passwd;
    private $charset;
    private $pdo;

    public function __construct($iniFileName){
        $this->dbSettings = parse_ini_file($iniFileName);
        $this->host = $this->dbSettings['HOST'];
        $this->db = $this->dbSettings['DB'];
        $this->user = $this->dbSettings['USER'];
        $this->passwd = $this->dbSettings['PASSWD'];
        $this->charset = $this->dbSettings['CHARSET'];

        $this->pdo = $this->connect();
    }

    private function connect(){
        return new PDO(
            "mysql:host=$this->host;dbname=$this->db;charset=$this->charset",
            $this->user,
            $this->passwd,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]
        );
    }

    public function getConnection(){
        return $this->pdo;
    }
}

// Пример использования: регистрация пользователя автошколы
// Ожидаем JSON с fullname, email, phone, password

header('Content-Type: application/json');

$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (!$data) {
    echo json_encode(['success' => false, 'error' => 'Некорректные данные']);
    exit;
}

$fullname = trim($data['fullname'] ?? '');
$email = trim($data['email'] ?? '');
$phone = trim($data['phone'] ?? '');
$password = trim($data['password'] ?? '');

if (!$fullname || !$email || !$password) {
    echo json_encode(['success' => false, 'error' => 'Заполните обязательные поля']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'error' => 'Некорректный email']);
    exit;
}

if ($phone === '' || $phone === null) {
    $phone = null;
}

try {
    $db = new Database('config.ini');
    $pdo = $db->getConnection();

    // Проверка уникальности email
    $stmt = $pdo->prepare("SELECT ID_Users FROM users WHERE Email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        echo json_encode(['success' => false, 'error' => 'Пользователь с таким email уже существует']);
        exit;
    }

    // Проверка уникальности телефона, если есть
    if ($phone !== null) {
        $stmt = $pdo->prepare("SELECT ID_Users FROM users WHERE Phone = ?");
        $stmt->execute([$phone]);
        if ($stmt->fetch()) {
            echo json_encode(['success' => false, 'error' => 'Пользователь с таким телефоном уже существует']);
            exit;
        }
    }

    $hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (Full_name, Email, Phone, Password) VALUES (?, ?, ?, ?)");
    $stmt->execute([$fullname, $email, $phone, $hash]);

    echo json_encode(['success' => true, 'message' => 'Регистрация прошла успешно']);

} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => 'Ошибка базы данных: ' . $e->getMessage()]);
}
