@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-15">
                <div class="panel panel-default">
                    <div class="panel-heading">Create post</div>
                    <div class="panel-heading">@include('layouts.search')</div>
                    <div class="panel-body">

                        <form method="POST" action="
                        {{ URL::route('admin.articles.store') }}">

                            {{ csrf_field() }}

                            <!-- title -->
                            <label for="title">Title</label>
                            <input class="input-text" name="title" type="text" value="" id="title">

                            <!-- description -->
                            <label for="description">Description</label>
                            <textarea class="input-textarea" name="description" id="description"></textarea>

                            <!-- tags -->
                            <label for="tags">Tags</label>
                            <input class="input-text" name="tags" type="text" value="" id="tags">
                            <input type="submit" value="Create article">
                        </form>

                    </div>
                    <div class="panel-footer">
                        <a style="margin: 0 5px" href="{{ route('admin.articles.index') }}">Index</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
