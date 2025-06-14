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
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>FAQ - Тачка на прокачку</title>
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
          <li><a href="about.php">О нас</a></li>
          <li><a href="faq.php" class="active">FAQ</a></li>
        </ul>
        <div class="burger-menu">
          <i class="fas fa-bars"></i>
        </div>
      </nav>
      <button class="btn-register">Записаться</button>
    </div>
  </header>

  <main>
    <section class="faq-hero">
      <h1>Часто задаваемые вопросы</h1>
      <p>Найдите ответы на самые популярные вопросы</p>
    </section>

    <section class="faq-content">
      <div class="faq-container">
        <div class="faq-categories">
          <h3>Категории вопросов</h3>
          <ul>
            <li>
              <button
                type="button"
                class="category-btn active"
                data-category="all"
                aria-pressed="true"
              >
                Все вопросы
              </button>
            </li>
            <li>
              <button
                type="button"
                class="category-btn"
                data-category="general"
                aria-pressed="false"
              >
                Общие
              </button>
            </li>
            <li>
              <button
                type="button"
                class="category-btn"
                data-category="theory"
                aria-pressed="false"
              >
                Теоретический курс
              </button>
            </li>
            <li>
              <button
                type="button"
                class="category-btn"
                data-category="practice"
                aria-pressed="false"
              >
                Практические занятия
              </button>
            </li>
            <li>
              <button
                type="button"
                class="category-btn"
                data-category="documents"
                aria-pressed="false"
              >
                Документы
              </button>
            </li>
            <li>
              <button
                type="button"
                class="category-btn"
                data-category="exams"
                aria-pressed="false"
              >
                Экзамены
              </button>
            </li>
          </ul>
        </div>
        <div class="faq-questions">
          <div class="faq-search">
            <input type="search" placeholder="Поиск по вопросам..." aria-label="Поиск по вопросам" />
            <button type="button" aria-label="Поиск"><i class="fas fa-search"></i></button>
          </div>
          <div class="faq-accordion" role="region" aria-live="polite">
            <div class="accordion-item" data-category="general">
              <div
                class="accordion-header"
                role="button"
                tabindex="0"
                aria-expanded="false"
                aria-controls="acc1-content"
                id="acc1-header"
              >
                <h3>Сколько длится обучение в автошколе?</h3>
                <i class="fas fa-chevron-down" aria-hidden="true"></i>
              </div>
              <div class="accordion-content" id="acc1-content" role="region" aria-labelledby="acc1-header" hidden>
                <p>Срок обучения зависит от выбранной категории:</p>
                <ul>
                  <li>Категория B - 2,5 месяца</li>
                  <li>Категория A - 1,5 месяца</li>
                  <li>Категория C - 3 месяца</li>
                  <li>Курс экстремального вождения - 2 недели</li>
                </ul>
                <p>График занятий можно подобрать индивидуально.</p>
              </div>
            </div>

            <div class="accordion-item" data-category="general">
              <div
                class="accordion-header"
                role="button"
                tabindex="0"
                aria-expanded="false"
                aria-controls="acc2-content"
                id="acc2-header"
              >
                <h3>Какие документы нужны для поступления?</h3>
                <i class="fas fa-chevron-down" aria-hidden="true"></i>
              </div>
              <div class="accordion-content" id="acc2-content" role="region" aria-labelledby="acc2-header" hidden>
                <p>Для записи в автошколу вам понадобятся:</p>
                <ul>
                  <li>Паспорт (копия)</li>
                  <li>Медицинская справка (можно оформить у нас)</li>
                  <li>3 фотографии 3×4 см</li>
                  <li>Для несовершеннолетних - согласие родителей</li>
                </ul>
              </div>
            </div>

            <!-- Добавьте остальные элементы с уникальными id и aria -->
          </div>
        </div>
      </div>
    </section>
  </main>

  <footer>
    <div class="footer-container">
      <div class="footer-about">
        <h3>Тачка на прокачку</h3>
        <p>© 2024 Все права защищены</p>
        <p>Адрес: г. Москва, ул. Примерная, д. 10</p>
        <p>Телефон: +7 (495) 123-45-67</p>
        <p>Email: info@tachkanaprokachku.ru</p>
      </div>
      <div class="footer-social">
        <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
        <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
        <a href="#" aria-label="VK"><i class="fab fa-vk"></i></a>
        <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
      </div>
    </div>
  </footer>

  <div
    id="modal"
    class="modal"
    role="dialog"
    aria-modal="true"
    aria-labelledby="modalTitle"
    aria-hidden="true"
  >
    <div class="modal-content">
      <button type="button" class="modal-close" aria-label="Закрыть окно">&times;</button>
      <h2 id="modalTitle">Оставьте заявку</h2>
      <form id="application-form" novalidate>
        <label for="fullname">ФИО:</label>
        <input
          type="text"
          id="fullname"
          name="fullname"
          required
          placeholder="Введите ваше ФИО"
          autocomplete="name"
        />

        <label for="email">Email:</label>
        <input
          type="email"
          id="email"
          name="email"
          required
          placeholder="Введите ваш email"
          autocomplete="email"
        />

        <label for="phone">Телефон:</label>
         <input
         type="tel"
         id="phone"
         name="phone"
         required
         placeholder="+7 (___) ___-__-__"
         autocomplete="tel"
        />

        <button type="submit" class="btn-submit">Отправить</button>
      </form>
    </div>
  </div>

  <script>
    // Аккордеон с ARIA
    const accordionHeaders = document.querySelectorAll('.accordion-header');
    accordionHeaders.forEach((header) => {
      header.addEventListener('click', () => {
        const expanded = header.getAttribute('aria-expanded') === 'true';
        const content = document.getElementById(header.getAttribute('aria-controls'));

        if (expanded) {
          header.setAttribute('aria-expanded', 'false');
          content.hidden = true;
          header.querySelector('i').classList.replace('fa-chevron-up', 'fa-chevron-down');
          header.parentElement.classList.remove('active');
        } else {
          // Закрыть другие открытые
          accordionHeaders.forEach((h) => {
            h.setAttribute('aria-expanded', 'false');
            const c = document.getElementById(h.getAttribute('aria-controls'));
            if (c) c.hidden = true;
            h.querySelector('i').classList.replace('fa-chevron-up', 'fa-chevron-down');
            h.parentElement.classList.remove('active');
          });

          header.setAttribute('aria-expanded', 'true');
          content.hidden = false;
          header.querySelector('i').classList.replace('fa-chevron-down', 'fa-chevron-up');
          header.parentElement.classList.add('active');
        }
      });

      header.addEventListener('keydown', (e) => {
        if (e.key === 'Enter' || e.key === ' ') {
          e.preventDefault();
          header.click();
        }
      });
    });

    // Фильтрация по категориям с обновлением aria-pressed
    const categoryButtons = document.querySelectorAll('.category-btn');
    const accordionItems = document.querySelectorAll('.accordion-item');
    categoryButtons.forEach((button) => {
      button.addEventListener('click', () => {
        categoryButtons.forEach((btn) => {
          btn.classList.remove('active');
          btn.setAttribute('aria-pressed', 'false');
        });
        button.classList.add('active');
        button.setAttribute('aria-pressed', 'true');

        const selectedCategory = button.getAttribute('data-category');
        accordionItems.forEach((item) => {
          if (selectedCategory === 'all' || item.getAttribute('data-category') === selectedCategory) {
            item.style.display = 'block';
          } else {
            item.style.display = 'none';
          }
        });
      });
    });

    // Поиск по вопросам
    const searchInput = document.querySelector('.faq-search input');
    const searchButton = document.querySelector('.faq-search button');

    function filterQuestions() {
      const query = searchInput.value.toLowerCase();
      accordionItems.forEach((item) => {
        const question = item.querySelector('.accordion-header h3').textContent.toLowerCase();
        if (question.includes(query)) {
          item.style.display = 'block';
        } else {
          item.style.display = 'none';
        }
      });
      // Сбрасываем активность категорий при поиске
      categoryButtons.forEach((btn) => {
        btn.classList.remove('active');
        btn.setAttribute('aria-pressed', 'false');
      });
    }

    searchInput.addEventListener('input', filterQuestions);
    searchButton.addEventListener('click', (e) => {
      e.preventDefault();
      filterQuestions();
    });

    // Бургер-меню для мобильных
    const burgerMenu = document.querySelector('.burger-menu');
    const navLinks = document.querySelector('.nav-links');
    burgerMenu.addEventListener('click', () => {
      navLinks.classList.toggle('nav-active');
      burgerMenu.querySelector('i').classList.toggle('fa-bars');
      burgerMenu.querySelector('i').classList.toggle('fa-times');
    });

    // Модальное окно
    const modal = document.getElementById('modal');
    const modalCloseBtn = modal.querySelector('.modal-close');
    const btnRegister = document.querySelector('.btn-register');

    btnRegister.addEventListener('click', () => {
      modal.setAttribute('aria-hidden', 'false');
      modal.style.display = 'block';
      modal.querySelector('input').focus();
    });

    modalCloseBtn.addEventListener('click', () => {
      modal.setAttribute('aria-hidden', 'true');
      modal.style.display = 'none';
      btnRegister.focus();
    });

    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && modal.getAttribute('aria-hidden') === 'false') {
        modalCloseBtn.click();
      }
    });
  </script>
</body>
</html>
