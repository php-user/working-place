$(function(){

    /*   For active menu   */
    var pathname = window.location.pathname; // get current URL path

    if (pathname !== '/') {
        var result = pathname.match(/([a-z]+)/);
        $('.navbar-nav > li > a[href="/'+result[0]+'"]').parent().addClass('active');
    }

    ///////////

    var manageUsers = function () {
        var formData = $('#user-form').serialize();

        $.ajax({
            url: '/tutorial/ajax/process',
            type: 'post',
            dataType: 'json',
            data: formData,
            success: function(data){
                $('#ajax-result').text(data);
            },
        });
    }

    $('#user-form').on('submit', function(event){
        event.preventDefault();

        manageUsers();
    });

});
