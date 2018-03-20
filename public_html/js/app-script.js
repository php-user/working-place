$(function(){

    var pathname = window.location.pathname; // get current URL path

    /*   For active menu   */

    if (pathname !== '/') {
        var result = pathname.match(/([a-z]+)/);
        $('.navbar-nav > li > a[href="/'+result[0]+'"]').parent().addClass('active');
    }

    /// Ajax example /////////////////////////////////////////////

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

    /// Menu accordion /////////////////////////////////////////////

    if ($(document).width() > 1200) {
        $('.fixed').css('position', 'fixed');
        $('.app-nav a').css('width', '264px');
    } else if ($(document).width() > 992 && $(document).width() < 1200) {
        $('.fixed').css('position', 'fixed');
        $('.app-nav a').css('width', '218px');
    } else {
        $('.app-nav').css('marginTop', '20px');
        $('.app-nav').css('marginBottom', '30px');
        $('.app-nav a').css('display', 'block');
    }

    $(".topnav").accordion({
        accordion:true,
        speed: 500,
        closedSign: '<span class="dropdown-toggle"></span>',
        openedSign: '<span class="dropup"><span class="dropdown-toggle"></span></span>'
    });

    /* In order don't work link witch has children */
    $('ul.topnav li a').on('click', function(){
        if ($(this).parent('li').has('ul').length != 0) {
            return false;
        }
    });

    // To add padding to each nested link in menu

    var menuLinks = $('ul.topnav').find('a');

    menuLinks.each(function(){
        var parentsUntilLength = $(this).parentsUntil('.app-nav').length;
        var div = parentsUntilLength / 2;

        if (div > 1) {
            var res = (div - 1) * 40;
            $(this).css('paddingLeft', res + 'px');
        }
    })

    /* Highlighting for aside menu */
    $('ul.topnav li a').each(function(){
        var href = $(this).attr('href');

        if ( (href == pathname) ) {
            $(this).addClass('highlight');
        } else {
            $(this).removeClass('highlight');
        }
    });

    //////////////////////////


    // var pathname = window.location.pathname;
    // pathname on the yop of the page
    $('.registration-block > a[href="' + pathname + '"]').addClass('registration-active-button');

});
