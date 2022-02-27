@extends('admin.layouts.simple.master')
@section('title', 'Default Forms')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>{{ trans('lang.Add Page') }}</h3>
@endsection

@section('breadcrumb-items')

@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="row">





                        <form method="POST" action="{{ route('page.create.post') }}">
                            @csrf
                            @trix(\App\Pages::class, 'content')
                            <input type="submit" class="btn btn-primary btn-block mt-4">
                        </form>




            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection
