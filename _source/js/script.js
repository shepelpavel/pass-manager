$(document).ready(function () {

    // открытие меню
    $('body').on('click', '.js-menu-trigger', function () {
        $(this).toggleClass('open');
        $(this).closest('.js-menu').toggleClass('open');
    });

});