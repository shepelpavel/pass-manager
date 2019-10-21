$(document).ready(function () {

    // открытие модального окна
    $('body').on('click', '.js-modal-button', function () {
        var target_class = '.modal-' + $(this).attr('target');
        var target_modal = $(target_class);
        if (!target_modal.hasClass('show')) {
            target_modal.addClass('show').fadeIn();
            $('.modals').fadeIn();
        }
    });
    
    // закрытие модального окна
    $('body').on('click', '.js-modal-close', function () {
        $('.modal').removeClass('show').fadeOut();
        $('.modals').fadeOut();
    });

});