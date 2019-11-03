$(document).ready(function () {

    // открытие меню
    $('body').on('click', '.js-menu-trigger', function () {
        $(this).toggleClass('open');
        $(this).closest('.js-menu').toggleClass('open');
    });
    $(document).on('click', function (e) {
        if (!$(e.target).closest('.js-menu').length) {
            $('.js-menu-trigger').removeClass('open');
            $('.js-menu').removeClass('open');
        }
        e.stopPropagation();
    });

    // анимация кнопки del
    var timr;
    $('body').on('click', '.js-del-btn', function () {
        var t = $(this);
        $('.js-del-anim').removeClass('animate');
        $(t).find('.js-del-anim').addClass('animate');
        timr = setTimeout(function() {
            $(t).find('.js-del-anim').fadeOut();
            $(t).find('.js-tree-del').fadeIn();
        }, 2700);
    });
    $(document).on('click', function (e) {
        if (!$(e.target).closest('.js-del-btn').length) {
            if (timr) clearTimeout(timr);
            $('.js-del-anim').removeClass('animate');
            $('.js-del-anim').fadeIn();
            $('.js-tree-del').fadeOut();
        }
        e.stopPropagation();
    });

});