@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-15">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $article->title }}</div>
                    <div class="panel-heading">@include('layouts.search')</div>
                    <div class="panel-body">
                        <div>
                            <div class="article-description">{!! $article->description !!}</div>
                            <div class="article-datetime">{{ $article->created_at }}</div>
                            @include('layouts.post-tag-list')
                            <br/>
                        </div>
                    </div>
                    <div class="panel-body">
                        @include('home.comments')
                    </div>
                    <div class="panel-footer">
                        @include('home.add-comment', [
                            'article_id' => $article->id
                        ])
                    </div>
                    <div class="panel-footer">
                        <a style="margin: 0 5px" href="{{ route('web.articles.index') }}">Index</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
