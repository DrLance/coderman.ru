<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="title" content="Фриланс аггрегатор">
  <meta name="description" content="фриланс аггрегатор парсит все извсетные биржи фриланса">
  <meta name="yandex-verification" content="470b665093f69585"/>
  <meta name="csrf-token">
  <link rel="stylesheet" href="{{asset('css/app.css')}}">

  <title>Coderman.RU</title>

  <!-- Google Tag Manager -->
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
      j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
      'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-NW7B54D');</script>
  <!-- End Google Tag Manager -->
</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NW7B54D"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<header>
  <nav class="flex items-center justify-between flex-wrap bg-blue-400 p-6">
    <div class="container mx-auto">
      <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto">
        <div class="text-sm lg:flex-grow">

        </div>
      </div>
    </div>
  </nav>
</header>
@yield('content')
<footer class="bg-blue-400">
  <div class="flex flex-row container mx-auto">
    <div class="flex justify-center items-center w-full">
      <p class="text-white text-xs">Copyright (c) 2019 coderman.ru</p>
    </div>
  </div>
</footer>
<script src="{{asset('js/app.js')}}"></script>
</body>
</html>
