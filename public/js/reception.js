$(document).ready(function () {
  $('.fileupload').change(function () {
    if ($(this).val() != '') $(this).prev().text('Выбрано файлов: ' + $(this)[0].files.length);
    else $(this).prev().text('Выберите файлы');
  });
  var qr = new QCodeDecoder();

  $('.fileupload').on('change', function () {
    var file = this.files[0];
    var reader = new FileReader();
    reader.readAsDataURL(file);
    console.log(reader);
    reader.onload = function (event) {
      if (event.target.readyState == FileReader.DONE) {
        $('.ticket__info-qr').removeClass('hidden').attr('src', reader.result);
        var img = document.querySelector('.ticket__info-qr');
        qr.decodeFromImage(img, function (err, result) {
          if (err) throw err;
          console.log(result);
          var qrText = JSON.parse(result);
          $.get('reception/findTicket', {
            'ticket_id': qrText.id
          }).done(function (data) {
            console.log(data);
            $('.qr-result').removeClass('hidden');
            $('.ticket__title').text(data.film);
            $('.ticket__hall').text(data.hall);
            $('.ticket__start').text(qrText.seance);
            $('.ticket__cost').text(qrText.price);
            console.log(JSON.parse(data.map));
            for (var key in JSON.parse(data.map)) {
              $('.ticket__chairs:eq(0)').text(key);
              for (var chair of JSON.parse(data.map)[key]) {
                $('.ticket__chairs:eq(1)').text(chair);
              }
            }
          }).fail(function (data) {
            console.log(data);
          });
        });
      };
    };
  });

  $('.exit-btn').click(function () {
    event.preventDefault();
    $.ajax({
      url: '/api/auth/logout',
      type: 'get',
      headers: {
        Accept: 'application/json',
        Authorization: localStorage.getItem('token_type') + ' ' + localStorage.getItem('access_token')
      }
    }).done(function (data) {
      console.log(data);
      localStorage.clear();
      location.href = '/login';
    }).fail(function (data) {
      console.log(data);
    });
  });
});