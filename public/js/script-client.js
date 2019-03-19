$(document).ready(function() {
    var date = new Date();
    var dayOptions = { weekday: 'short' };
    var dayCopy = $('.page-nav__day:eq(1)');
    function clickDays() {
        $('.page-nav__day').on('click', function() {
            if (!$(this).hasClass('page-nav__day_next')) {
                $('.page-nav__day').removeClass('page-nav__day_chosen');
                $(this).addClass('page-nav__day_chosen');
            };
        });
    };
    $('.page-nav__day:not(.page-nav__day_next)').each(function () {
        if(date.getDay() == 0 || date.getDay() == 6) {
            if(!$(this).hasClass('page-nav__day_weekend')) {
                $(this).addClass('page-nav__day_weekend');
            }
        }
        $(this).children('.page-nav__day-week').text(date.toLocaleString('ru', dayOptions));
        $(this).children('.page-nav__day-number').text(date.getDate());
        date.setDate(date.getDate()+1);
    });

    clickDays();
    $('.page-nav__day_next').on('click', function() {
        $('.page-nav__day:first').remove();
        date.setDate(date.getDate());
        var newDay = dayCopy.clone();
        if(date.getDay() == 0 || date.getDay() == 6) {
            if(!newDay.hasClass('page-nav__day_weekend')) {
                newDay.addClass('page-nav__day_weekend');
            }
        }
        newDay.children('.page-nav__day-week').text(date.toLocaleString('ru', dayOptions));
        newDay.children('.page-nav__day-number').text(date.getDate());
        date.setDate(date.getDate()+1);
        newDay.insertBefore($(this));
        clickDays();
    });
    
});