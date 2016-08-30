@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-15">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit post: <i>{{ $article->title }}</i></div>
                    <div class="panel-heading">@include('layouts.search')</div>
                    <div class="panel-body">

                        <form method="POST" action="
                        {{ URL::route('admin.articles.update', ['id' => $article->id]) }}">

                            {{ csrf_field() }}
                            <input name="_method" type="hidden" value="PUT">

                            <!-- title -->
                            <label for="title">Title</label>
                            <input class="input-text" name="title" type="text" value="{{ $article->title }}" id="title">

                            <!-- description -->
                            <label for="description">Description</label>
                            <textarea class="input-textarea" name="description" id="description">{{ $article->markdown_description }}</textarea>
                            <input type="submit" value="Update article">
                        </form>

                    </div>
                    <div class="panel-footer">
                        <a style="margin: 0 5px" href="{{ URL::previous() }}">Prev page</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
