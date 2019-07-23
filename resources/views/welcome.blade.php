<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
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
    <table class="table-auto w-full">
      <thead>
      <tr>
        <th class="py-4 px-6 bg-grey-lighter font-sans font-medium uppercase text-sm text-grey border-b border-grey-light">
          Ссылка
        </th>
        <th class="py-4 px-6 bg-grey-lighter font-sans font-medium uppercase text-sm text-grey border-b border-grey-light">
          Описание
        </th>
        <th class="py-4 px-6 bg-grey-lighter font-sans font-medium uppercase text-sm text-grey border-b border-grey-light">
          Дата добавления
        </th>
      </tr>
      <tbody>
      @foreach($parsedData as $data)
        <tr class="hover:bg-blue-100">
          <td><a href="{{$data->url}}">{{$data->title}}</a></td>
          <td>{{Str::limit($data->description,40)}}</td>
          <td>{{$data->date_published_at}}</td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>
</div>
<script src="{{asset('js/app.js')}}"></script>
</body>
</html>
