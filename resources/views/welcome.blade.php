@extends('layouts.front')
@section('content')
  <div class="container mx-auto flex-col">
    <h1 class="p-5 text-center text-xl font-bold">Актуальные данные собранных с популярных российский бирж
      фриланса</h1>
    <div class="flex md:flex-row sm:flex-col">
      <div class="md:w-9/12 sm:overflow-hidden">
        <table class="table-fixed w-full ">
          <thead class="border-t">
          <tr class="text-bold">
            <th class="px-6 font-bold uppercase text-black border-r border-l border-b-2 w-4/12">
              Ссылка
            </th>
            <th class="px-6 font-bold uppercase text-black border-r border-b-2">
              Описание
            </th>
            <th class="md:px-6 font-bold uppercase text-black border-r border-b-2  w-2/12">
              Дата
            </th>
          </tr>
          <tbody>
          @foreach($parsedData as $data)
            <tr class="hover:shadow border">
              <td class="flex flex-row items-center">
                <img class="p-2" src="{{\Storage::url('type/' .$data->type->img_url,'type')}}" alt="{{$data->title}}">
                <a target="_blank" href="{{$data->url}}" class="text-sm" title="{{$data->title}}">{{$data->title}}</a>
              </td>
              <td class="pl-4 text-sm border-l border-r">{{Str::limit($data->description,100)}}</td>
              <td class="text-center text-xs ">{{$data->date_published_at}}</td>
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
