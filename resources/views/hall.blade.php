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
    <section class="buying">
      <div class="buying__info">
        <div class="buying__info-description">
          <h2 class="buying__info-title">{{ $film->title }}</h2>
          <p class="buying__info-start" data-id="{{ $seance->id }}">Начало сеанса: {{ $seance->time }}</p>
          <p class="buying__info-hall">{{ $hall->name }}</p>   
        </div>
        <div class="buying__info-hint">
          <p>Тапните дважды,<br>чтобы увеличить</p>
        </div>
      </div>
      <div class="buying-scheme">
        <div class="buying-scheme__wrapper">
        @foreach ($map as $row)
          <div class="buying-scheme__row">
          @foreach ($row as $chair)
            @if ($chair === 's')
                <span class="buying-scheme__chair buying-scheme__chair_standart" data-price="{{ $hall->price }}"></span>
            @elseif ($chair === 'v')
                <span class="buying-scheme__chair buying-scheme__chair_vip" data-price="{{ $hall->price_vip }}"></span>
            @else
                <span class="buying-scheme__chair buying-scheme__chair_disabled"></span>
            @endif
          @endforeach
        </div>
        @endforeach
        <div class="buying-scheme__legend">
          <div class="col">
            <p class="buying-scheme__legend-price"><span class="buying-scheme__chair buying-scheme__chair_standart"></span> Свободно (<span class="buying-scheme__legend-value">{{ $hall->price }}</span>руб)</p>
            <p class="buying-scheme__legend-price"><span class="buying-scheme__chair buying-scheme__chair_vip"></span> Свободно VIP (<span class="buying-scheme__legend-value">{{ $hall->price_vip }}</span>руб)</p>            
          </div>
          <div class="col">
            <p class="buying-scheme__legend-price"><span class="buying-scheme__chair buying-scheme__chair_taken"></span> Занято</p>
            <p class="buying-scheme__legend-price"><span class="buying-scheme__chair buying-scheme__chair_selected"></span> Выбрано</p>                    
          </div>
        </div>
      </div>
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <button class="acceptin-button">Забронировать</button>
    </section>     
  </main>
  
  <script  src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="../js/hall.js"></script>
</body>
</html>