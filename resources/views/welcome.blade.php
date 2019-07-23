@extends('layouts.front')
@section('content')
  <div class="container mx-auto flex-col">
    <h1 class="p-5 text-center text-xl font-bold">Актуальный данные собранных с популярных российский бирж
      фриланса</h1>
    <div class="flex md:flex-row sm:flex-col">
      <div class="md:w-9/12 sm:overflow-hidden">
        <table class="table-fixed w-full ">
          <thead class="border-t">
          <tr class="text-bold">
            <th class="py-4 px-6 font-sans font-bold uppercase text-black border-r border-l border-b-2">
              Ссылка
            </th>
            <th class="py-4 px-6 font-sans font-bold uppercase text-black border-r border-b-2">
              Описание
            </th>
            <th class="py-4 md:px-6 font-sans font-bold uppercase text-black border-r border-b-2 ">
              Дата добавления
            </th>
          </tr>
          <tbody>
          @foreach($parsedData as $data)
            <tr class="hover:shadow border">
              <td class="flex flex-row items-center">
                <img class="p-2" src="{{\Storage::url('type/' .$data->type->img_url,'type')}}">
                <a target="_blank" href="{{$data->url}}" class="text-sm">{{$data->title}}</a>
              </td>
              <td class="pl-4 text-sm border-l border-r">{{Str::limit($data->description,70)}}</td>
              <td class="text-center text-sm">{{$data->date_published_at}}</td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
      <aside class="md:w-3/12 shadow">

      </aside>
    </div>
  </div>
@endsection
