@extends('layouts.front')
@section('content')
  <div class="container-main sm:mx-auto flex-col mx-2 w-full">
    <h1 class="mt-20 text-left sm:text-center text-2xl sm:text-4xl text-heading">
      Актуальные данные собранные<br> с популярных российских бирж фриланса
    </h1>
    <div class="flex flex-col ">
      <h2 class="self-center sm:p-5 sm:text-lg text-content sm:text-center">Сайт находится в активной разработке, <br>но уже сейчас можно следить онлайн за
        актуальными данными следующих бирж:</h2>
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
  </div>
@endsection
