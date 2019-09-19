@extends('layouts.front')
@section('content')
  <div class="container mx-2 md:mx-auto flex-col">
    <h1 class="py-10 text-left text-heading md:text-xl md:text-center leading-snug">
      Данные обновляются с интервалом в 5 секунд.
    </h1>
    <div class="flex md:flex-row sm:flex-col" id="table">
    </div>
  </div>
@endsection
