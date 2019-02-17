<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="CSS/normalize.css">
  <link rel="stylesheet" href="CSS/styles.css">
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
  <title>GO2Cinema</title>
</head>

<body>

  <header class="page-header">
    <h1 class="page-header__title">Идём<span>в</span>кино</h1>
    <span class="page-header__subtitle">Администраторррская</span>
  </header>
  
  <main class="conf-steps">
    <section class="conf-step">
      <header class="conf-step__header conf-step__header_opened">
        <h2 class="conf-step__title">Управление залами</h2>
      </header>
      <div class="conf-step__wrapper">
        <p class="conf-step__paragraph">Доступные залы:</p>
        <ul class="conf-step__list">
        @foreach ($halls as $hall)
          <li>{{ $hall->name }}
            <button class="conf-step__button conf-step__button-trash" data-id="{{ $hall->id }}"></button>
          </li>
        @endforeach
        </ul>
        <button id="add-room" class="conf-step__button conf-step__button-accent">Создать зал</button>
      </div>
    </section>
    
    <section class="conf-step">
      <header class="conf-step__header conf-step__header_opened">
        <h2 class="conf-step__title">Конфигурация залов</h2>
      </header>
      <div class="conf-step__wrapper">
        <p class="conf-step__paragraph">Выберите зал для конфигурации:</p>
        <ul class="conf-step__selectors-box chairs-change-box">
        @foreach ($halls as $hall)
          <li><input type="radio" class="conf-step__radio" name="chairs-hall" value="{{ $hall->name }}" data-id='{{ $hall->id }}'><span class="conf-step__selector">{{ $hall->name }}</span></li>
        @endforeach
        </ul>
        <p class="conf-step__paragraph">Укажите количество рядов и максимальное количество кресел в ряду:</p>
        <div class="conf-step__legend">
          <label class="conf-step__label">Рядов, шт<input type="text" class="conf-step__input" placeholder="10" ></label>
          <span class="multiplier">x</span>
          <label class="conf-step__label">Мест, шт<input type="text" class="conf-step__input" placeholder="8" ></label>
        </div>
        <p class="conf-step__paragraph">Теперь вы можете указать типы кресел на схеме зала:</p>
        <div class="conf-step__legend">
          <span class="conf-step__chair conf-step__chair_standart"></span> — обычные кресла
          <span class="conf-step__chair conf-step__chair_vip"></span> — VIP кресла
          <span class="conf-step__chair conf-step__chair_disabled"></span> — заблокированные (нет кресла)
          <p class="conf-step__hint">Чтобы изменить вид кресла, нажмите по нему левой кнопкой мыши</p>
        </div>  
        
        <div class="conf-step__hall">
          <div class="conf-step__hall-wrapper">
          </div>  
        </div>
        
        <fieldset class="conf-step__buttons text-center">
          <button class="conf-step__button conf-step__button-regular cencel-chairs">Отмена</button>
          <input type="submit" value="Сохранить" class="conf-step__button conf-step__button-accent save-chairs">
        </fieldset>                 
      </div>
    </section>
    
    <section class="conf-step">
      <header class="conf-step__header conf-step__header_opened">
        <h2 class="conf-step__title">Конфигурация цен</h2>
      </header>
      <div class="conf-step__wrapper">
        <p class="conf-step__paragraph">Выберите зал для конфигурации:</p>
        <ul class="conf-step__selectors-box price-change-box">
        @foreach ($halls as $hall)
          <li><input type="radio" class="conf-step__radio" name="prices-hall" value="{{ $hall->name }}" data-id='{{ $hall->id }}'><span class="conf-step__selector">{{ $hall->name }}</span></li>
        @endforeach
        </ul>
          
        <p class="conf-step__paragraph">Установите цены для типов кресел:</p>
          <div class="conf-step__legend">
            <label class="conf-step__label">Цена, рублей<input type="text" class="conf-step__input standart-price" placeholder="0" ></label>
            за <span class="conf-step__chair conf-step__chair_standart"></span> обычные кресла
          </div>  
          <div class="conf-step__legend">
            <label class="conf-step__label">Цена, рублей<input type="text" class="conf-step__input vip-price" placeholder="0" value="350"></label>
            за <span class="conf-step__chair conf-step__chair_vip"></span> VIP кресла
          </div>  
        
        <fieldset class="conf-step__buttons text-center">
          <button class="conf-step__button conf-step__button-regular cencel-prices">Отмена</button>
          <input type="submit" value="Сохранить" class="conf-step__button conf-step__button-accent save-prices">
        </fieldset>  
      </div>
    </section>
    
    <section class="conf-step">
      <header class="conf-step__header conf-step__header_opened">
        <h2 class="conf-step__title">Сетка сеансов</h2>
      </header>
      <div class="conf-step__wrapper draggable ">
        <p class="conf-step__paragraph">
          <button id="add-film" class="conf-step__button conf-step__button-accent">Добавить фильм</button>
        </p>
        <div class="conf-step__movies">
        @foreach ($films as $film)
          <div class="conf-step__movie" data-id='{{ $film->id }}'>
            <img class="conf-step__movie-poster" alt="poster" src="i/{{ $film->poster }}">
            <h3 class="conf-step__movie-title">{{ $film->title }}</h3>
            <p class="conf-step__movie-duration">{{ $film->duration }} минут</p>
          </div>
        @endforeach
        </div>
        
        <div class="conf-step__seances">
        @foreach ($halls as $hall)
          <div class="conf-step__seances-hall" >
            <h3 class="conf-step__seances-title">{{ $hall->name }}</h3>
            <div class="conf-step__seances-timeline" data-id="{{ $hall->id }}">
            </div>
          </div>
        @endforeach
        </div>
        <fieldset class="conf-step__buttons text-center">
          <button class="conf-step__button conf-step__button-regular">Отмена</button>
          <input type="submit" value="Сохранить" class="conf-step__button conf-step__button-accent">
        </fieldset>  
      </div>
    </section>
    
    <section class="conf-step">
      <header class="conf-step__header conf-step__header_opened">
        <h2 class="conf-step__title">Открыть продажи</h2>
      </header>
      <div class="conf-step__wrapper text-center">
        <p class="conf-step__paragraph">Всё готово, теперь можно:</p>
        <button class="conf-step__button conf-step__button-accent">Открыть продажу билетов</button>
      </div>
    </section>   
  </main>

{{-- popUp's --}}

  <div class="div-popup add-room-popup">
      <div class="popup-form add-room-form">
          <input class="conf-step__input" type="text" name="room-name" placeholder="Название зала">
          <button class="conf-step__button conf-step__button-accent">Добавить зал</button>
          <button class="conf-step__button conf-step__button-regular close-popup">Отменить</button>
      </div> 
  </div>
  <div class="div-popup delete-room-popup">
    <div class="popup-form delete-room-form">
        <button class="conf-step__button conf-step__button-accent">Удалить</button>
        <button class="conf-step__button conf-step__button-regular close-popup">Отменить</button>
    </div> 
  </div>
  <div class="div-popup add-film-popup">
    <div class="popup-form add-film-form">
        <input class="conf-step__input" type="text" name="film-name" placeholder="Название фильма">
        <input class="conf-step__input" type="text" name="film-duration" placeholder="Продолжительность (в минутах)">
        <input class="conf-step__input" type="text" name="film-poster" placeholder="Постер (пр. poster.jpg)">
        <textarea class="conf-step__input" name="film-description" cols="30" rows="10" placeholder="Описание фильма"></textarea>
        <input class="conf-step__input" type="text" name="film-country" placeholder="Страна">
        <button class="conf-step__button conf-step__button-accent">Добавить фильм</button>
        <button class="conf-step__button conf-step__button-regular close-popup">Отменить</button>
    </div> 
  </div>
  <div class="div-popup add-seance-popup">
    <div class="popup-form add-seance-form">
        <input class="conf-step__input" type="text" name="seance-time" placeholder="Время начала">
        <button class="conf-step__button conf-step__button-accent">Добавить</button>
        <button class="conf-step__button conf-step__button-regular close-popup">Отменить</button>
    </div> 
  </div>
  <div class="div-popup delete-seance-popup">
    <div class="popup-form delete-seance-form">
        <button class="conf-step__button conf-step__button-accent">Удалить</button>
        <button class="conf-step__button conf-step__button-regular close-popup">Отменить</button>
    </div> 
  </div>
  <div class="overlay"></div>

{{-- end popUp's --}}

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="js/jquery.maskedinput.js" type="text/javascript"></script>
  <script src="js/script.js"></script>
</body>
</html>
