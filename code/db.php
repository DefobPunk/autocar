<?php
class DB
{
    // Объект PDO
    private $db;

    // Конструктор: подключение к БД
    public function __construct()
    {
        $host = 'localhost';
        $dbname = 'autoschool';  // замените на вашу БД
        $user = 'root';          // замените на пользователя
        $charset = 'utf8mb4';
        $pass = ''; // если пароль пустой, или ваш пароль


        $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

        try {
            $this->db = new PDO($dsn, $user, $pass);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // При ошибке подключения можно выбросить исключение или обработать иначе
            die('Connection failed: ' . $e->getMessage());
        }
    }

    // Выполнение запросов с параметрами
    // Возвращает: массив с результатами (fetchAll) или true при успешном INSERT/UPDATE/DELETE
    public function query($sql, $params = [])
    {
        $stmt = $this->db->prepare($sql);

        foreach ($params as $key => $value) {
            // Если ключ не начинается с ":", добавим ":"
            $paramKey = strpos($key, ':') === 0 ? $key : ':' . $key;
            $stmt->bindValue($paramKey, $value);
        }

        $stmt->execute();

        if (stripos(trim($sql), 'SELECT') === 0) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        // Для INSERT/UPDATE/DELETE возвращаем true
        return true;
    }
}