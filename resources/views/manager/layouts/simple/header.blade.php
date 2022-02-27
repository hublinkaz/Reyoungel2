@include('sweetalert::alert')

@php

$notif=\App\Models\Orders::where('is_delivered',0)->groupBy('is_delivered')->count();
@endphp

<div class="page-header">
    <div class="header-wrapper row m-0">
        <form class="form-inline search-full col" action="#" method="get">
            <div class="mb-3 w-100">
                <div class="Typeahead Typeahead--twitterUsers">
                    <div class="u-posRelative">
                        <input class="demo-input Typeahead-input form-control-plaintext w-100" type="text" placeholder="Search Cuba .." name="q" title="" autofocus>
                        <div class="spinner-border Typeahead-spinner" role="status"><span class="sr-only">{{ trans('lang.Loading...') }}</span></div>
                        <i class="close-search" data-feather="x"></i>
                    </div>
                    <div class="Typeahead-menu"></div>
                </div>
            </div>
        </form>
        <div class="header-logo-wrapper col-auto p-0">
            <div class="logo-wrapper"><a href="{{route('manager.dashboard')}}"><img class="img-fluid"  src="{{asset('assets/images/logo/logo.png')}}" alt=""></a></div>
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="align-center"></i></div>
        </div>
        <div class="left-header col horizontal-wrapper ps-0">

        </div>
        <div class="nav-right col-8 pull-right right-header p-0">
            <ul class="nav-menus">
                <li class="onhover-dropdown">
                    <div class="notification-box"><a href="/"> <i data-feather="globe">
                            </i></a>
                    </div>

                </li>
                <li class="language-nav">
                    <div class="translate_wrapper">
                        <div class="current_lang">
                            <div class="lang"><i class="flag-icon flag-icon-{{ (App::getLocale() == 'en') ? 'us' : App::getLocale() }}"></i><span class="lang-txt">{{ App::getLocale() }} </span></div>
                        </div>
                        <div class="more_lang">

                            <a href="{{ request()->url() }}?language=en" class="{{ (App::getLocale()  == 'en') ? 'active' : ''}}">
                                <div class="lang {{ (App::getLocale()  == 'en') ? 'selected' : ''}}" data-value="en"><i class="flag-icon flag-icon-us"></i> <span class="lang-txt">English</span></div>
                            </a>
                            <a href="{{ request()->url() }}?language=az" class="{{ (App::getLocale()  == 'az') ? 'active' : ''}} ">
                                <div class="lang {{ (App::getLocale()  == 'az') ? 'selected' : ''}}" data-value="az"><i class="flag-icon flag-icon-az"></i> <span class="lang-txt">Azerbaijan</span></div>
                            </a>
                            <a href="{{ request()->url() }}?language=tr" class="{{ (App::getLocale()  == 'tr') ? 'active' : ''}}">
                                <div class="lang {{ (App::getLocale()  == 'tr') ? 'selected' : ''}}" data-value="tr"><i class="flag-icon flag-icon-tr"></i> <span class="lang-txt">Turkish</span></div>
                            </a>
                            <a href="{{ request()->url() }}?language=ru" class="{{ (App::getLocale()  == 'ru') ? 'active' : ''}}">
                                <div class="lang {{ (App::getLocale()  == 'ru') ? 'selected' : ''}}" data-value="ru"><i class="flag-icon flag-icon-ru"></i> <span class="lang-txt">Russian</span></div>
                            </a>

                        </div>
                    </div>
                </li>
                @if(Auth::user()->role_id ==1 or Auth::user()->role_id ==3)
                <li class="onhover-dropdown">
                    <div class="notification-box"><a href="/panel/orders"> <i data-feather="bell">
                       </i></a><span class="badge rounded-pill badge-secondary">
                            {{$notif}}
                        </span>
                    </div>

                </li>
                @endif
                <!--<li>-->
                <!--    <div class="mode"><i class="fa fa-moon-o"></i></div>-->
                <!--</li>-->
{{--              @if(Auth::user()->role_id===1 or Auth::user()->role_id===2 or Auth::user()->role_id===3)--}}

{{--                <li class="cart-nav onhover-dropdown">--}}
{{--                    <div class="cart-box"><a  href="{{route('manager.doctor.checkout')}}"><i data-feather="shopping-cart"></i></a><span class="total-count badge rounded-pill badge-primary"></span></div>--}}
{{--                </li>--}}
{{--                    <li class="cart-nav onhover-dropdown">--}}
{{--                        <div class="cart-box"><a  href="{{route('manager.manager.checkout')}}"><i data-feather="briefcase"></i></a><span class="total-count badge rounded-pill badge-primary"></span></div>--}}
{{--                    </li>--}}
{{--                @endif--}}

                    <li class="cart-nav onhover-dropdown">
                        <div class="cart-box"> <a class="btn btn-success "   style="font-size: 12px;"  href="{{route('manager.doctor.checkout')}}">{{ trans('lang.Sale and Deposite') }}</a><span class="total-count badge rounded-pill badge-primary"></span></div>
                    </li>

                    <li class="cart-nav onhover-dropdown">
                        {{--                        <div class="cart-box"><a  href="{{route('manager.checkout')}}"><i data-feather="briefcase"></i></a><span class="total-count badge rounded-pill badge-primary"></span></div>--}}
                        <div class="cart-box"> <a class="btn btn-primary " style="font-size: 12px"   href="{{route('manager.manager.checkout')}}">{{ trans('lang.Require the product') }}</a><span class="total-count badge rounded-pill badge-primary"></span></div>

                    </li>



                <li class="maximize"><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i data-feather="maximize"></i></a></li>
                <li class="onhover-dropdown p-0 me-0">
                    <div class="media profile-media">
                        <img class="b-r-10" src="/assets/images/avtar/{{Auth::user()->image}}" alt="">
                        <div class="media-body">

                            @if (Auth::check())

                                <span>{{Auth::user()->first_name}} {{Auth::user()->last_name}}</span>
                                <p class="mb-0 font-roboto">{{\App\Models\Roles::where('id', Auth::user()->role_id)->first()->name}} <i class="middle fa fa-angle-down"></i></p>

                            @endif
                        </div>
                    </div>
                    <ul class="profile-dropdown onhover-show-div">
                        <li><a href="{{route('account')}}"><i data-feather="user"></i><span>{{ trans('lang.Account') }} </span></a></li>
                        <li><a href="{{route('password-reset')}}"><i data-feather="shield"></i><span>{{ trans('lang.Password') }}</span></a></li>
{{--                        <li><a href="#"><i data-feather="file-text"></i><span>Taskboard</span></a></li>--}}
{{--                        <li><a href="#"><i data-feather="settings"></i><span>Settings</span></a></li>--}}
{{--                        <li><a href="#"><i data-feather="log-in"> </i><span>Log in</span></a></li>--}}
                        <li><a href="{{ route('logout') }}"><i data-feather="log-in"> </i><span>{{ trans('lang.Sign-out') }}</span></a></li>

                    </ul>
                </li>
            </ul>
        </div>
        <script class="result-template" type="text/x-handlebars-template">
            <div class="ProfileCard u-cf">
                <div class="ProfileCard-avatar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay m-0"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg></div>
                <div class="ProfileCard-details">
                    <div class="ProfileCard-realName">@{{name}}</div>
                </div>
            </div>
        </script>
        <script class="empty-template" type="text/x-handlebars-template"><div class="EmptyMessage">Your search turned up 0 results. This most likely means the backend is down, yikes!</div></script>
    </div>
</div>
