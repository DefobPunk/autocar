document.addEventListener('DOMContentLoaded', function () {
  const authModal = document.getElementById('auth-modal');
  const btnOpenAuth = document.getElementById('btnOpenAuth');
  const btnOpenAuthHero = document.getElementById('btnOpenAuthHero');
  const btnCloseAuth = authModal.querySelector('.modal-close');
  const tabButtons = authModal.querySelectorAll('.tab-btn');
  const authForms = authModal.querySelectorAll('.auth-form');

  function openAuthModal(defaultTab = 'register') {
    authModal.style.display = 'flex';
    authModal.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';
    switchTab(defaultTab);
  }

  function closeAuthModal() {
    authModal.style.display = 'none';
    authModal.setAttribute('aria-hidden', 'true');
    document.body.style.overflow = '';
    authForms.forEach((form) => form.reset());
  }

  function switchTab(tabName) {
    tabButtons.forEach((btn) => {
      const isActive = btn.dataset.tab === tabName;
      btn.classList.toggle('active', isActive);
      btn.setAttribute('aria-selected', isActive ? 'true' : 'false');
    });

    authForms.forEach((form) => {
      form.classList.toggle('active', form.id === tabName + '-form');
    });

    // Фокус на первое поле активной формы
    const activeForm = authModal.querySelector('form.auth-form.active');
    if (activeForm) {
      const firstInput = activeForm.querySelector('input');
      if (firstInput) firstInput.focus();
    }
  }

  btnOpenAuth.addEventListener('click', () => openAuthModal('register'));
  btnOpenAuthHero.addEventListener('click', () => openAuthModal('register'));
  btnCloseAuth.addEventListener('click', closeAuthModal);

  window.addEventListener('click', (e) => {
    if (e.target === authModal) {
      closeAuthModal();
    }
  });

  window.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && authModal.style.display === 'flex') {
      closeAuthModal();
    }
  });

  tabButtons.forEach((btn) => {
    btn.addEventListener('click', () => {
      switchTab(btn.dataset.tab);
    });
  });

  // Обработка отправки формы регистрации
  const registerForm = document.getElementById('register-form');
  if (registerForm) {
    registerForm.addEventListener('submit', async (e) => {
      e.preventDefault();

      if (!registerForm.checkValidity()) {
        registerForm.reportValidity();
        return;
      }

      const phoneValue = registerForm.elements['phone'].value.trim();
      const phoneRegex = /^(8|\+7)\d{10}$/;

      if (!phoneRegex.test(phoneValue)) {
        showNotification(
          'Пожалуйста, введите корректный номер телефона в формате 89123456789 или +79123456789',
          'error'
        );
        registerForm.elements['phone'].focus();
        return;
      }

      const data = {
        fullname: registerForm.elements['fullname'].value.trim(),
        email: registerForm.elements['email'].value.trim(),
        phone: phoneValue,
        password: registerForm.elements['password'].value.trim(),
      };

      try {
        const response = await fetch('/register.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify(data),
        });

        const result = await response.json();

        if (response.ok && result.success) {
          showNotification(result.message || 'Регистрация прошла успешно!', 'success');
          closeAuthModal();
        } else {
          showNotification(result.error || 'Ошибка регистрации', 'error');
        }
      } catch (error) {
        showNotification('Ошибка сети или сервера', 'error');
      }
    });
  }

  // Обработка отправки формы входа (пример, нужно реализовать аналогично)
  const loginForm = document.getElementById('login-form');
  if (loginForm) {
    loginForm.addEventListener('submit', async (e) => {
      e.preventDefault();

      if (!loginForm.checkValidity()) {
        loginForm.reportValidity();
        return;
      }

      const data = {
        email: loginForm.elements['email'].value.trim(),
        password: loginForm.elements['password'].value.trim(),
      };

      try {
        const response = await fetch('/login.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify(data),
        });

        const result = await response.json();

        if (response.ok && result.success) {
          showNotification(result.message || 'Вход выполнен успешно!', 'success');
          closeAuthModal();
          // Здесь можно добавить логику после успешного входа, например, обновить UI
        } else {
          showNotification(result.error || 'Ошибка входа', 'error');
        }
      } catch (error) {
        showNotification('Ошибка сети или сервера', 'error');
      }
    });
  }

  // Функция показа уведомлений
  function showNotification(message, type = 'success') {
    const notification = document.createElement('div');
    notification.style.position = 'fixed';
    notification.style.bottom = '20px';
    notification.style.right = '20px';
    notification.style.backgroundColor = type === 'success' ? '#4CAF50' : '#f44336';
    notification.style.color = 'white';
    notification.style.padding = '15px 25px';
    notification.style.borderRadius = '5px';
    notification.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.2)';
    notification.style.zIndex = '1000';
    notification.style.opacity = '1';
    notification.style.transition = 'opacity 0.5s ease';
    notification.textContent = message;

    document.body.appendChild(notification);

    setTimeout(() => {
      notification.style.opacity = '0';
      setTimeout(() => {
        document.body.removeChild(notification);
      }, 500);
    }, 3000);
  }
});
