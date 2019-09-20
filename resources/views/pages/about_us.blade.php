@extends('layouts.front')
@section('content')
  <div class="container mx-auto flex-col mb-32">
    <h1 class="py-10 text-center text-xl font-bold text-heading">
      О проекте.
    </h1>
    {!! $page->content !!}
  </div>
@endsection
