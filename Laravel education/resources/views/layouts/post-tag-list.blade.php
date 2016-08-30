<div class="article-tags">
    @for ($i = 0; $i < count($article->tags); $i++)
        <a href="{{ route('web.articles.index', ['query' => '#' . $article->tags[$i]->name]) }}">
                {{ $article->tags[$i]->name }}
        </a>
        @if ($i != count($article->tags) - 1), @endif
    @endfor
</div>
