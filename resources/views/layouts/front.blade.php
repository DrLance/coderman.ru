<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="title" content="Агрегатор фриланс бирж">
  <meta name="description"
        content="Агрегатор фриланс бирж, собирает данные со всех известных фриланс бирж в одном месте.">
  <meta name="keywords" content="работа, фриланс, биржи, агрегатор, статистика, freelance, jobs">
  <meta name="yandex-verification" content="470b665093f69585"/>
  <meta name="csrf-token" content="{{csrf_token()}}">
  <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
  <link rel="manifest" href="/site.webmanifest">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="theme-color" content="#ffffff">
  <link rel="stylesheet" href="{{asset('css/app.css')}}">

  <title>Агрегатор фриланс бирж | Coderman.ru</title>

  @if(!config('app.is_local'))
  <!-- Google Tag Manager -->
  <script>(function ( w, d, s, l, i ) {
      w[l] = w[l] || [];
      w[l].push( {
        'gtm.start':
          new Date().getTime(), event: 'gtm.js'
      } );
      var f = d.getElementsByTagName( s )[0],
        j = d.createElement( s ), dl = l != 'dataLayer' ? '&l=' + l : '';
      j.async = true;
      j.src =
        'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
      f.parentNode.insertBefore( j, f );
    })( window, document, 'script', 'dataLayer', 'GTM-NW7B54D' );</script>
  <!-- End Google Tag Manager -->
    @endif
</head>
<body>
<header class="shadow-md">
  <nav class="flex items-center justify-between flex-wrap bg-blue-400 p-6">
    <div class="container mx-auto">
      <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto">
        <a href="/" title="coderman.ru">
          <img class="h-12 rounded" src="./android-chrome-192x192.png" alt=""/>
        </a>
        <div class="text-sm lg:flex-grow flex justify-end">
          <a class="text-white font-bold text-lg mr-10" href="{{route('stat')}}">Статистика проектов</a>
          <a class="text-white font-bold text-lg mr-10" href="{{route('monitoring')}}">Мониторинг проектов</a>
          <a class="text-white font-bold text-lg mr-10" href="{{route('about')}}">О проекте</a>
        </div>
      </div>
    </div>
  </nav>
</header>
<main class="md:mb-56">
@yield('content')
</main>
<footer class="bg-blue-400 ">
  <div class="container mx-auto pt-10 pb-4">
    <div class="flex flex-row pb-5">
      <div class="w-1/3">

      </div>
      <div class="w-1/3">

      </div>
      <div class="w-1/3">
        <a href="https://t.me/coderman_fl" class="text-white flex flex-row items-center font-bold">
          <img class="pr-2 h-8 w-8" src="./img/telegram.svg">
          @Coderman_fl</a>
      </div>
    </div>
    <div class="flex flex-row container mx-auto ">
      <div class="flex justify-center items-center w-full">
        <p class="text-white text-xs">Copyright (c) 2019 coderman.ru</p>
      </div>
    </div>
  </div>
</footer>
<script src="{{asset('js/manifest.js')}}"></script>
<script src="{{asset('js/vendor.js')}}"></script>
<script src="{{asset('js/app.js')}}"></script>
</body>
</html>
