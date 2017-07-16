jQuery(document).ready(function ($) {
    $(window).on('resize', function () {
        var ww = $(window).width();
        if (ww < 961) {
            $('.menu').hide();
        } else {
            $('.small_res_menu').removeClass('active');
            $('.menu').show();
        }
    });
    $('.small_res_menu').click(function () {
        $(this).toggleClass('active');
        $('.menu').slideToggle();
    });
});
