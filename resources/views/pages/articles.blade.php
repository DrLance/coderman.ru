@extends('layouts.front')
@section('content')
  <h1 class="text-center text-xl font-bold text-heading my-10">{{$page->title}}</h1>
  <div class="flex flex-row mx-auto container-main mb-32">
    <div class="flex flex-col md:w-9/12">
      {!! $page->content !!}
    </div>
    @include('pages.sidebar.sidebar')
  </div>
@endsection
