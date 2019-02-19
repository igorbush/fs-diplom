<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ИдёмВКино</title>
  <link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/styles-client.css">
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
</head>

<body>
  <header class="page-header">
    <h1 class="page-header__title">Идём<span>в</span>кино</h1>
  </header>
  <main>
    <section class="ticket">
      <header class="tichet__check">
        <h2 class="ticket__check-title">Проверка электронного билета</h2>
      </header>
      <div class="ticket__info-wrapper">
        <img class="ticket__info-qr hidden" src="">
        <label for="fileupload" class="acceptin-button reception-button">Выберите файл</label>
        <input type="file" class="fileupload" id="fileupload" name="fileupload"/>
        <p class="ticket__hint" style="text-align:center">Загрузите QR-код для подтверждения бронирования.</p>
        <div class="qr-result hidden"><br><br><br>
          <p class="ticket__info">На фильм: <span class="ticket__details ticket__title"></span></p>
          <p class="ticket__info">Ряд: <span class="ticket__details ticket__chairs"></span></p>
          <p class="ticket__info">Место: <span class="ticket__details ticket__chairs"></span></p>
          <p class="ticket__info">В зале: <span class="ticket__details ticket__hall"></span></p>
          <p class="ticket__info">Начало сеанса: <span class="ticket__details ticket__start"></span></p>
          <p class="ticket__info">Стоимость: <span class="ticket__details ticket__cost"></span> рублей</p>
        </div>
      </div>
    </section>     
  </main>
  <script  src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="js/qcode-decoder.min.js"></script>
    <script src="js/reception.js"></script>
</body>
</html>