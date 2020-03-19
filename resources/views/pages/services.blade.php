@extends('layouts.front')
@section('custom_head')
  <link href="{{config('app.url')}}/packages/ckeditor/plugins/codesnippet/lib/highlight/styles/github.css" rel="stylesheet">
@endsection
@section('content')
  <div class="container-main mx-auto flex-col mb-32">
    <h1 class="py-10 text-center text-xl font-bold text-heading">
      {{$page->title}}
    </h1>
    {!! $page->content !!}
  </div>
@endsection

@section('custom_footer')
  <script src="{{config('app.url')}}/packages/ckeditor/plugins/codesnippet/lib/highlight/highlight.pack.js"></script>
  <script>hljs.initHighlightingOnLoad();</script>
@endsection
