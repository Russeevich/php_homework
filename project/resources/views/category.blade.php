<!DOCTYPE html>
<html lang="ru">
  <head>
    <title>{{$cat->name}} - ГеймсМаркет</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="{{asset('css/libs.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <link rel="stylesheet" href="{{asset('css/media.css')}}">
  </head>
  <body>
    <div class="main-wrapper">
      <x-header :isAuth="!empty(Auth::user())"/>
      <div class="middle">
        <div class="sidebar">
          <x-category :categories="$categories"/>
          <div class="sidebar-item">
            <div class="sidebar-item__title">Последние новости</div>
            <div class="sidebar-item__content">
              <div class="sidebar-news">
                <div class="sidebar-news__item">
                  <div class="sidebar-news__item__preview-news"><img src="{{asset('img/cover/game-2.jpg')}}" alt="image-new" class="sidebar-new__item__preview-new__image"></div>
                  <div class="sidebar-news__item__title-news"><a href="#" class="sidebar-news__item__title-news__link">О новых играх в режиме VR</a></div>
                </div>
                <div class="sidebar-news__item">
                  <div class="sidebar-news__item__preview-news"><img src="{{asset('img/cover/game-1.jpg')}}" alt="image-new" class="sidebar-new__item__preview-new__image"></div>
                  <div class="sidebar-news__item__title-news"><a href="#" class="sidebar-news__item__title-news__link">О новых играх в режиме VR</a></div>
                </div>
                <div class="sidebar-news__item">
                  <div class="sidebar-news__item__preview-news"><img src="{{asset('img/cover/game-4.jpg')}}" alt="image-new" class="sidebar-new__item__preview-new__image"></div>
                  <div class="sidebar-news__item__title-news"><a href="#" class="sidebar-news__item__title-news__link">О новых играх в режиме VR</a></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="main-content">
          <div class="content-top">
            <div class="content-top__text">Купить игры неборого без регистрации смс с торента, получить компкт диск, скачать Steam игры после оплаты</div>
            <div class="slider"><img src="{{asset('img/slider.png')}}" alt="Image" class="image-main"></div>
          </div>
          <div class="content-middle">
            <div class="content-head__container">
              <div class="content-head__title-wrap">
                <div class="content-head__title-wrap__title bcg-title">Игры в разделе {{$cat->name}}</div>
              </div>
              <div class="content-head__search-block">
                <div class="search-container">
                  <form class="search-container__form">
                    <input type="text" class="search-container__form__input">
                    <button class="search-container__form__btn">search</button>
                  </form>
                </div>
              </div>
            </div>
            <x-products :products="$products"/>
            @if(floor(sizeof($products) / 20) > 0)
            <div class="content-footer__container">
              <ul class="page-nav">
                <li class="page-nav__item"><a href="#" class="page-nav__item__link"><i class="fa fa-angle-double-left"></i></a></li>
                @for ($i = 1; $i <= floor(sizeof($products) / 20); $i++)
                  <li class="page-nav__item"><a href="?{{http_build_query(array_merge($_GET, array('page' => $i)))}}" class="page-nav__item__link">1</a></li>
                @endfor
                <li class="page-nav__item"><a href="#" class="page-nav__item__link"><i class="fa fa-angle-double-right"></i></a></li>
              </ul>
            </div>
            @endif
          </div>
          <div class="content-bottom"></div>
        </div>
      </div>
      <x-footer/>
    </div>
    <script src="../js/main.js"></script>
  </body>
</html>