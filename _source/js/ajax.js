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

$(document).ready(function() {
    
    getTree('/');
    getContent('/');
    
    $('body').on('click', '.js-tree-path', function() {
        var target_path = $(this).attr('target');
        getTree(target_path);
    });
    
    $('body').on('click', '.js-tree-path', function() {
        var target_path = $(this).attr('target');
        getContent(target_path);
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
