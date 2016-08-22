Tags:
@for ($i = 0; $i < count($tags); $i++)
        <a href="{{ route('web.articles.index', ['query' => '#' . $tags[$i]->name]) }}">
                {{ $tags[$i]->name }}
        </a>
        @if ($i != count($tags) - 1), @endif
@endfor
