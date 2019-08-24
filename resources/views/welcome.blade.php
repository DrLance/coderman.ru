@extends('layouts.front')
@section('content')
  <div class="container mx-auto flex-col">
    <h1 class="py-10 text-center text-xl font-bold">
      Актуальные данные собранные с популярных российский бирж фриланса
    </h1>
    <div class="flex flex-col ">
      <h2 class="self-center p-5">Сайт находится в активной разработке, но уже сейчас можно следить онлайн за
        актуальными данными</h2>
      <h3 class="">Список бирж с которых происходит сбор заказов:</h3>
      <ul class="pt-4">
        @foreach($types as $type)
          <li>{{$type->name}}</li>
        @endforeach
      </ul>
      <p class="mt-4">актуальный заказы доступны по ссылке:</p>
      <a class="text-blue-500" href="{{route('monitoring')}}"> Мониторинг</a>
    </div>
  </div>
@endsection
