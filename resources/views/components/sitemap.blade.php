<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  @foreach ($pages as $page)
    <url>
      @if($page->type)
        <loc>{{ config('app.url') . '/' . $page->type . '/' . $page->slug }}</loc>
      @else
        <loc>{{ route($page->slug) }}</loc>
      @endif
      <lastmod>{{ $page->updated_at->tz('GMT')->toAtomString() }}</lastmod>
      <changefreq>monthly</changefreq>
      <priority>1</priority>
    </url>
  @endforeach
</urlset>
