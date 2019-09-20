@extends('layouts.front')
@section('content')
  <section class="container-main md:mx-auto flex-col px-4 md:px-0 mt-6 md:mt-12">
    <h1 class="mb-5 text-center text-2xl sm:text-4xl text-heading leading-none">
      Актуальные данные собранные<br> с популярных российских бирж фриланса
    </h1>
    <div class="flex flex-col ">
      <h2 class="py-5 sm:text-lg text-content text-center leading-snug">Фриланс биржи с которых ведется сбор заказов:</h2>
      <ul class="flex justify-center items-center flex-wrap">
        @foreach($types as $type)
          <li class="shadow rounded px-3 py-4 mr-2 sm:mr-4 font-bold text-center flex items-center mt-2  hover:shadow-xl">
            @if($type->img_url)
              <img class="h-5 mr-2" src="{{asset('/storage/type') . '/' . $type->img_url}}">
            @endif
            {{$type->name}}
          </li>
        @endforeach
      </ul>
      <div class="flex items-center mt-4">

      </div>
    </div>
  </section>
  <section class="mt-12 md:mt-24 px-4 md:px-0">
    <h2 class="text-heading text-lg md:text-xl uppercase text-center font-bold">Преимущества сайта</h2>
    <div class="flex flex-col justify-center container-main md:mx-auto md:flex-row mt-5 flex-wrap">
      <div class="shadow border border-border rounded px-4 py-4 md:w-1/4 md:mx-10 mt-3 flex items-center flex-col">
        <img class="py-4" src="{{asset('img/tax.png')}}" alt="">
        <h3 class="text-heading text-center text-lg">Полность бесплатный</h3>
        <p class="text-center text-content pt-3">Нету никаких скрытыйх платежей, все по настоящему бесплатно</p>
      </div>
      <div class="shadow border border-border rounded px-4 py-4 md:w-1/4 md:mx-10 mt-3 flex items-center flex-col">
        <img class="py-4" src="{{asset('img/folder.png')}}" alt="">
        <h3 class="text-heading text-center text-lg">Заказы в одном месте</h3>
        <p class="text-center text-content pt-3">Заказы собираются в одном месте для удобного поиска</p>
      </div>
      <div class="shadow border border-border rounded px-4 py-4 md:w-1/4 md:mx-10 mt-3 flex items-center flex-col">
        <img class="py-4" src="{{asset('img/filter.png')}}" alt="">
        <h3 class="text-heading text-center text-lg">Удобный фильтр</h3>
        <p class="text-center text-content pt-3">Удобный фильтр который позволяет фильтровать не только по биржам но и ключевым словам</p>
      </div>
      <div class="shadow border border-border rounded px-4 py-4 md:w-1/4 md:mx-10 mt-3 md:mt-8 flex items-center flex-col">
        <img class="py-4" src="{{asset('img/deadline.png')}}" alt="">
        <h3 class="text-heading text-center text-lg">Экономия времени</h3>
        <p class="text-center text-content pt-3">При поиске новых заказов Вам не придется тратить много времени</p>
      </div>
    </div>
  </section>
@endsection
