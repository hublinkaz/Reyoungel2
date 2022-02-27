@extends('layouts.simple.master')
@section('title', 'Edit Profile')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>{{ trans('lang.Edit Profile') }}</h3>
@endsection



@section('content')
    <div class="container-fluid">
        <div class="edit-profile">
            <div class="row">

                <div class="col-xl-8">
                    <form class="card" action="{{ route('account.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="card-header">
                            <div class="row mb-2">
                                <div class="profile-title">
                                    <div class="media">
                                        <img class="img-70 rounded-circle" alt="image" src="/public/assets/images/avtar/{{$account->image}}">

                                        <div class="media-body">
                                            <h3 class="mb-1">{{$account->first_name}} {{$account->last_name}}</h3>
                                            <p>{{\App\Models\Roles::where('id',$account->role_id)->first()->name}}</p>
                                        </div>
                                        <div class="mb-3">
                                            <label class="col-form-label pt-0" for="exampleInputPassword1">{{ trans('lang.image') }}</label>
                                            <input id="image" name="image" class="input-file" type="file" accept="image/*">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
                        </div>

                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">{{ trans('lang.Profile Status') }}</label>
                                        <select required id="last_manager_id" name="is_active" class="form-control"  title="Select Manager...">

                                                @if ($account->is_active==0)
                                                    <option selected value="0">{{ trans('lang.Deactivate') }} </option>
                                                    <option  value="1">{{ trans('lang.Active') }} </option>
                                                    <option value="2">{{ trans('lang.Banned') }}  </option>
                                                @elseif ($account->is_active==1)
                                                    <option  value="0">{{ trans('lang.Deactivate') }} </option>
                                                    <option selected value="1">{{ trans('lang.Active') }} </option>
                                                    <option value="2"> Banned </option>
                                                @elseif($account->is_active==2)
                                                    <option  value="0">{{ trans('lang.Deactivate') }} </option>
                                                    <option  value="1">{{ trans('lang.Active') }} </option>
                                                    <option selected value="2">{{ trans('lang.Banned') }} </option>
                                                @endif


                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">{{ trans('lang.First Name') }}</label>
                                        <input class="form-control" type="text" placeholder="First Name" name="first_name" id="first_name" value="{{$account->first_name}}">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">{{ trans('lang.Last Name') }}</label>
                                        <input class="form-control" type="text" placeholder="Last Name" name="last_name" id="last_name" value="{{$account->last_name}}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="col-form-label">{{ trans('lang.Card identity')}}</label>
                                        <input class="form-control" type="text" name="card_number" value="{{$account->card_number}}" placeholder="Card identity" id="card_number">
                                    </div>
                                </div>
                                @if(\Illuminate\Support\Facades\Auth::user()->role_id==1)
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">{{ trans('lang.Email address') }}</label>
                                        <input class="form-control" type="email" placeholder="Email"  name="email" value="{{$account->email}}">
                                    </div>
                                </div>
                                @else
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">{{ trans('lang.Email address') }}</label>
                                            <input class="form-control" type="email" placeholder="Email" disabled name="email" value="{{$account->email}}">
                                        </div>
                                    </div>
                                @endif
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">{{ trans('lang.Phone number') }} </label>
                                        <input class="form-control" type="text" placeholder="Phone" name="phone" value="{{$account->phone}}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Telegram iD </label>
                                        <input class="form-control" type="text" placeholder="Phone" name="telegram" value="{{$account->telegram_user_id}}">
                                    </div>
                                </div>
                                @if($account->role_id ==5)
                                    <input class="" type="hidden" name="id" value="{{$account->user_id}}">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">{{ trans('lang.Address') }}</label>
                                            <input class="form-control" type="text" placeholder="Address" name="location" value="{{$account->location}}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">{{ trans('lang.Work Address') }}</label>
                                            <input class="form-control" type="text" placeholder="work place" name="workplace" value="{{$account->workplace}}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">{{ trans('lang.Managers') }} </label>
                                            <select required id="last_manager_id" name="last_manager_id" class="form-control"  title="Select Manager...">
                                                @foreach($managers as $manager)
                                                    @if ($manager->user_id==$account->last_manager_id)
                                                        <option selected value="{{$manager->user_id}}">{{$manager->first_name}}  {{$manager->last_name}} </option>
                                                    @else
                                                      <option value="{{$manager->user_id}}">{{$manager->first_name}}  {{$manager->last_name}} </option>
                                                    @endif

                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @elseif($account->role_id ==4)

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">{{ trans('lang.Car Number') }}</label>
                                            <input class="form-control" type="text" placeholder="work place" name="car_number" value="{{$account->car_number}}">
                                        </div>
                                    </div>
                                    <input class="" type="hidden" name="id" value="{{$account->id}}">

                                @else
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">{{ trans('lang.Percentage') }}</label>
                                            <input class="form-control" type="text" placeholder="percentage_value" name="percentage_value" value="{{$account->percentage_value}}">
                                        </div>
                                    </div>
                                    <input class="" type="hidden" name="id" value="{{$account->id}}">
                                @endif
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <button class="btn btn-primary" type="submit">{{ trans('lang.Submit') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection
