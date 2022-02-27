@extends('frontend.layout')

@section('content')

    <div class="container container-content">
        @trix($page, 'content')

        {!! $page->trix('content') !!} //must use HasTrixRichText trait in order for $model->trix() method work

        {!! app('laravel-trix')->make($page, 'content') !!}


    </div>

@endsection
