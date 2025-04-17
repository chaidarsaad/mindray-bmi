{!! '<?xml version="1.0" encoding="UTF-8"?>' !!}

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
                            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">

    {{-- Static Pages --}}
    <url>
        <loc>{{ route('home') }}</loc>
        <lastmod>{{ now()->toIso8601String() }}</lastmod>
        <priority>1.00</priority>
    </url>
    <url>
        <loc>{{ route('usg.all') }}</loc>
        <lastmod>{{ now()->toIso8601String() }}</lastmod>
        <priority>1.00</priority>
    </url>
    <url>
        <loc>{{ route('training.all') }}</loc>
        <lastmod>{{ now()->toIso8601String() }}</lastmod>
        <priority>1.00</priority>
    </url>
    <url>
        <loc>{{ route('article.all') }}</loc>
        <lastmod>{{ now()->toIso8601String() }}</lastmod>
        <priority>1.00</priority>
    </url>

    {{-- Articles --}}
    @foreach ($articles as $article)
        <url>
            <loc>{{ route('detail.article', $article->slug) }}</loc>
            <lastmod>{{ $article->updated_at->toIso8601String() }}</lastmod>
            <priority>0.80</priority>
        </url>
    @endforeach

    {{-- Products --}}
    @foreach ($products as $product)
        <url>
            <loc>{{ route('detail.product', $product->slug) }}</loc>
            <lastmod>{{ $product->updated_at->toIso8601String() }}</lastmod>
            <priority>0.80</priority>
        </url>
    @endforeach

    {{-- Trainings --}}
    @foreach ($trainings as $training)
        <url>
            <loc>{{ route('detail.training', $training->slug) }}</loc>
            <lastmod>{{ $training->updated_at->toIso8601String() }}</lastmod>
            <priority>0.80</priority>
        </url>
    @endforeach

</urlset>
