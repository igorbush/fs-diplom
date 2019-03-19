$(document).ready(function() {
    $('.acceptin-button').on('click', function() {
        event.preventDefault();
        var ticketObject = {};
        ticketObject['id'] = $('.ticket').data('id');
        ticketObject['price'] = $('.ticket__cost').text();
        ticketObject['seance'] = $('.ticket__start').text();    
        var qr = document.createElement("div");
        qr.className = 'qrcode';
        var qrcode = new QRCode(qr, {
            width: 200,
            height: 200,
            colorDark : "#000000",
            colorLight : "#ffffff",
            correctLevel : QRCode.CorrectLevel.H
        });
        qrcode.clear(); 
        qrcode.makeCode(JSON.stringify(ticketObject));
        setTimeout(function() {
        $.post('addQrCode', {
            '_token': $('meta[name="csrf-token"]').attr('content'),
            'src': $(qr).children('img').attr('src'),
            'id' : $('.ticket').data('id')
        }).done(function(data) {
            console.log(data);
            $('.ticket__check-title').text('Электронный билет');
            $('.ticket__hint:eq(1)').text('Покажите QR-код нашему контроллеру для подтверждения бронирования.');
            $('.ticket__hint:eq(2)').text('Приятного просмотра!');
            $("<img>",{class: 'ticket__info-qr',src: '../i/qrcodes/'+data.name}).insertAfter($('meta'));
            $('.acceptin-button').remove();
        }).fail(function(data) {
            console.log(data);
        });
        }, 10);  
    });
    $('.ticket__chair').each(function () {
        var strVal = $.trim($(this).text().split(' ').join(''));
        var lastChar = strVal.slice(-1);
        if (lastChar == ',') {
            $(this).text(strVal.slice(0, -1));
        };
    });
});


