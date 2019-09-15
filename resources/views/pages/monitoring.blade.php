@extends('layouts.front')
@section('content')
  <div class="container mx-auto flex-col">
    <h1 class="py-10 text-center text-heading text-xl">
      Данные обновляются с интервалом в 5 секунд.
    </h1>
    <div class="flex md:flex-row sm:flex-col" id="table">
    </div>
  </div>
@endsection
