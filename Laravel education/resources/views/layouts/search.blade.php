<form method="GET" action="{{ URL::route('web.articles.index') }}">
    <input type="text" class="input-search" name="query" placeholder="Some text..." />
    <input type="submit" class="submit-search" value="Search" />
</form>
