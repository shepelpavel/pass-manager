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
        fullpath: fullpath + '/' + name
    };
    $.ajax({
        type: 'POST',
        url: '/core/fn/add_group.php',
        data: group,
        success: function (data) {
            if (data == 'error') {
                alert('Error!');
            } else if (data == 'exist') {
                alert('Folder exist!');
            } else {
                getContent(path);
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
            });
            $('#page').animate({
                opacity: 1
            }, 300);
        }
    });
}

// функция сохранения нового пароля
function saveNewPass(path, fullpath, title, name, link, login, pass, note) {
    var group = {
        path: path,
        fullpath: fullpath,
        title: title,
        name: name,
        link: link,
        login: login,
        pass: pass,
        note: note
    };
    $.ajax({
        type: 'POST',
        url: '/core/fn/add_new_pass.php',
        data: group,
        success: function (data) {
            if (data == 'error') {
                alert('Error!');
            } else if (data == 'exist') {
                alert('Password exist!');
            } else {
                getContent(path);
            }
        }
    });
}

// функция пересохранения пароля
function savePass(path, fullpath, title, name, link, login, pass, note, oldname) {
    var group = {
        path: path,
        fullpath: fullpath,
        title: title,
        name: name,
        link: link,
        login: login,
        pass: pass,
        note: note,
        oldname: oldname
    };
    $.ajax({
        type: 'POST',
        url: '/core/fn/resave_pass.php',
        data: group,
        success: function (data) {
            if (data == 'error') {
                alert('Error!');
            } else {
                getContent(path);
            }
        }
    });
}

// функция удаления айтема
function delItem(name, path, type, fullpath) {
    var item = {
        name: name,
        type: type,
        fullpath: fullpath
    };
    $.ajax({
        type: 'POST',
        url: '/core/fn/del_item.php',
        data: item,
        success: function (data) {
            if (data == 'error') {
                alert('Error!');
            } else {
                getContent(path);
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

        if (path != '' &&
            path != null &&
            fullpath != '' &&
            fullpath != null &&
            name != '' &&
            name != null) {

            addGroup(name, title, path, fullpath);
        } else {
            alert('error');
        }
    });

    // получение страницы добавления пароля
    $('body').on('click', '.js-add-pass', function () {
        getAddPassPage();
    });

    // сохранение нового пароля
    $('body').on('click', '.js-newpass-save', function () {
        var path = $('.js-title').attr('this-path');
        var fullpath = $('.js-title').attr('this-fullpath');
        var title = $('.js-input-title').val();
        var name = translit(title);
        var link = $('.js-input-link').val();
        var login = $('.js-input-login').val();
        var pass = $('.js-input-pass').val();
        var note = $('.js-input-note').val();

        if (path != '' &&
            path != null &&
            fullpath != '' &&
            fullpath != null &&
            name != '' &&
            name != null) {

            saveNewPass(path, fullpath, title, name, link, login, pass, note);
        } else {
            alert('error');
        }
    });

    // сохранение существующего пароля
    $('body').on('click', '.js-pass-save', function () {
        var u_confirm = confirm('Resave?');

        if (u_confirm) {
            var oldname = $('.js-title').attr('this-name');
            var path = $('.js-title').attr('this-path');
            var fullpath = $('.js-title').attr('this-fullpath');
            var title = $('.js-input-title').val();
            var name = translit(title);
            var link = $('.js-input-link').val();
            var login = $('.js-input-login').val();
            var pass = $('.js-input-pass').val();
            var note = $('.js-input-note').val();
            if (path != '' &&
                path != null &&
                fullpath != '' &&
                fullpath != null &&
                name != '' &&
                name != null &&
                oldname != '' &&
                oldname != null) {

                savePass(path, fullpath, title, name, link, login, pass, note, oldname);
            } else {
                alert('error');
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
            var this_path = $('.js-title').attr('this-path');
            var fullpath = $('.js-title').attr('this-fullpath');
            var types = ['groups', 'passwd'];

            if (target_name != '' &&
                target_name != null &&
                this_path != '' &&
                this_path != null &&
                $.inArray(target_type, types) >= 0) {

                delItem(target_name, this_path, target_type, fullpath);
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