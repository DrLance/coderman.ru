@extends('layouts.front')
@section('content')
  <div class="container mx-auto flex-col">
    <h1 class="py-10 text-center text-xl font-bold">
      Актуальные данные собранные с популярных российский бирж фриланса
    </h1>
    <div class="flex flex-col ">
      <h2 class="self-center p-5 text-lg">Сайт находится в активной разработке, но уже сейчас можно следить онлайн за
        актуальными данными</h2>
      <h3 class="text-gray-700">Список бирж с которых происходит сбор заказов:</h3>
      <ul class="mb-5 flex items-center flex-wrap">
        @foreach($types as $type)
          <li class="shadow rounded p-5 mr-5 font-bold text-center flex items-center mt-5 hover:shadow-xl">
            @if($type->img_url)
              <img class="h-5 mr-2" src="{{asset('/storage/type') . '/' . $type->img_url}}">
            @endif
            {{$type->name}}
          </li>
        @endforeach
      </ul>
      <div class="flex items-center mt-4">
        <p class="mr-1">актуальный заказы доступны по ссылке:</p>
        <a class="text-blue-500" href="{{route('monitoring')}}"> Мониторинг</a>
      </div>
    </div>
  </div>
@endsection
