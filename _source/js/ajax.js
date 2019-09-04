$( document ).ready(function() {
    console.log( "ready!" );
    $('body').on('click', '.js-save', function() {
        var text = $('.js-textarea').val();
        var lat = translit(text);
        var group = {
            name : lat
        };
        $.ajax({
            type: 'POST',
            url: '/core/fn/add_group.php',
            data: group,
            success: function(data) {
                console.log(data);
                $('.notes__left_list').html(data);
            }
        });
    });
});
