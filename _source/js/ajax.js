// функция получения дерева каталогов
function getTree(path) {
    $.ajax({
        type: 'POST',
        url: '/core/fn/get_tree.php',
        data: "path=" + path,
        success: function(data) {
            $('#tree').animate({opacity:0}, 300, function() {
                $('#tree').html(data);
            });
            $('#tree').animate({opacity:1}, 300);
        }
    });
}

// функция получения контента каталогов
function getContent(path) {
    $.ajax({
        type: 'POST',
        url: '/core/fn/get_content.php',
        data: "path=" + path,
        success: function(data) {
            $('#content').animate({opacity:0}, 300, function() {
                $('#content').html(data);
            });
            $('#content').animate({opacity:1}, 300);
        }
    });
}

// функция получения содержимого пароля
function getPass(name) {
    $.ajax({
        type: 'POST',
        url: '/core/fn/get_pass.php',
        data: "name=" + name,
        success: function(data) {
            $('#content').animate({opacity:0}, 300, function() {
                $('#content').html(data);
            });
            $('#content').animate({opacity:1}, 300);
        }
    });
}

$(document).ready(function() {
    
    // получение стартовой страницы
    getTree('/');
    getContent('/');
    
    // формирование страницы каталога
    $('body').on('click', '.js-tree-path', function() {
        var target_path = $(this).attr('target');
        getTree(target_path);
        getContent(target_path);
    });
    
    // получение страницы пароля
    $('body').on('click', '.js-pass-title', function() {
        var target_path = $(this).attr('target');
        getPass(target_path);
    });
    
    // дешифрование поля при фокусе
    $('body').on('focusin', '.js-crypt', function() {
        var key = $('.js-keyword').val();
        var text = $(this).val();
        if (key == '') {
            alert('key is empty');
            $(this).blur();
        } else if (text != '') {
            var decode = decoding(key, text);
            $(this).val(decode);
        }
    });
    
    // шифрование поля при потере фокуса
    $('body').on('focusout', '.js-crypt', function() {
        var key = $('.js-keyword').val();
        var text = $(this).val();
        if (key != '' && text != '') {
            var code = coding(key, text);
            $(this).val(code);
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
