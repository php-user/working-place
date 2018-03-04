$(function(){

    /*   For active menu   */
    var pathname = window.location.pathname; // get current URL path

    if (pathname !== '/') {
        var result = pathname.match(/([a-z]+)/);
        $('.navbar-nav > li > a[href="/'+result[0]+'"]').parent().addClass('active');
    }

    ///////////

});
