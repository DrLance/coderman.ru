<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="title" content="Фриланс аггрегатор">
  <meta name="description" content="фриланс аггрегатор парсит все извсетные биржи фриланса">
  <meta name="yandex-verification" content="470b665093f69585"/>
  <link rel="stylesheet" href="{{asset('css/app.css')}}">

  <title>Coderman.RU</title>

</head>
<body>
<header>
  <nav class="flex items-center justify-between flex-wrap bg-blue-400 p-6">
    <div class="container mx-auto">
      <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto">
        <div class="text-sm lg:flex-grow">
          <a href="#responsive-header" class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4">
            Docs
          </a>
          <a href="#responsive-header" class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4">
            Examples
          </a>
        </div>
      </div>
    </div>
  </nav>
</header>
<div class="container mx-auto">
  <div class="w-full">
    <table class="table-auto w-full mt-16">
      <thead class="border-t">
      <tr class="text-bold">
        <th class="py-4 px-6 bg-grey-lighter font-sans font-bold uppercase text-black border-r border-l border-b-2">
          Ссылка
        </th>
        <th class="py-4 px-6 bg-grey-lighter font-sans font-bold uppercase text-black border-r border-b-2">
          Описание
        </th>
        <th class="py-4 px-6 bg-grey-lighter font-sans font-bold uppercase text-black border-r border-b-2 ">
          Дата добавления
        </th>
      </tr>
      <tbody>
      @foreach($parsedData as $data)
        <tr class="hover:shadow border-b">
          <td class="border-r border-l flex flex-row items-center">
            <img class="p-2" src="{{\Storage::url('type/' .$data->type->img_url,'type')}}">
            <a target="_blank" href="{{$data->url}}">{{$data->title}}</a>
          </td>
          <td class="border-l pl-4">{{Str::limit($data->description,70)}}</td>
          <td class="text-center border-l border-r">{{$data->date_published_at}}</td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>
</div>
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
