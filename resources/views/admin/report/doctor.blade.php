@extends('admin.layouts.simple.master')
@section('title', 'Default Forms')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>{{ trans('lang.Select Date') }}</h3>
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

                            <form class="theme-form" action="{{ route('report.doctor.post') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <div class="row g-2">
                                        <div class="col-6">
                                    <label class="col-form-label">{{ trans('lang.Beginning') }}</label>
                                    <input class="form-control" type="date" id="date_start" name="date_start" required="" placeholder="{{ trans('lang.Beginning Date') }}">
                                        </div>
                                        <div class="col-6">
                                            <label class="col-form-label">{{ trans('lang.Finish Date') }}</label>
                                            <input class="form-control" type="date" id="date_end" name="date_end" required="" placeholder="{{ trans('lang.Finish Date') }}">
                                        </div>
                                    </div>
                                </div>

                                    <div class="form-group">
                                        <div class="row g-2">
                                            <div class="col-6">
                                        <label>{{trans('lang.Doctors')}} *</label>
                                        <select required id="manager_id" name="manager_id" class="form-control"  title="Select Manager...">
                                            @foreach($managers as $manager)
                                                <option value="{{$manager->id}}">{{$manager->manager_first_name}} {{$manager->manager_last_name}} | {{$manager->first_name}} {{$manager->last_name}} </option>
                                            @endforeach
                                        </select>
                                            </div>
                                        </div>
                                    </div>

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
