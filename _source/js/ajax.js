// функция получения контента каталогов
function getContent(path) {
    $.ajax({
        type: 'POST',
        url: '/core/fn/get_content.php',
        data: "path=" + path,
        success: function (data) {
            $('#content').animate({
                opacity: 0
            }, 300, function () {
                $('#content').html(data);
            });
            $('#content').animate({
                opacity: 1
            }, 300);
        }
    });
}

// функция получения содержимого пароля
function getPass(name) {
    $.ajax({
        type: 'POST',
        url: '/core/fn/get_pass.php',
        data: "name=" + name,
        success: function (data) {
            $('#content').animate({
                opacity: 0
            }, 300, function () {
                $('#content').html(data);
            });
            $('#content').animate({
                opacity: 1
            }, 300);
        }
    });
}

// функция дешифровки ключа при фокусе
function focusInDecrypt(elem, text) {
    $.ajax({
        type: 'POST',
        url: '/core/fn/get_key.php',
        success: function (data) {
            var decode = decoding(data, text);
            $(elem).val(decode);
        }
    });
}

// функция шифрования ключа при потере фокуса
function focusOutCrypt(elem, text) {
    $.ajax({
        type: 'POST',
        url: '/core/fn/get_key.php',
        success: function (data) {
            var code = coding(data, text);
            $(elem).val(code);
        }
    });
}

// функция добавления каталога
function addGroup(name, title, path) {
    var group = {
        name: name,
        title: title,
        path: path
    };
    $.ajax({
        type: 'POST',
        url: '/core/fn/add_group.php',
        data: group,
        success: function (data) {
            $('.js-add-group-modal').html(data);
        }
    });
}

$(document).ready(function () {

    // получение стартовой страницы
    getContent('/');

    // формирование страницы каталога
    $('body').on('click', '.js-tree-path', function () {
        var target_path = $(this).attr('target');
        getContent(target_path);
    });

    // получение страницы пароля
    $('body').on('click', '.js-pass-title', function () {
        var target_path = $(this).attr('target');
        getPass(target_path);
    });

    // дешифрование поля при фокусе
    $('body').on('focusin', '.js-crypt', function () {
        var text = $(this).val();
        var elem = $(this);
        if (text != '') {
            focusInDecrypt(elem, text);
        }
    });

    // шифрование поля при потере фокуса
    $('body').on('focusout', '.js-crypt', function () {
        var text = $(this).val();
        var elem = $(this);
        if (text != '') {
            focusOutCrypt(elem, text);
        }
    });

    // добавление группы
    $('body').on('click', '.js-add-group', function () {
        var path = $(this).closest('.js-add-group-modal').children('input[name="path"]').val();
        var title = $(this).closest('.js-add-group-modal').children('input[name="title"]').val();
        var name = translit(title);
        if (path != '' && name != '') {
            addGroup(name, title, path);
        }
    });

    // $('body').on('click', '.js-save', function() {
    //     var text = $('.js-textarea').val();
    //     var lat = translit(text);
    //     var group = {
    //         name : lat
    //     };
    //     $.ajax({
    //         type: 'POST',
    //         url: '/core/fn/add_group.php',
    //         data: group,
    //         success: function(data) {
    //             console.log(data);
    //             $('.notes__left_list').html(data);
    //         }
    //     });
    // });
});