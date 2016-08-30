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
                    <div class="panel-footer">
                        <a style="margin: 0 5px" href="{{ route('admin.articles.index') }}">Index</a>
                        <a style="margin: 0 5px" href="{{ route('admin.articles.edit', [$article->id]) }}">Edit</a>
                        <form class="form-btn-delete" method="post" action="
                          {{ route('admin.articles.destroy', [$article->id]) }}">
                            {{ csrf_field() }}
                            <input name="_method" type="hidden" value="DELETE">
                            <input class="submit-link" type="submit" value="Delete">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
