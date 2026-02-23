$('.link').click(function() {
    location.href = $(this).attr('href');
});

$(document).on('click', '.navbar-toggler', function(){
    $($(this).data("bs-target")).toggleClass("show");
});

$(document).on('click', '.navbar-toggler', function(){
    $($(this).data("bs-target")).toggleClass("show");
});

$('.scroll-to').click(function() {
    var location = $($(this).attr('href')).offset().top - ($('.sticky-main').height() + $('.sticky-sub').height() + 50);

    $('html, body').animate({
        scrollTop: location
    }, 'slow');
});

// In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
    $('.dishes').each(function() {
        $(this).find('.dish').last().find('.dashed').css({ 'border-top' : '0px', 'maring' : '0' });
    });

    if ($('.nav').length) {
        $('.sticky-main').css({'top' : $('.nav').outerHeight()});
    }
    $('.sticky-shadow').css({'top' : $('.nav').outerHeight()+$('.sticky-sub').height()+$('.sticky-main').height()-30});
    $('.sticky-sub').css({'top' : $('.nav').outerHeight()+$('.sticky-main').height()});

    var odd = 0;
    $('.dish-image').each(function() {
        if (odd == 0) {
            odd += 1;
            $(this).addClass('odd');
        } else {
            odd -= 1;
            $(this).addClass('even');
        }
    });
});
