$(document).ready(function() {

    $.get('getReservedChars', {
        'seance_id': $('.buying__info-start').data('id')
    }).done(function(data) {
        for(var ticket of data) {
            var currentTicket = JSON.parse(ticket.reserved_map);
            for(key in currentTicket) {
                console.log(key);
                console.log(currentTicket[key]);
                for (var i = 0; i < currentTicket[key].length; i++) {
                    console.log(currentTicket[key][i]);
                    console.log($('.buying-scheme__row:eq('+(key-1)+') .buying-scheme__chair:eq('+(currentTicket[key][i]
                    -1)+')'));
                    $('.buying-scheme__row:eq('+(key-1)+') .buying-scheme__chair:eq('+(currentTicket[key][i]
                        -1)+')').attr('class', 'buying-scheme__chair buying-scheme__chair_taken');
                }
            }
        };
        $('.buying-scheme__row > .buying-scheme__chair_standart , .buying-scheme__row > .buying-scheme__chair_vip').on('click', function() {
            $(this).toggleClass('buying-scheme__chair_selected');
        });
    }).fail(function(data) {
        console.log(data);
    });

    $('.acceptin-button').on('click', function() {
        event.preventDefault();
        var checkedChairs = $('.buying-scheme__row > .buying-scheme__chair_selected');
        var checkedRows = $('.buying-scheme__chair_selected').parents('.buying-scheme__row');
        var chairs = [];
        var rows = [];
        var reservedMap = {};
        var totalPrice = 0;
        checkedChairs.each(function() {
            totalPrice += +$(this).data('price');
            chairs.push($(this).index()+1);
        });
        checkedRows.each(function() {
            rows.push($(this).index()+1);
            var reservedChairs = [];
            $(this).children('.buying-scheme__chair_selected').each(function() {
                reservedChairs.push($(this).index()+1);
            });
            reservedMap[$(this).index()+1] = reservedChairs.sort();
        });
        console.log(JSON.stringify(reservedMap));
        $.post('addTicket', {
            seance_id: $('.buying__info-start').data('id'),
            reserved_map: JSON.stringify(reservedMap),
            total_price: totalPrice,
            '_token': $('meta[name="csrf-token"]').attr('content')
        }).done(function(data) {
            console.log(data);
            window.location.href='payment?ticket_id='+data.id;
        }).fail(function(data) {
            console.log(data);
        });
    });
});