<aside class="md:w-4/12 order-0 md:order-1 flex flex-col md:flex md:flex-col">
  <div class="w-full md:pl-4 mb-5">
    <div class="shadow pl-4 px-1 py-1 rounded">
      <p class="uppercase p-2 text-center text-sm font-bold text-heading">{{trans('welcome.last_articles')}}</p>
      <ul class="list-none pl-0">
        @foreach($last_articles as $lastArticle)
          <li>
            <a href="{{config('app.url') . '/' . $lastArticle->type . '/' . $lastArticle->slug}}" target="_blank" class="text-heading">
              {{$lastArticle->title}}
            </a>
          </li>
        @endforeach
      </ul>
    </div>
  </div>
</aside>
