@extends('layouts.front')
@section('content')
  <div class="container mx-auto flex-col">
    <h1 class="py-10 text-center text-xl font-bold">
      Данные обновляются с интервалом в 5 секунд.
    </h1>
    <div class="flex md:flex-row sm:flex-col">
      <div class="md:w-9/12 sm:overflow-hidden" id="table">

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
