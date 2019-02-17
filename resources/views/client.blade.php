<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ИдёмВКино</title>
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/styles-client.css">
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
</head>

<body>
  <header class="page-header">
    <h1 class="page-header__title">Идём<span>в</span>кино</h1>
  </header>
  
  <nav class="page-nav">
    <a class="page-nav__day page-nav__day_today" href="#">
      <span class="page-nav__day-week">Пн</span><span class="page-nav__day-number">31</span>
    </a>
    <a class="page-nav__day" href="#">
      <span class="page-nav__day-week">Вт</span><span class="page-nav__day-number">1</span>
    </a>
    <a class="page-nav__day page-nav__day_chosen" href="#">
      <span class="page-nav__day-week">Ср</span><span class="page-nav__day-number">2</span>
    </a>
    <a class="page-nav__day" href="#">
      <span class="page-nav__day-week">Чт</span><span class="page-nav__day-number">3</span>
    </a>
    <a class="page-nav__day" href="#">
      <span class="page-nav__day-week">Пт</span><span class="page-nav__day-number">4</span>
    </a>
    <a class="page-nav__day page-nav__day_weekend" href="#">
      <span class="page-nav__day-week">Сб</span><span class="page-nav__day-number">5</span>
    </a>
    <a class="page-nav__day page-nav__day_next" href="#">
    </a>
  </nav>
  
  <main>
  @foreach ($films as $film)
     <section class="movie">
      <div class="movie__info">
        <div class="movie__poster">
          <img class="movie__poster-image" alt="{{ $film->title }} постер" src="i/{{ $film->poster }}">
        </div>
        <div class="movie__description">
          <h2 class="movie__title">{{ $film->title }}</h2>
          <p class="movie__synopsis">{{ $film->description }}</p>
          <p class="movie__data">
            <span class="movie__data-duration">{{ $film->duration }} минут</span>
            <span class="movie__data-origin">{{ $film->country }}</span>
          </p>
        </div>
      </div>  
       @foreach ($halls as $hall)
       <div class="movie-seances__hall">
        <h3 class="movie-seances__hall-title">{{ $hall->name }}</h3>
        <ul class="movie-seances__list">
        @foreach ($seances as $seance)
          @if ($seance->film_id === $film->id && $seance->hall_id === $hall->id)
              <li class="movie-seances__time-block"><a class="movie-seances__time" href="/client/hall?seance_id={{ $seance->id }}">{{ $seance->time }}</a></li>
          @endif
        @endforeach
        </ul>
      </div>
       @endforeach
    </section>
  @endforeach
  </main>
  <script  src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="js/script-client.js"></script>
</body>
</html>