@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-15">
                <div class="panel panel-default">
                    <div class="panel-heading">Articles</div>
                    <div class="panel-heading">@include('layouts.search')</div>
                    <div class="panel-heading">@include('layouts.tag-list')</div>
                    <div class="panel-body">
                        <div>
                            @foreach ($articles as $article)
                                <div class="article-title">
                                    <a href="{{ route('web.articles.show', [ $article->id ]) }}">{{ $article->title }}</a>
                                </div>
                                <div class="article-description">{!! $article->description !!}</div>
                                <div class="article-datetime">{{ $article->created_at }}</div>
                                @include('layouts.post-tag-list')
                                <br/>
                            @endforeach
                        </div>


                            {{ $articles->links() }}


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
