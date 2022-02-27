<!doctype html>
<html class="no-js" lang="">
<head>
    @include('frontend.includes.head')
    <!--Start of Tawk.to Script-->

        <script type="text/javascript">

            var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();

            (function(){

                var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];

                s1.async=true;

                s1.src='https://embed.tawk.to/619cd5cf6885f60a50bd222b/1fl6a6cua';

                s1.charset='UTF-8';

                s1.setAttribute('crossorigin','*');

                s0.parentNode.insertBefore(s1,s0);

            })();

        </script>

        <!--End of Tawk.to Script-->
</head>


<body>
<!-- push menu-->
<div class="pushmenu menu-home5">
    <div class="menu-push">
        <span class="close-left js-close"><i class="ion-ios-close-empty f-40"></i></span>
        <div class="clearfix">
            <img src="public/frontend/img/logo_trans.png" alt="" class="img-reponsive">
            <img style="width: 40%" src="public/frontend/img/bioha.png" alt="" class="img-reponsive">
        </div>
        <ul class="mobile-account">
            @if(\Illuminate\Support\Facades\Auth::guest())
                <li><a href="/login"><i class="fa fa-unlock-alt"></i>{{ trans('lang.Sign in') }}</a></li>
                <li><a href="/login"><i class="fa fa-user-plus"></i>{{ trans('lang.Create Account') }}</a></li>
            @else
                @if(\Illuminate\Support\Facades\Auth::user()->role_id==1)
                    <li><a href="/admin-panel"><i class="fa fa-unlock-alt"></i>Portal</a></li>

            @elseif (\Illuminate\Support\Facades\Auth::user()->role_id==2)
                    <li><a href="/manager-panel"><i class="fa fa-unlock-alt"></i>Portal</a></li>

            @elseif (\Illuminate\Support\Facades\Auth::user()->role_id==3)
                    <li><a href="/staff-panel"><i class="fa fa-unlock-alt"></i>Portal</a></li>

            @elseif (\Illuminate\Support\Facades\Auth::user()->role_id==5)
                    <li><a href="/doctor-panel"><i class="fa fa-unlock-alt"></i>Portal</a></li>

            @endif

        @endif
                <li class="level1 active dropdown"><a href="/" title="Home">{{ trans('lang.Home') }}</a></li>
                <li class="level1 dropdown hassub"><a href="/#products" title="Shop">{{ trans('lang.Products') }}</a></li>
                <li class="level1 dropdown hassub"><a href="/doctors" title="Shop">{{ trans('lang.Doctors') }}</a></li>
                <li class="level1 dropdown hassub"><a href="/about" title="Shop">{{ trans('lang.About') }}</a></li>
                <li class="level1 dropdown hassub"><a href="/contact" title="Shop">{{ trans('lang.Contact') }}</a></li>
                <li class="level1 dropdown hassub"><a href="/blogs" title="Shop">{{ trans('lang.Blog') }}</a></li>

        </ul>



        <h4 class="mb-title"> {{ trans('lang.connect and follow') }} </h4>
        <div class="mobile-social mg-bottom-30">
            <a href="https://www.facebook.com/Reyoungel-Azerbaijan-102633278214319"><i class="fa fa-facebook"></i></a>
            <a href="instagram.com/reyoungel_azerbaijan/"><i class="fa fa-instagram"></i></a>
            <a href="#"><i class="fa fa-whatsapp"></i></a>
        </div>
    </div>
</div>
<!-- end push menu-->
<!-- Push cart -->

<!-- End pushcart -->
<!-- Search form -->
<div class="search-form-wrapper header-search-form">
    <div class="container">
        <div class="search-results-wrapper">
            <div class="btn-search-close">
                <i class="ion-ios-close-empty"></i>
            </div>
        </div>
        <ul class="zoa-category text-center">

        </ul>
        <form method="get" action="/search" role="search" class="search-form  has-categories-select">
            <input name="q" class="search-input" type="text" value="" placeholder="{{ trans('lang.Enter your keywords...') }}" autocomplete="off">
            <input type="hidden" name="post_type" value="product">
            <button type="submit" id="search-btn"><i class="ion-ios-search-strong"></i></button>
        </form>
    </div>
</div>
<!-- End search form -->
<!-- Account -->
<div class="account-form-wrapper">
    <div class="container">
        <div class="search-results-wrapper">
            <div class="btn-search-close">
                <i class="ion-ios-close-empty black"></i>
            </div>
        </div>
        <div class="account-wrapper">
            <ul class="account-tab text-center">
                <li class="active"><a data-toggle="tab" href="/login">{{ trans('lang.login') }}</a></li>
                <li><a data-toggle="tab" href="/register">{{ trans('lang.Register') }}</a></li>
            </ul>
            <div class="tab-content">
                <div id="login" class="tab-pane fade in active">
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <form method="post" class="form-customer form-register">
                                <div class="form-group">
                                    <label for="exampleInputEmail2">{{ trans('lang.E-mail') }}</label>
                                    <input type="email" class="form-control form-account" id="exampleInputEmail2">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword3">{{ trans('lang.Password') }}</label>
                                    <input type="password" class="form-control form-account" id="exampleInputPassword3">
                                </div>
                                <div class="flex justify-content-between mg-30">
                                    <div class="checkbox">
                                        <input data-val="true" data-val-required="The Remember me? field is required." id="RememberMe" name="RememberMe" type="checkbox" value="true" />
                                        <input name="RememberMe" type="hidden" value="false" />
                                        <label for="RememberMe">{{ trans('lang.Remember me') }}</label>
                                    </div>
                                    <a href="" class="text-note no-mg">{{ trans('lang.Forgot Password?') }}</a>
                                </div>
                                <div class="btn-button-group mg-top-30 mg-bottom-15">
                                    <button type="submit" class="zoa-btn btn-login hover-white">{{ trans('lang.Sign In') }}</button>
                                </div>
                            </form>
                            <div class="social-group-button">
                              <a href="" class="facebook button">
                                    <div class="slide">
                                        <p>
                                            {{ trans('lang.Connect with Facebook') }}
                                        </p>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-facebook">
                                        </i>
                                    </div>
                                </a>
                            </div>
                            <span class="text-note">{{ trans('lang.Don’t have an account? ') }}<a href="">{{ trans('lang.Register!') }}</a></span>
                        </div>
                        <div class="col-md-4"></div>

                    </div>
                </div>
                <div id="register" class="tab-pane fade">
                    <div class="row">
                        <div class="col-md-4">
                            <form method="post" class="form-customer form-login">
                                <div class="form-group">
                                    <label for="exampleInputEmail7">{{ trans('lang.E-mail') }} *</label>
                                    <input type="email" class="form-control form-account" id="exampleInputEmail7">
                                </div>
                                <div class="form-group">
                                    <label for="zoaname2">{{ trans('lang.Name!') }}</label>
                                    <input type="text" class="form-control form-account" id="zoaname2">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword2">{{ trans('lang.Password!') }} *</label>
                                    <input type="password" class="form-control form-account" id="exampleInputPassword2">
                                </div>
                                <div class="btn-button-group mg-top-30 mg-bottom-15">
                                    <button type="submit" class="zoa-btn btn-login hover-white">{{ trans('lang.Sign Up') }}</button>
                                </div>
                            </form>
                            <div class="social-group-button">

                                <a href="" class="facebook button">
                                    <div class="slide">
                                        <p>
                                            {{ trans('lang.Connect with Facebook') }}
                                        </p>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-facebook">
                                        </i>
                                    </div>
                                </a>
                            </div>
                            <span class="text-note">{{ trans('lang.Already have an account?') }} <a href="">{{ trans('lang.Sign In!') }}</a></span>
                        </div>
                        <div class="col-md-4">
                            <form method="post" class="form-customer form-register">
                                <div class="form-group">
                                    <label for="exampleInputEmail6">{{ trans('lang.E-mail') }}</label>
                                    <input type="email" class="form-control form-account" id="exampleInputEmail6">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword4">{{ trans('lang.Password') }}</label>
                                    <input type="password" class="form-control form-account" id="exampleInputPassword4">
                                </div>
                                <div class="flex justify-content-between mg-30">
                                    <div class="checkbox">
                                        <input data-val="true" data-val-required="The Remember me? field is required." id="RememberMe2" name="RememberMe" type="checkbox" value="true" />
                                        <input name="RememberMe" type="hidden" value="false" />
                                        <label for="RememberMe2">{{ trans('lang.Remember me') }}</label>
                                    </div>
                                    <a href="" class="text-note no-mg">{{ trans('lang.Forgot Password') }}?</a>
                                </div>
                                <div class="btn-button-group mg-top-30 mg-bottom-15">
                                    <button type="submit" class="zoa-btn btn-login hover-white">{{ trans('lang.Sign In') }}</button>
                                </div>
                            </form>
                            <div class="social-group-button">
                                <a href="" class="facebook button">
                                    <div class="slide">
                                        <p>
                                            {{ trans('lang.Connect with Facebook') }}
                                        </p>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-facebook">
                                        </i>
                                    </div>
                                </a>
                            </div>
                            <span class="text-note">{{ trans('lang.Don’t have an account?') }} <a href="">{{ trans('lang.Register!') }}</a></span>
                        </div>
                        <div class="col-md-4">
                            <form method="post" class="form-customer form-reset">
                                <div class="form-group">
                                    <label for="exampleInputEmail4">{{ trans('lang.E-mail') }} *</label>
                                    <input type="email" class="form-control form-account" id="exampleInputEmail4">
                                </div>
                                <div class="btn-button-group mg-top-30 mg-bottom-15">
                                    <button type="submit" class="zoa-btn btn-login hover-white">{{ trans('lang.Reset Password') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Account -->
</div>
<div class="wrappage">

    <!-- start header -->
@include('frontend.includes.header')
<!-- end header -->

    <!-- Content Section -->
    <div class="contents">
        @yield('content')
    </div>
    <!-- end of Content Section -->
</div>
    <!-- start footer -->
@include('frontend.includes.footer')
<!-- end footer -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script type="text/javascript" src="{{ asset('public/frontend/js/jquery.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/frontend/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/frontend/js/owl.carousel.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/frontend/js/slick.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/frontend/js/countdown.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/frontend/js/main.js') }}"></script>
<script src="{{asset('assets/js/cart.js')}}"></script>


</body>
</html>
