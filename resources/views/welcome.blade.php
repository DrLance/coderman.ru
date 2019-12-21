@extends('layouts.front')
@section('content')
  <section class="container-main md:mx-auto flex-col px-4 md:px-0 mt-6 md:mt-12">
    <h1 class="mb-5 w-25  text-center text-2xl sm:text-4xl text-heading leading-none">
      {{ trans('welcome.welcome')}}
    </h1>
    <div class="flex flex-col ">
      <h2 class="py-5 sm:text-lg text-content text-center leading-snug">
        {{ trans('welcome.welcome_sub')}}:
      </h2>
      <ul class="flex justify-center items-center flex-wrap">
        @foreach($types as $type)
          <li
            class="shadow rounded px-3 py-4 mr-2 sm:mr-4 font-bold text-center flex items-center mt-2  hover:shadow-xl">
            @if($type->img_url)
              <img class="h-5 mr-2" src="{{asset('/storage/type') . '/' . $type->img_url}}" alt="{{$type->name}}">
            @endif
            {{$type->name}}
          </li>
        @endforeach
      </ul>
      <div class="flex items-center mt-4">

      </div>
    </div>
  </section>
  <section class="mt-12 md:mt-24 px-4 md:px-0">
    <h2 class="text-heading text-lg md:text-xl uppercase text-center font-bold">{{trans('welcome.advantages')}}</h2>
    <div class="flex flex-col justify-center container-main md:mx-auto md:flex-row mt-5 flex-wrap">
      <div class="shadow border border-border rounded px-4 py-4 md:w-1/4 md:mx-10 mt-3 flex items-center flex-col">
        <img class="py-4" src="{{asset('img/tax.png')}}" alt="">
        <h3 class="text-heading text-center text-lg">{{trans('welcome.fully_free')}}</h3>
        <p class="text-center text-content pt-3">{{trans('welcome.fully_free_desc')}}</p>
      </div>
      <div class="shadow border border-border rounded px-4 py-4 md:w-1/4 md:mx-10 mt-3 flex items-center flex-col">
        <img class="py-4" src="{{asset('img/folder.png')}}" alt="">
        <h3 class="text-heading text-center text-lg">{{trans('welcome.orders_in_one_place')}}</h3>
        <p class="text-center text-content pt-3">{{trans('welcome.orders_in_one_place_desc')}}</p>
      </div>
      <div class="shadow border border-border rounded px-4 py-4 md:w-1/4 md:mx-10 mt-3 flex items-center flex-col">
        <img class="py-4" src="{{asset('img/filter.png')}}" alt="">
        <h3 class="text-heading text-center text-lg">{{trans('welcome.usefull_filter')}}</h3>
        <p class="text-center text-content pt-3">{{trans('welcome.usefull_filter_desc')}}</p>
      </div>
      <div
        class="shadow border border-border rounded px-4 py-4 md:w-1/4 md:mx-10 mt-3 md:mt-8 flex items-center flex-col">
        <img class="py-4" src="{{asset('img/deadline.png')}}" alt="">
        <h3 class="text-heading text-center text-lg">{{trans('welcome.economy_time')}}</h3>
        <p class="text-center text-content pt-3">{{trans('welcome.economy_time_desc')}}</p>
      </div>
    </div>
  </section>
  <section class="mt-12 md:mt-24 px-4 md:px-0 md:mb-20">
    <h2 class="text-heading text-lg md:text-xl uppercase text-center font-bold">{{trans('welcome.last_projects')}}</h2>
    <div class="flex flex-col justify-center container-main md:mx-auto mt-5 flex-wrap md:w-1/3">
      @foreach($projects as $project)
        <a href="{{$project->url}}" class="shadow border border-border rounded px-1 py-1 flex items-center flex-row mt-1">
          <img class="w-4 mx-2" src="{{asset('/storage/type') . '/' . $project['type']->img_url}}" alt="{{$project['type']->name}}">
          <p class="text-center text-content">{{$project->title}}</p>
        </a>
      @endforeach
    </div>
  </section>
@endsection
