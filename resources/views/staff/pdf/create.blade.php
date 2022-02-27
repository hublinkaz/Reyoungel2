@extends('staff.layouts.simple.master')
@section('title', 'Default Forms')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>Tarix Seçin</h3>
@endsection

@section('breadcrumb-items')

@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">

                            <form class="theme-form" action="{{ route('pdf.post') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label class="col-form-label">Başlanğıc</label>
                                    <input class="form-control" type="date" id="date_start" name="date_start" required="" placeholder="Başlanğıc Tarix">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Bitiş</label>
                                    <input class="form-control" type="date" id="date_end" name="date_end" required="" placeholder="Bitiş Tarix">
                                </div>

                                <input class="form-control" type="hidden"  name="manager_id" id="user" value="{{$id}}" >

                                <input class="form-control" type="hidden"  name="pdf" id="pdf" value="{{time()}}" >
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">{{ trans('lang.Submit') }}</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection
