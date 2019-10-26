// функция получения контента каталогов
function getContent(path) {
    $.ajax({
        type: 'POST',
        url: '/core/fn/get_content.php',
        data: "path=" + path,
        success: function (data) {
            $('#page').animate({
                opacity: 0
            }, 300, function () {
                $('#page').html(data);
            });
            $('#page').animate({
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
            $('#page').animate({
                opacity: 0
            }, 300, function () {
                $('#page').html(data);
            });
            $('#page').animate({
                opacity: 1
            }, 300);
        }
    });
}

// функция добавления каталога
function addGroup(name, title, path, fullpath) {
    var group = {
        name: name,
        title: title,
        path: path,
        fullpath: fullpath+'/'+name
    };
    $.ajax({
        type: 'POST',
        url: '/core/fn/add_group.php',
        data: group,
        success: function () {
            getContent(path);
        }
    });
}

// функция удаления айтема
function delItem(name, this_path, type) {
    var item = {
        name: name,
        type: type
    };
    $.ajax({
        type: 'POST',
        url: '/core/fn/del_item.php',
        data: item,
        success: function () {
            getContent(this_path);
        }
    });
}

// функция дешифровки ключа при фокусе
function focusInDecrypt(elem, key) {
    $.ajax({
        type: 'POST',
        url: '/core/fn/get_key.php',
        success: function (data) {
            var decode = decoding(data, key);
            $(elem).val(decode);
        }
    });
}

// функция шифрования ключа при потере фокуса
function focusOutCrypt(elem, key) {
    $.ajax({
        type: 'POST',
        url: '/core/fn/get_key.php',
        success: function (data) {
            var code = coding(data, key);
            $(elem).val(code);
        }
    });
}

$(document).ready(function () {

    // получение стартовой страницы
    getContent('/');

    // формирование страницы каталога
    $('body').on('click', '.js-tree-path', function () {
        var target_path = $(this).attr('target');
        if (target_path != '' && target_path != null) {
            getContent(target_path);
        } else {
            alert('error');
        }
    });

    // получение страницы пароля
    $('body').on('click', '.js-pass-title', function () {
        var target_path = $(this).attr('target');
        if (target_path != '' && target_path != null) {
            getPass(target_path);
        } else {
            alert('error');
        }
    });

    // добавление группы
    $('body').on('click', '.js-add-group', function () {
        var path = $('.js-title').attr('this-path');
        var fullpath = $('.js-title').attr('this-fullpath');
        var title = prompt("Enter folder name");
        var name = translit(title);
        if (path != '' && path != null && name != '' && name != null) {
            addGroup(name, title, path, fullpath);
        } else {
            alert('error');
        }
    });

    // удаление айтема
    $('body').on('click', '.js-tree-del', function () {
        var u_confirm = confirm('Seriously?');
        if (u_confirm) {
            var tree_name = $(this).closest('.js-tree-item').find('.js-tree-name');
            var target_name = $(tree_name).attr('target');
            var target_type = $(tree_name).attr('type');
            var this_path = $('.js-title').attr('this-path');
            var types = ['groups', 'passwd'];
            if (target_name != '' && target_name != null && this_path != '' && this_path != null && $.inArray(target_type, types) >= 0) {
                delItem(target_name, this_path, target_type);
            } else {
                alert('error');
            }
        }
    });

    // дешифрование поля при фокусе
    $('body').on('focusin', '.js-crypt', function () {
        var text = $(this).val();
        var elem = $(this);
        if (text != '' && text != '') {
            focusInDecrypt(elem, text);
        }
    });

    // шифрование поля при потере фокуса
    $('body').on('focusout', '.js-crypt', function () {
        var text = $(this).val();
        var elem = $(this);
        if (text != '' && text != null) {
            focusOutCrypt(elem, text);
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