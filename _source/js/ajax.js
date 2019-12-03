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
                $(window).scrollTop(0);
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
                $(window).scrollTop(0);
            });
            $('#page').animate({
                opacity: 1
            }, 300);
        }
    });
}

// функция добавления каталога
function addGroup(name) {
    $.ajax({
        type: 'POST',
        url: '/core/fn/add_group.php',
        data: "name=" + name,
        success: function (data) {
            if (data == 'error') {
                alert('Error!');
            } else if (data == 'exist') {
                alert('Folder exist!');
            } else {
                getContent(data);
            }
        }
    });
}

// функция изменения каталога
function editGroup(name, oldname) {
    var group = {
        name: name,
        oldname: oldname
    };
    $.ajax({
        type: 'POST',
        url: '/core/fn/edit_group.php',
        data: group,
        success: function (data) {
            if (data == 'error') {
                alert('Error!');
            } else if (data == 'exist') {
                alert('Folder exist!');
            } else {
                getContent(data);
            }
        }
    });
}

// функция получения страницы добавления пароля
function getAddPassPage() {
    $.ajax({
        type: 'POST',
        url: '/core/fn/add_pass_page.php',
        success: function (data) {
            $('#page').animate({
                opacity: 0
            }, 300, function () {
                $('#page').html(data);
                $(window).scrollTop(0);
            });
            $('#page').animate({
                opacity: 1
            }, 300);
        }
    });
}

// функция сохранения нового пароля
function saveNewPass(name, arr) {
    var data = {
        name: name,
        arr: arr
    };
    $.ajax({
        type: 'POST',
        url: '/core/fn/add_new_pass.php',
        data: data,
        success: function (data) {
            if (data == 'error') {
                alert('Error!');
            } else {
                getContent(data);
            }
        }
    });
}

// функция пересохранения пароля
function savePass(name, arr) {
    var data = {
        name: name,
        arr: arr
    };
    $.ajax({
        type: 'POST',
        url: '/core/fn/resave_pass.php',
        data: data,
        success: function (data) {
            if (data == 'error') {
                alert('Error!');
            } else {
                getContent(data);
            }
        }
    });
}

// функция удаления айтема
function delItem(name, type) {
    var item = {
        name: name,
        type: type
    };
    $.ajax({
        type: 'POST',
        url: '/core/fn/del_item.php',
        data: item,
        success: function (data) {
            if (data == 'error') {
                alert('Error!');
            } else {
                getContent(data);
            }
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

// функция кнопки копирования пароля
function copyButton(elem, key) {
    $.ajax({
        type: 'POST',
        url: '/core/fn/get_key.php',
        success: function (data) {
            var text = decoding(data, key);
            var temp = $('<input style="position: absolute; left: -9999px">');
            $("body").append(temp);
            $(temp).val(text).select();
            document.execCommand("copy");
            $(temp).remove();

            $(elem).addClass('copied');
            setTimeout(function () {
                $('.js-pass-copy').removeClass('copied');
            }, 1000);
        }
    });
}

$(document).ready(function () {

    // получение стартовой страницы
    getContent('HOME');

    // получение страницы каталога
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

    // добавление каталога
    $('body').on('click', '.js-add-group', function () {
        var name = prompt("Enter folder name");

        if (name != '' &&
            name != null) {
            addGroup(name);
        }
    });

    // изменение каталога
    $('body').on('click', '.js-folder-edit', function () {
        var oldname = $(this).closest('.js-tree-item').find('.js-tree-name').attr('target');
        var in_name = prompt('Enter new name', oldname.substr(1));

        if (in_name != '' &&
            in_name != null) {
            editGroup('/' + in_name, oldname);
        }
    });

    // получение страницы добавления пароля
    $('body').on('click', '.js-add-pass', function () {
        getAddPassPage();
    });

    // сохранение нового пароля
    $('body').on('click', '.js-newpass-save', function () {
        var name = $('.js-input-title').val();
        var arr = {
            login: $('.js-input-login').val(),
            pass: $('.js-input-pass').val(),
            link: $('.js-input-link').val(),
            note: $('.js-input-note').val()
        };
        if (name, arr) {
            saveNewPass(name, arr);
        } else {
            alert('Write name!');
        }
    });

    // сохранение существующего пароля
    $('body').on('click', '.js-pass-save', function () {
        var u_confirm = confirm('Resave?');

        if (u_confirm) {
            var name = $('.js-input-title').val();
            var arr = {
                login: $('.js-input-login').val(),
                pass: $('.js-input-pass').val(),
                link: $('.js-input-link').val(),
                note: $('.js-input-note').val()
            };
            if (name, arr) {
                savePass(name, arr);
            } else {
                alert('Write name!');
            }
        }
    });

    // удаление айтема
    $('body').on('click', '.js-tree-del', function () {
        var u_confirm = confirm('Seriously?');

        if (u_confirm) {
            var tree_name = $(this).closest('.js-tree-item').find('.js-tree-name');
            var target_name = $(tree_name).attr('target');
            var target_type = $(tree_name).attr('type');
            var types = ['groups', 'passwd'];

            if (target_name != '' &&
                target_name != null &&
                $.inArray(target_type, types) >= 0) {

                delItem(target_name, target_type);
            } else {
                alert('error');
            }
        }
    });

    // дешифрование поля при фокусе
    $('body').on('focusin', '.js-crypt', function () {
        var text = $(this).val();
        var elem = $(this);
        $(this).next('.js-pass-copy').addClass('hide');

        if (text != '' && text != '') {
            focusInDecrypt(elem, text);
        }
    });

    // шифрование поля при потере фокуса
    $('body').on('focusout', '.js-crypt', function () {
        var text = $(this).val();
        var elem = $(this);
        $('.js-pass-copy').removeClass('hide');

        if (text != '' && text != null) {
            focusOutCrypt(elem, text);
        }
    });

    // кнопка скопировать пароль
    $('body').on('click', '.js-pass-copy', function () {
        var text = $(this).prev('input').val();
        var elem = $(this);
        if (text != '' && text != null) {
            copyButton(elem, text);
        }
    });

    // перехват клавиши "назад"
    history.pushState(null, null, location.href);
    window.onpopstate = function (e) {
        history.go(1);
    };

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