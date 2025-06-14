<?php
// Параметры подключения к базе данных
$host = 'localhost';      // адрес сервера базы данных
$db   = 'autoschool';  // имя базы данных
$user = 'user';       // имя пользователя
$pass = 'pass';       // пароль
$charset = 'utf8mb4';

// Создаем подключение с помощью PDO
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // выбрасывать исключения при ошибках
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // ассоциативный массив по умолчанию
    PDO::ATTR_EMULATE_PREPARES   => false,                  // отключаем эмуляцию подготовленных выражений
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    // При ошибке подключения можно вывести сообщение или логировать
    echo "Ошибка подключения к базе данных: " . $e->getMessage();
    exit;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>О нас - Тачка на прокачку</title>
    <link rel="stylesheet" href="styles.css" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
</head>
<body>
    <header>
        <div class="header-container">
            <div class="logo">
                <img src="logo.png" alt="Логотип Тачка на прокачку" />
                <h1>Тачка на прокачку</h1>
            </div>
            <nav>
                <ul class="nav-links">
                    <li><a href="index.php">Главная</a></li>
                    <li><a href="about.php" class="active">О нас</a></li>
                    <li><a href="faq.php">FAQ</a></li>
                </ul>
                <div class="burger-menu">
                    <i class="fas fa-bars"></i>
                </div>
            </nav>
            <button class="btn-register" id="btnOpenAuthModal">Записаться</button>
        </div>
    </header>

    <main>
        <section class="about-hero">
            <h1>О нашей автошколе</h1>
            <p>Профессиональное обучение вождению с 2010 года</p>
        </section>

        <section class="about-history">
            <div class="about-container">
                <h2 class="section-title">Наша история</h2>
                <div class="timeline">
                    <div class="timeline-item">
                        <div class="timeline-year">2010</div>
                        <div class="timeline-content">
                            <h3>Основание автошколы</h3>
                            <p>Открытие первого учебного класса и начало работы с 3 инструкторами и 5 учебными автомобилями.</p>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-year">2013</div>
                        <div class="timeline-content">
                            <h3>Расширение автопарка</h3>
                            <p>Приобретение новых автомобилей и открытие курса по подготовке водителей категории А.</p>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-year">2016</div>
                        <div class="timeline-content">
                            <h3>Современные технологии</h3>
                            <p>Внедрение интерактивных тренажеров и онлайн-обучения теории.</p>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-year">2020</div>
                        <div class="timeline-content">
                            <h3>5000 выпускников</h3>
                            <p>Наш 5000-й ученик успешно сдал экзамен в ГИБДД.</p>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-year">2023</div>
                        <div class="timeline-content">
                            <h3>Новые программы</h3>
                            <p>Запуск курсов экстремального вождения и программ для водителей с опытом.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="about-mission">
            <div class="about-container">
                <h2 class="section-title">Наша миссия</h2>
                <div class="mission-content">
                    <div class="mission-text">
                        <p>Мы стремимся не просто научить наших студентов сдавать экзамены, а воспитать грамотных, уверенных и ответственных водителей, которые чувствуют себя комфортно на дорогах в любых условиях.</p>
                        <p>Наша цель - сделать дорожное движение безопаснее, а процесс обучения - максимально комфортным и эффективным для каждого ученика.</p>
                    </div>
                    <div class="mission-image">
                        <img src="mission.jpg" alt="Наша миссия" />
                    </div>
                </div>
            </div>
        </section>

        <section class="about-licenses">
            <div class="about-container">
                <h2 class="section-title">Лицензии и документы</h2>
                <div class="licenses-grid">
                    <div class="license-item">
                        <div class="license-image">
                            <img src="license1.jpg" alt="Лицензия" />
                        </div>
                        <div class="license-title">Лицензия на образовательную деятельность</div>
                    </div>
                    <div class="license-item">
                        <div class="license-image">
                            <img src="license2.jpg" alt="Сертификат" />
                        </div>
                        <div class="license-title">Сертификат соответствия стандартам</div>
                    </div>
                    <div class="license-item">
                        <div class="license-image">
                            <img src="license3.jpg" alt="Благодарность" />
                        </div>
                        <div class="license-title">Благодарность от ГИБДД</div>
                    </div>
                </div>
            </div>
        </section>

        <section class="about-team">
            <div class="about-container">
                <h2 class="section-title">Наша команда</h2>
                <div class="team-grid">
                    <div class="team-member">
                        <img src="director.jpg" alt="Директор" />
                        <h3>СФ Мидовый</h3>
                        <p>Директор автошколы</p>
                        <p>Опыт работы: 15 лет</p>
                    </div>
                    <div class="team-member">
                        <img src="methodist.jpg" alt="Методист" />
                        <h3>эщкерямбус</h3>
                        <p>Главный методист</p>
                        <p>Опыт работы: 12 лет</p>
                    </div>
                    <div class="team-member">
                        <img src="technician.jpg" alt="Техник" />
                        <h3>Павел Техник</h3>
                        <p>Главный техник</p>
                        <p>Опыт работы: 10 лет</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <!-- Здесь можно добавить содержимое подвала -->
    </footer>

    <div id="modal" class="modal" aria-hidden="true" role="dialog" aria-labelledby="modalTitle" aria-modal="true">
        <div class="modal-content">
            <button type="button" class="modal-close" aria-label="Закрыть окно">&times;</button>
            <h2 id="modalTitle">Оставьте заявку</h2>
            <form id="application-form" novalidate>
                <label for="fullname">ФИО:</label>
                <input type="text" id="fullname" name="fullname" required placeholder="Введите ваше ФИО" autocomplete="name" />

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required placeholder="Введите ваш email" autocomplete="email" />

                <label for="phone">Телефон:</label>
                <input type="tel" id="phone" name="phone" required placeholder="+7 (___) ___-__-__" />

                <button type="submit" class="btn-submit">Отправить</button>
            </form>
        </div>
    </div>
    <!-- Модальное окно входа/регистрации -->
<div id="authModal" class="modal" aria-hidden="true" role="dialog" aria-labelledby="authModalTitle" aria-modal="true" style="display:none;">
  <div class="modal-content auth-modal-content">
    <button type="button" class="modal-close" aria-label="Закрыть окно">&times;</button>
    <h2 id="authModalTitle">Вход / Регистрация</h2>
    <div class="auth-tabs">
      <button class="tab-button active" data-tab="login">Вход</button>
      <button class="tab-button" data-tab="register">Регистрация</button>
    </div>
    <div class="tab-content active" id="login">
      <form id="loginForm" novalidate>
        <label for="loginEmail">Email:</label>
        <input type="email" id="loginEmail" name="loginEmail" required placeholder="Введите ваш email" autocomplete="email" />
        
        <label for="loginPassword">Пароль:</label>
        <input type="password" id="loginPassword" name="loginPassword" required placeholder="Введите пароль" autocomplete="current-password" />
        
        <button type="submit" class="btn-submit">Войти</button>
      </form>
    </div>
    <div class="tab-content" id="register">
      <form id="registerForm" novalidate>
        <label for="regName">Имя:</label>
        <input type="text" id="regName" name="regName" required placeholder="Введите имя" autocomplete="name" />
        
        <label for="regEmail">Email:</label>
        <input type="email" id="regEmail" name="regEmail" required placeholder="Введите email" autocomplete="email" />
        
        <label for="regPassword">Пароль:</label>
        <input type="password" id="regPassword" name="regPassword" required placeholder="Введите пароль" autocomplete="new-password" />
        
        <button type="submit" class="btn-submit">Зарегистрироваться</button>
      </form>
    </div>
  </div>
</div>


    <script src="script.js"></script>
</body>
</html>
