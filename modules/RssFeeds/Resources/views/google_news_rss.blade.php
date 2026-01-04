<?xml version="1.0" encoding="UTF-8" ?>
<rss version="2.0"
     xmlns:atom="http://www.w3.org/2005/Atom"
     xmlns:media="http://search.yahoo.com/mrss/"
     xmlns:dc="http://purl.org/dc/elements/1.1/">
<channel>
  <title>{{ htmlspecialchars($website_title) }}</title>
  <link>{{ url('/') }}</link>
  <description>Latest news from {{ htmlspecialchars($website_title) }}</description>

  @foreach($newsItems as $news)
    @php
        $langPath = $news->language->value === $defaultLang ? '' : trim($news->language->value, '/') . '/';
        $linkUrl = url($langPath . $news->encode_title) . '/';

        $image_path = $news->photoLibrary && $news->photoLibrary->large_image
                    ? asset('storage/' . $news->photoLibrary->large_image)
                    : null;
    @endphp

    <item>
        <title>{{ $news->title }}</title>
        <link>{{ $linkUrl }}</link>
        <atom:link href="{{ $linkUrl }}" rel="self" type="application/rss+xml" />
        <guid isPermaLink="true">{{ $linkUrl }}</guid>
        <pubDate>{{ $news->last_update->toRssString() }}</pubDate>
        <description><![CDATA[{{ Str::limit(clean_news_content($news->news), 500) }}]]></description>
        @if(!empty($image_path))
            <media:content url="{{ $image_path }}" medium="image" />
        @endif
        <dc:creator>{{ $news->postByUser->full_name ?? 'Admin' }}</dc:creator>
    </item>
  @endforeach
</channel>
</rss>
