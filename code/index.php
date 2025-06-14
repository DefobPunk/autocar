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
  <title>Тачка на прокачку — автошкола</title>

  <!-- Основные стили -->
  <link rel="stylesheet" href="styles.css" />

  <!-- Иконки FontAwesome -->
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
  />

  <!-- Яндекс карты API -->
  <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" defer></script>
</head>
<body>
  <!-- Хедер с логотипом и навигацией -->
  <header class="header">
    <div class="container header__container">

      <!-- Логотип -->
      <a href="#" class="logo" aria-label="Главная">
        <img src="logo.png" alt="Тачка на Прокачку" />
        <span class="logo-text">Тачка на Прокачку</span>
      </a>

      <!-- Навигационное меню -->
      <nav class="nav" role="navigation" aria-label="Основное меню">
        <ul class="nav__list">
          <li><a href="index.php">Главная</a></li>
          <li><a href="about.php" class="nav__link">О нас</a></li>
          <li><a href="faq.php" class="nav__link">FAQ</a></li>
        </ul>
      </nav>

      <!-- Кнопка записи -->
      <button class="btn btn--primary btn--header" id="btnOpenAuth">Записаться</button>
    </div>
  </header>

  <!-- Главный баннер -->
  <section
    class="hero"
    id="about"
    role="banner"
    aria-label="Главный баннер"
  >
    <div class="container hero__container">
      <h1 class="hero__title">Научись водить как профи!</h1>
      <p class="hero__subtitle">
        Первое занятие — <strong class="highlight">бесплатно!</strong>
      </p>
      <button
        class="btn btn--primary hero__btn"
        id="btnOpenAuthHero"
      >
        Записаться на пробный урок
      </button>
    </div>
  </section>

  <main>
    <!-- Секция курсов -->
    <section class="courses" id="courses" aria-label="Наши курсы">
      <div class="container">
        <h2 class="section-title">Наши курсы</h2>

        <div class="courses__grid">
          <!-- Категория B -->
          <article class="course-card" tabindex="0" aria-labelledby="course-b-title">
            <i class="fa-solid fa-car course-card__icon" aria-hidden="true"></i>
            <h3 id="course-b-title" class="course-card__title">Категория B</h3>
            <p class="course-card__desc">Обучение на легковые автомобили</p>
            <ul class="course-card__details">
              <li>✔ Теория: 134 часа</li>
              <li>✔ Практика: 56 часов</li>
            </ul>
          </article>

          <!-- Категория A -->
          <article class="course-card" tabindex="0" aria-labelledby="course-a-title">
            <i class="fa-solid fa-motorcycle course-card__icon" aria-hidden="true"></i>
            <h3 id="course-a-title" class="course-card__title">Категория A</h3>
            <p class="course-card__desc">Обучение на мотоциклы</p>
            <ul class="course-card__details">
              <li>✔ Теория: 108 часов</li>
              <li>✔ Практика: 42 часа</li>
            </ul>
          </article>

          <!-- Категория C -->
          <article class="course-card course-card--highlight" tabindex="0" aria-labelledby="course-c-title">
            <i class="fa-solid fa-truck course-card__icon" aria-hidden="true"></i>
            <h3 id="course-c-title" class="course-card__title">Категория C</h3>
            <p class="course-card__desc">Обучение на грузовики</p>
            <ul class="course-card__details">
              <li>✔ Теория: 160 часов</li>
              <li>✔ Практика: 70 часов</li>
            </ul>
          </article>
        </div>
      </div>
    </section>

    <!-- Отзывы -->
    <section class="reviews" id="reviews" aria-label="Отзывы наших учеников">
      <div class="container">
        <h2 class="section-title">Отзывы</h2>

        <div class="reviews__carousel" tabindex="0">
          <button
            class="reviews__nav reviews__nav--prev"
            aria-label="Предыдущий отзыв"
          >
            &#8592;
          </button>

          <div class="reviews__track">
            <article class="review-card" aria-live="polite">
              <p class="review-text">
                "Отличная автошкола! Преподаватели очень внимательные и опытные."
              </p>
              <p class="review-author">— Анна К.</p>
            </article>

            <article class="review-card" aria-live="polite" hidden>
              <p class="review-text">
                "Благодаря курсам я сдал экзамен с первого раза. Рекомендую!"
              </p>
              <p class="review-author">— Иван П.</p>
            </article>

            <article class="review-card" aria-live="polite" hidden>
              <p class="review-text">
                "Удобное расписание и современный автопарк. Спасибо!"
              </p>
              <p class="review-author">— Мария С.</p>
            </article>
          </div>

          <button
            class="reviews__nav reviews__nav--next"
            aria-label="Следующий отзыв"
          >
            &#8594;
          </button>
        </div>
      </div>
    </section>

    <!-- Карта -->
    <section class="map-section" aria-label="Карта с расположением автошколы">
      <div class="container">
        <h2 class="section-title">Наше расположение</h2>
        <div
          id="yandex-map"
          style="width:100%; height:400px; border-radius:8px; box-shadow:0 2px 8px rgb(0 0 0 / 0.1);"
        ></div>
      </div>
    </section>

    <!-- QR-код -->
    <section class="qr-section" aria-label="QR-код для связи">
      <div class="container qr-container">
        <h2 class="section-title">Свяжитесь с нами через QR-код</h2>
        <img
          src="https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=https://tachkanaprokachku.ru"
          alt="QR-код для сайта Тачка на прокачку"
          class="qr-image"
        />
        <p>
          Сканируйте QR-код, чтобы быстро перейти на наш сайт или сохранить контакт.
        </p>
      </div>
    </section>
  </main>

  <!-- Футер с контактами и соцсетями -->
  <footer class="footer" id="contacts" aria-label="Контактная информация">
    <div class="container footer__container">
      <div class="footer__contacts">
        <h3>Контакты</h3>
        <p>📍 Москва, ул. Примерная, 12</p>
        <p>📞 +7 (495) 123-45-67</p>
        <p>✉ <a href="mailto:info@tachkanaprokachku.ru">info@tachkanaprokachku.ru</a></p>
        <p>⏰ Пн–Пт: 9:00–20:00</p>
      </div>

      <div class="footer__social">
        <h3>Мы в соцсетях</h3>
        <ul class="social-list" role="list">
          <li><a href="#" aria-label="Вконтакте" class="social-link"><i class="fa-brands fa-vk"></i></a></li>
          <li><a href="#" aria-label="Instagram" class="social-link"><i class="fa-brands fa-instagram"></i></a></li>
          <li><a href="#" aria-label="Telegram" class="social-link"><i class="fa-brands fa-telegram"></i></a></li>
          <li><a href="#" aria-label="YouTube" class="social-link"><i class="fa-brands fa-youtube"></i></a></li>
        </ul>
      </div>
    </div>

    <div class="footer__bottom">
      <p>© 2024 Тачка на прокачку. Все права защищены.</p>
    </div>
  </footer>

  <!-- Модальное окно входа/регистрации -->
  <div
    id="auth-modal"
    class="modal"
    aria-hidden="true"
    role="dialog"
    aria-labelledby="authModalTitle"
    aria-modal="true"
    style="display: none;"
  >
    <div class="modal-content" role="document">
      <button type="button" class="modal-close" aria-label="Закрыть окно">&times;</button>

      <h2 id="authModalTitle">Вход / Регистрация</h2>

      <div class="auth-tabs" role="tablist">
        <button
          type="button"
          class="tab-btn active"
          data-tab="login"
          role="tab"
          aria-selected="true"
          aria-controls="login-form"
          id="tab-login"
        >
          Войти
        </button>
        <button
          type="button"
          class="tab-btn"
          data-tab="register"
          role="tab"
          aria-selected="false"
          aria-controls="register-form"
          id="tab-register"
        >
          Зарегистрироваться
        </button>
      </div>

      <div class="auth-forms">
        <!-- Форма входа -->
        <form
          id="login-form"
          class="auth-form active"
          novalidate
          role="tabpanel"
          aria-labelledby="tab-login"
        >
          <label for="login-email">Email:</label>
          <input
            type="email"
            id="login-email"
            name="email"
            required
            placeholder="Введите ваш email"
            autocomplete="email"
          />

          <label for="login-password">Пароль:</label>
          <input
            type="password"
            id="login-password"
            name="password"
            required
            placeholder="Введите пароль"
            autocomplete="current-password"
          />

          <button type="submit" class="btn btn--primary btn-submit">Войти</button>
        </form>

        <!-- Форма регистрации -->
        <form
          id="register-form"
          class="auth-form"
          novalidate
          role="tabpanel"
          aria-labelledby="tab-register"
        >
          <label for="register-fullname">ФИО:</label>
          <input
            type="text"
            id="register-fullname"
            name="fullname"
            required
            placeholder="Введите ваше ФИО"
            autocomplete="name"
          />

          <label for="register-email">Email:</label>
          <input
            type="email"
            id="register-email"
            name="email"
            required
            placeholder="Введите ваш email"
            autocomplete="email"
          />

          <label for="register-phone">Телефон:</label>
          <input
            type="tel"
            id="register-phone"
            name="phone"
            required
            placeholder="89123456789 или +79123456789"
            pattern="^(8|\+7)\d{10}$"
          />

          <label for="register-password">Пароль:</label>
          <input
            type="password"
            id="register-password"
            name="password"
            required
            placeholder="Введите пароль"
            autocomplete="new-password"
          />

          <button type="submit" class="btn btn--primary btn-submit">
            Зарегистрироваться
          </button>
        </form>
      </div>
    </div>
  </div>

  <!-- Скрипты -->
  <script>
    // Инициализация Яндекс карты
    function initMap() {
      if (!window.ymaps) return;

      ymaps.ready(function () {
        var map = new ymaps.Map("yandex-map", {
          center: [55.751574, 37.573856], // Москва, пример координат
          zoom: 14,
          controls: ["zoomControl", "fullscreenControl"],
        });

        var placemark = new ymaps.Placemark(
          [55.751574, 37.573856],
          {
            balloonContent:
              'Автошкола "Тачка на прокачку"<br>Москва, ул. Примерная, 12',
          },
          {
            preset: "islands#blueCarIcon",
          }
        );

        map.geoObjects.add(placemark);
      });
    }

    // Работа с модальным окном и табами
    document.addEventListener("DOMContentLoaded", function () {
      initMap();

      const authModal = document.getElementById("auth-modal");
      const btnOpenAuth = document.getElementById("btnOpenAuth");
      const btnOpenAuthHero = document.getElementById("btnOpenAuthHero");
      const btnCloseAuth = authModal.querySelector(".modal-close");
      const tabButtons = authModal.querySelectorAll(".tab-btn");
      const authForms = authModal.querySelectorAll(".auth-form");

      function openAuthModal(defaultTab = "register") {
        authModal.style.display = "flex";
        authModal.setAttribute("aria-hidden", "false");
        document.body.style.overflow = "hidden";
        switchTab(defaultTab);
      }

      function closeAuthModal() {
        authModal.style.display = "none";
        authModal.setAttribute("aria-hidden", "true");
        document.body.style.overflow = "";
        authForms.forEach((form) => form.reset());
      }

      function switchTab(tabName) {
        tabButtons.forEach((btn) => {
          const isActive = btn.dataset.tab === tabName;
          btn.classList.toggle("active", isActive);
          btn.setAttribute("aria-selected", isActive ? "true" : "false");
        });

        authForms.forEach((form) => {
          form.classList.toggle("active", form.id === tabName + "-form");
        });

        const activeForm = authModal.querySelector("form.auth-form.active");
        if (activeForm) {
          const firstInput = activeForm.querySelector("input");
          if (firstInput) firstInput.focus();
        }
      }

      btnOpenAuth.addEventListener("click", () => openAuthModal("register"));
      btnOpenAuthHero.addEventListener("click", () => openAuthModal("register"));
      btnCloseAuth.addEventListener("click", closeAuthModal);

      window.addEventListener("click", (e) => {
        if (e.target === authModal) {
          closeAuthModal();
        }
      });

      window.addEventListener("keydown", (e) => {
        if (e.key === "Escape" && authModal.style.display === "flex") {
          closeAuthModal();
        }
      });

      tabButtons.forEach((btn) => {
        btn.addEventListener("click", () => {
          switchTab(btn.dataset.tab);
        });
      });

      // Обработка отправки форм (пример)
      const loginForm = document.getElementById("login-form");
      const registerForm = document.getElementById("register-form");

      loginForm.addEventListener("submit", (e) => {
        e.preventDefault();
        if (!loginForm.checkValidity()) {
          loginForm.reportValidity();
          return;
        }
        alert("Вход выполнен успешно!");
        closeAuthModal();
      });

      registerForm.addEventListener("submit", (e) => {
        e.preventDefault();
        if (!registerForm.checkValidity()) {
          registerForm.reportValidity();
          return;
        }

        const phoneValue = registerForm.elements["phone"].value.trim();
        const phoneRegex = /^(8|\+7)\d{10}$/;

        if (!phoneRegex.test(phoneValue)) {
          alert(
            "Пожалуйста, введите корректный номер телефона в формате 89123456789 или +79123456789"
          );
          registerForm.elements["phone"].focus();
          return;
        }

        alert("Регистрация прошла успешно!");
        closeAuthModal();
      });

      // Карусель отзывов
      const reviewsTrack = document.querySelector(".reviews__track");
      const reviews = reviewsTrack.querySelectorAll(".review-card");
      const btnPrev = document.querySelector(".reviews__nav--prev");
      const btnNext = document.querySelector(".reviews__nav--next");
      let currentReview = 0;

      function showReview(index) {
        reviews.forEach((r, i) => {
          r.hidden = i !== index;
        });
      }
      showReview(currentReview);

      btnPrev.addEventListener("click", () => {
        currentReview = (currentReview - 1 + reviews.length) % reviews.length;
        showReview(currentReview);
      });

      btnNext.addEventListener("click", () => {
        currentReview = (currentReview + 1) % reviews.length;
        showReview(currentReview);
      });
    });
  </script>
</body>
</html>
