@extends('layouts.front')
@section('custom_head')
  <link href="{{asset('css/prism.css')}}" rel="stylesheet"/>
@endsection
@section('content')
  <h1 class="text-center text-xl md: text-3xl font-bold text-heading my-10">{{$page->title}}</h1>
  <div class="flex flex-row mx-auto container-main mb-32">
    <div class="flex flex-col md:w-9/12 text-lg">
      <div class="flex flex-row mb-5">
        <p class="text-xs text-content">{{trans('articles.created')}}: {{$page->created_at->format('d.m.Y h:i')}}</p>
        <p class="ml-2 text-xs text-content">{{trans('articles.updated')}}: {{$page->updated_at->format('d.m.Y h:i')}}</p>
      </div>
      {!! $page->content !!}
    </div>
    @include('pages.sidebar.sidebar')
  </div>
@endsection
