$(document).ready(function () {
    $('.product-carousel').slick({
      slidesToShow: 1, // Показываем 1 карточку
      slidesToScroll: 1, // Листаем по 1 карточке
      arrows: true, // Стрелки для навигации
      dots: true, // Точки для переключения
      infinite: true, // Бесконечная прокрутка
      autoplay: true,
      responsive: [
        {
          breakpoint: 768, // Для экранов меньше 768px
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false, // Убираем стрелки на мобильных
            dots: true, // Оставляем точки
          },
        },
      ],
    });
  });

  // Открытие модального окна
  const loginIcon = document.querySelector('#login-icon');
  const modal = document.querySelector('#login-modal');
  const closeBtn = document.querySelector('.close');

  loginIcon.addEventListener('click', (e) => {
      e.preventDefault(); // Отменяем действие по умолчанию
      modal.style.display = 'block'; // Показываем модальное окно
  });

  closeBtn.addEventListener('click', () => {
      modal.style.display = 'none'; // Закрываем окно
  });

  // Закрытие окна при клике за пределами
  window.addEventListener('click', (e) => {
      if (e.target === modal) {
          modal.style.display = 'none';
      }
  });