<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="title" content="Агрегатор фриланс бирж">
  <meta name="description"
        content="Устали заходить на сайты разных фриланс бирж? Теперь ненужно.
        Агрегатор фриланс бирж, собирает данные со всех известных фриланс бирж в одном месте.">
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
    <script>(function(w, d, s, l, i) {
        w[l] = w[l] || [];
        w[l].push({
          'gtm.start':
            new Date().getTime(), event: 'gtm.js'
        });
        var f = d.getElementsByTagName(s)[0],
          j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
        j.async = true;
        j.src =
          'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
        f.parentNode.insertBefore(j, f);
      })(window, document, 'script', 'dataLayer', 'GTM-NW7B54D');</script>
    <!-- End Google Tag Manager -->
  @endif
</head>
<body>
<header class="border-b border-border">
  <nav class="flex items-center justify-between flex-wrap py-6 container-main md:mx-auto mx-2 md:mx-0">
    <div class="md:w-full w-full">
      <div class="flex md:justify-between items-center">
        <a href="/" title="coderman.ru">
          <img class="h-12 rounded" src="./android-chrome-192x192.png" alt=""/>
        </a>
        <div id="menu" class="flex flex-col text-sm ml-5 md:flex-grow md:justify-end  md:flex md:flex-row">
          <a class="text-content text-13p mr-10 hover:text-blue" href="{{route('stat')}}">Статистика</a>
          <a class="text-content text-13p mr-10  hover:text-blue" href="{{route('monitoring')}}">Мониторинг</a>
          <a class="text-content text-13p hover:text-blue" href="{{route('about')}}">О проекте</a>
        </div>
      </div>
    </div>
  </nav>
</header>
<main class="mb-5">
  @yield('content')
</main>
<footer class="border-t border-border mx-2 sm:mx-0">
  <div class="container-main mx-auto mt-10 pb-4">
    <div class="flex flex-col items-center md:flex-row pb-5">
      <div class="md:w-1/3">
      </div>
      <div class="md:w-1/3">
      </div>
      <div class="md:w-1/3">
        <a href="https://t.me/coderman_fl"
           class="text-content text-sm flex flex-row items-center  md:justify-end  font-bold">
          <img class="pr-2 h-6 w-7" src="./img/telegram.svg">
          @Coderman_fl</a>
      </div>
    </div>
    <div class="flex flex-row container mx-auto ">
      <div class="flex justify-center items-center w-full">
        <p class="text-heading text-xs">Copyright (c) 2019 Coderman.ru</p>
      </div>
    </div>
  </div>
</footer>
<script src="{{asset('js/manifest.js')}}"></script>
<script src="{{asset('js/vendor.js')}}"></script>
<script src="{{asset('js/app.js')}}"></script>
</body>
</html>
