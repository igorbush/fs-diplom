$(document).ready(function() {
    $('.acceptin-button').on('click', function() {
        event.preventDefault();
        console.log(1);
        var qrcode = new QRCode(document.getElementById("qrcode"), {
            width: 200,
            height: 200,
            colorDark : "#000000",
            colorLight : "#ffffff",
            correctLevel : QRCode.CorrectLevel.H
        });
        qrcode.clear(); // clear the code.
        qrcode.makeCode("11111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111");
        console.log($('#qrcode > img').prop('src'));
        $.post('addQrCode', {
            '_token': $('meta[name="csrf-token"]').attr('content'),
            'url': ''
        }).done(function(data) {
            console.log(data);
        }).fail(function(data) {
            console.log(data);
        });
    });

});


