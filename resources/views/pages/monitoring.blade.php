@extends('layouts.front')
@section('content')
  <div class="container-main mx-2 md:mx-auto flex-col">
    <h1 class="py-10 text-left text-heading md:text-xl md:text-center leading-snug">
      Данные обновляются с интервалом в 5 секунд.
    </h1>
    <div class="flex flex-col md:flex-row" id="table">
    </div>
  </div>
@endsection
