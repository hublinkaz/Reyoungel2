@extends('layouts.simple.master')
@section('title', 'Default Forms')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>Ofis İşçisi yarat</h3>
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
                                    <label class="col-form-label pt-0">Your Name</label>
                                    <div class="row g-2">
                                        <div class="col-6">
                                            <input class="form-control" type="text" id="first_name" name="first_name" required="" placeholder="First Name">
                                        </div>
                                        <div class="col-6">
                                            <input class="form-control" type="text" id="last_name" name="last_name" required="" placeholder="Last Name">

                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Email Address</label>
                                    <input class="form-control" type="email" required="" name="email" placeholder="Email" id="email_address">
                                </div>

                                <div class="form-group">
                                    <label class="col-form-label">Birth Day</label>
                                    <input class="form-control" type="date" id="birth_date" name="birth_date" required="" placeholder="Phone number">

                                </div>

                                <div class="form-group">
                                    <label class="col-form-label">Phone number</label>
                                    <input class="form-control" type="text" id="phone" name="phone" required="" placeholder="Phone number">

                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Password</label>
                                    <input class="form-control" type="password" required="" name="password" placeholder="Password" id="password">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Confirim Password</label>
                                    <input class="form-control" type="password" required="" name="password_confirmation" placeholder="Password" id="password_confirmation">
                                </div>
                                <input class="form-control" type="hidden"  name="role_id" id="role_id" value="3" >
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
