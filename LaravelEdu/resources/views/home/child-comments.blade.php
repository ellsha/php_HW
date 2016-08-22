<div>
    {{ $comment['user']['name'] }}
    {{ $comment['created_at'] }}
    <p>{{ $comment['text'] }}</p>
    @include('home.add-comment', [
        'article_id' => $comment['article_id'],
        'comment_id' => $comment['id']
    ])
</div>

@if (count($comment['children']) > 0)
    <ul>
        @if( ! empty($comment['children']))

        @foreach($comment['children'] as $comment)
            @include('home.child-comments', $comment)
        @endforeach

        @endif
    </ul>
@endif
