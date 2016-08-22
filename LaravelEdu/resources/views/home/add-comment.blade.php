<div class="add-comment-wrapper">
    <a href="javascript:void(0)" class="comment-hide-show-button">Ответить</a>
    <div class="add-comment-block">
        @<form method="post" action="{{ URL::route('web.comments.store', [ $article_id ]) }}">

            {{ csrf_field() }}
            <input type="hidden" name="article_id" value="{{ $article_id }}">
            <input type="hidden" name="comment_id" value="@if(!empty($comment_id)){{ $comment_id }}@else {{null}} @endif">
            <input type="text" placeholder="Содержание комментария" name="text">
            <input type="submit" name="submit" value="Отправить">

        </form>
    </div>
    <br><br>
</div>
