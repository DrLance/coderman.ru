<?php
$totalPages = $paginator->count();
$perPage = $paginator->perPage();
$lastPage= $paginator->lastPage();

if(!$paginator->hasPages()) return;
?>
<div class="flex items-center float-right pr-1">
  @if($paginator->previousPageUrl())
    <a href="{{$paginator->previousPageUrl()}}" class="pr-2">
      <div class="sp-icon ico-pager-prev"></div>
      <span>&#10094;</span>
    </a>
  @endif
  <ul class="flex">
    @foreach($elements as $element)

      @if (is_string($element))
        <li  aria-disabled="true">
          <span class="px-4">{{ $element }}</span>
        </li>
      @endif
      {{-- Array Of Links --}}
      @if (is_array($element))
        @foreach ($element as $page => $url)
          @if ($page == $paginator->currentPage())
            <li class="active shadow font-bold" aria-current="page">
              <a class="px-4" href="{{$url}}">{{$page}}</a>
            </li>
          @else
            <li class="border-dashed">
              <a class="px-4" href="{{ $url }}">{{ $page }}</a>
            </li>
          @endif
        @endforeach
      @endif
    @endforeach
  </ul>
  @if($paginator->nextPageUrl())
    <a href="{{$paginator->nextPageUrl()}}" class="pl-2">
      <span>&#10095;</span>
      <div class="sp-icon ico-pager-next"></div>
    </a>
  @endif
</div>
