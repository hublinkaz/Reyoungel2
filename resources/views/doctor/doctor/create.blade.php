@extends('doctor.layouts.simple.master')
@section('title', 'Default Forms')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>{{ trans('lang.Add Doctor') }}</h3>
@endsection


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">

                            <form class="theme-form" action="{{ route('user.registration') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label class="col-form-label pt-0">{{ trans('lang.Name') }}</label>
                                    <div class="row g-2">
                                        <div class="col-6">
                                            <input class="form-control" type="text" id="first_name" name="first_name" required="" placeholder="{{ trans('lang.First Name') }}">
                                        </div>
                                        <div class="col-6">
                                            <input class="form-control" type="text" id="last_name" name="last_name" required="" placeholder="{{ trans('lang.Last Name') }}">

                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">{{ trans('lang.Email Address') }}</label>
                                    <input class="form-control" type="email" required="" name="email" placeholder="Email" id="email_address">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">{{ trans('lang.Work Address') }}</label>
                                    <input class="form-control" type="text" required="" name="workplace" placeholder="workplace" id="???? Yeri">
                                </div>

                                <div class="form-group">
                                    <label class="col-form-label">{{ trans('lang.Address') }}</label>
                                    <input class="form-control" type="text" required="" name="location" placeholder="??nvan" id="??nvan">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">{{ trans('lang.Birth Day') }}</label>
                                    <input class="form-control" type="date" id="birth_date" name="birth_date" required="" placeholder="Phone number">

                                </div>

                                <div class="form-group">
                                    <label>{{trans('lang.Managers')}} *</label>
                                    <select required id="last_manager_id" name="last_manager_id" class="form-control"  title="Select Manager...">
                                        @foreach($managers as $manager)
                                            <option value="{{$manager->id}}">{{$manager->first_name}} {{$manager->last_name}}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label class="col-form-label">{{ trans('lang.Phone number') }}</label>
                                    <input class="form-control" type="text" id="phone" name="phone" required="" placeholder="Phone number">

                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">{{ trans('lang.Password') }}</label>
                                    <input class="form-control" type="password" required="" name="password" placeholder="Password" id="password">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">{{ trans('lang.Confirim Password') }}</label>
                                    <input class="form-control" type="password" required="" name="password_confirmation" placeholder="Password" id="password_confirmation">
                                </div>
                                <input class="form-control" type="hidden"  name="role_id" id="role_id" value="5" >
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
