<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  @if(!config('app.is_local'))
    <meta name="yandex-verification" content="470b665093f69585"/>
  @endif
  <meta name="csrf-token" content="{{csrf_token()}}">
  @if(isset($page))
    <meta name="title" content="{{$page['meta_title']}}">
    <meta name="description" content="{{$page['meta_description']}}">
    <meta name="keywords" content="{{$page['meta_keywords']}}">
  @else
    <meta name="title" content="Агрегатор фриланс бирж">
    <meta name="description"
          content="Устали заходить на сайты разных фриланс бирж? Теперь ненужно.
        Агрегатор фриланс бирж, собирает данные со всех известных фриланс бирж в одном месте. А так же интересные статьи и новости">
    <meta name="keywords" content="работа, фриланс, биржи, агрегатор, статистика, freelance, jobs">
  @endif
  <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
  <link rel="stylesheet" href="{{asset('css/app.css')}}">
  @if(isset($page))
    <title>{{$page['title']}}</title>
  @else
    <title>Агрегатор фриланс бирж | Coderman.ru</title>
  @endif

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
    <script data-ad-client="ca-pub-9000638518102810" async
            src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
  @endif
  @yield('custom_head')
</head>
<body>
<header class="border-b border-border">
  @php $locale = session()->get('locale'); @endphp
  <nav class="flex items-center justify-between flex-wrap py-6 container-main md:mx-auto mx-2 md:mx-0">
    <div class="md:w-full w-full">
      <div class="flex md:justify-between items-center">
        <a href="/" title="coderman.ru">
          <img class="h-12 rounded" src="{{config('app.url')}}/apple-touch-icon.png" alt=""/>
        </a>
        <div id="menu" class="flex flex-col text-sm ml-5 md:justify-end md:flex md:flex-row">
          <a class="text-content text-13p mr-10 hover:text-blue" href="{{route('stat')}}">{{trans('menu.stat')}}</a>
          <a class="text-content text-13p mr-10  hover:text-blue" href="{{route('monitoring')}}">{{trans('menu.monitoring')}}</a>
          <a class="text-content text-13p mr-10 hover:text-blue" href="{{route('about')}}">{{trans('menu.about')}}</a>
        </div>
      </div>
    </div>
  </nav>
</header>
<main class="mb-5">
  @yield('content')
</main>
<footer class="border-t border-border mx-2 sm:mx-0">
  <div class="container-main mx-auto mt-5 pb-4">
    <div class="flex flex-col items-center md:flex-row pb-5">
      <div class="md:w-1/3">
      </div>
      <div class="md:w-1/3 flex flex-col">
        <a class="text-content text-13p hover:text-blue" href="{{route('stat')}}">
          {{trans('menu.stat')}}
        </a>
        <a class="text-content text-13p hover:text-blue mt-2" href="{{route('monitoring')}}">
          {{trans('menu.monitoring')}}
        </a>
        <a class="text-content text-13p hover:text-blue mt-2" href="{{route('about')}}">
          {{trans('menu.about')}}
        </a>
      </div>
      <div class="md:w-1/3 flex flex-col items-end justify-center ">
        <a href="https://t.me/coderman_fl"
           class="text-content text-sm flex flex-row items-center  md:justify-end  font-bold mb-2">
          <img class="pr-2 h-6 w-7" src="{{config('app.url')}}/img/telegram.svg" alt="Coderman_fl">
          @Coderman_fl</a>
        <!-- Rating Mail.ru logo -->
        <a href="https://top.mail.ru/jump?from=3154562">
          <img src="https://top-fwz1.mail.ru/counter?id=3154562;t=479;l=1" style="border:0;" height="31" width="88"
               alt="Top.Mail.Ru"/></a>
        <!-- //Rating Mail.ru logo -->
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
@if(!config('app.is_local'))
  <!-- Rating Mail.ru counter -->
  <script type="text/javascript">
    var _tmr = window._tmr || (window._tmr = []);
    _tmr.push({ id: "3154562", type: "pageView", start: (new Date()).getTime() });
    (function(d, w, id) {
      if (d.getElementById(id)) return;
      var ts = d.createElement("script");
      ts.type = "text/javascript";
      ts.async = true;
      ts.id = id;
      ts.src = "https://top-fwz1.mail.ru/js/code.js";
      var f = function() {
        var s = d.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(ts, s);
      };
      if (w.opera == "[object Opera]") {
        d.addEventListener("DOMContentLoaded", f, false);
      } else {
        f();
      }
    })(document, window, "topmailru-code");
  </script>
  <noscript>
    <div>
      <img src="https://top-fwz1.mail.ru/counter?id=3154562;js=na" style="border:0;position:absolute;left:-9999px;"
           alt="Top.Mail.Ru"/>
    </div>
  </noscript>
  <!-- //Rating Mail.ru counter -->
@endif
@yield('custom_footer')
</body>
</html>
