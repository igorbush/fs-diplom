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
    <section class="ticket" data-id={{ $ticket->id }}>
      
      <header class="tichet__check">
        <h2 class="ticket__check-title">Вы выбрали билеты:</h2>
      </header>
      
      <div class="ticket__info-wrapper">
        <p class="ticket__info">На фильм: <span class="ticket__details ticket__title">{{ $film->title }}</span></p>
        @foreach ($map as $key => $row)
          <p class="ticket__info">Ряд: <span class="ticket__details ticket__chairs">{{ $key }}</span></p>
          @foreach ($row as $chair)
            <p class="ticket__info">Место: <span class="ticket__details ticket__chairs">{{ $chair }}</span></p>
          @endforeach
        @endforeach
        <p class="ticket__info">В зале: <span class="ticket__details ticket__hall">{{ $hall->name }}</span></p>
        <p class="ticket__info">Начало сеанса: <span class="ticket__details ticket__start">{{ $seance->time }}</span></p>
        <p class="ticket__info">Стоимость: <span class="ticket__details ticket__cost">{{ $ticket->total_price }}</span> рублей</p>

        <meta name="csrf-token" content="{{ csrf_token() }}">
        <button class="acceptin-button">Получить код бронирования</button>

        <p class="ticket__hint">После оплаты билет будет доступен в этом окне, а также придёт вам на почту. Покажите QR-код нашему контроллёру у входа в зал.</p>
        <p class="ticket__hint">Приятного просмотра!</p>
      </div>
    </section>     
  </main>
  <script  src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="../js/qrcode.min.js"></script>
  <script src="../js/payment.js"></script>
</body>
</html>