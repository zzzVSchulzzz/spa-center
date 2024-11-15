$(document).ready(function(){
    $('.product-carousel').slick({
        infinite: true,
        slidesToShow: 1, // Показывать только одну карточку
        slidesToScroll: 1,
        autoplay: true, // Автоматическая прокрутка
        autoplaySpeed: 3000, // Время на одну карточку
        arrows: true, // Выводить стрелки
        dots: true // Показать точки навигации
    });
});
