@extends('layouts.front')
@section('content')
  <div class="container mx-auto flex-col">
    <h1 class="py-10 text-center text-xl font-bold">
      Актуальные данные собранные с популярных российский бирж фриланса
    </h1>
    <div class="flex md:flex-row sm:flex-col">
      <div class="md:w-9/12 sm:overflow-hidden">
        <table class="table-fixed w-full rounded mb-3">
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
                @if(isset($data->type->img_url))
                <img class="p-2 h-8 w-8" src="{{\Storage::url('type/' .$data->type->img_url,'type')}}"
                     alt="{{$data->title}}">
                @endif
                <a target="_blank" href="{{$data->url}}" class="text-sm"
                   title="{{$data->title}}" rel="nofollow">{{$data->title}}</a>
              </td>
              <td class="pl-4 text-sm border-l border-r">{{Str::limit($data->description,100)}}</td>
              <td class="text-center text-xs ">{{$data->created_date}}</td>
            </tr>
          @endforeach
          </tbody>
        </table>
        <div class="mb-16">

        </div>
      </div>
      <aside class="md:w-3/12 flex">
        <div class="w-full pl-4">
          <div class="shadow pl-4 px-5 py-2 rounded">
            <p class="uppercase mb-5 text-center">фильтр</p>
            <form action="{{route('home')}}" method="post" class="flex flex-col">
              @csrf
              <label for="filter_type" class="flex flex-col font-bold">Фриланс биржа
              <select class="mb-5 mt-1 py-1 border-b-2 mb-3 text-lg" name="filter_type">
                <option value="0">Все</option>
                @foreach($types as $type)
                  <option {{$filter_type == $type->id ? 'selected' : ''}} value="{{$type->id}}">{{$type->name}}</option>
                @endforeach
              </select>
                <label class="pb-3">Ключевые слова
                  <input name="keywords" class="border-b-2">
                </label>
              </label>
                <button class="bg-green-600 rounded py-2 shadow text-white" type="submit">Отфильтровать</button>
            </form>
          </div>
        </div>
      </aside>
    </div>
  </div>
@endsection
