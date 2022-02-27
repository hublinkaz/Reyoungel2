<header id="header" class="header-v3 header-top-absolute">
    <div class="header-center">
        <div class="container container-content">
            <div class="row flex align-items-center justify-content-between">

                <div class="col-md-2 col-xs-6 col-sm-6 col2 flex align-items-center">
                    <div class="zoa-logo"><a href="/"><img src="/public/frontend/img/logo_trans.png" alt="" class="img-reponsive"></a></div>

                </div>

                    <div class="col-md-8 col-xs-6 col-sm-6 col2 flex align-items-center">
                        <ul class="nav navbar-nav js-menubar hidden-xs hidden-sm">
                            <li class="level1 active dropdown"><a href="/" title="Home">{{ trans('lang.Home') }}</a>
                            </li>
                            <li class="level1 dropdown hassub"><a href="/#products" title="Shop">{{ trans('lang.Products') }}</a>

                            </li>

                            <li class="level1 dropdown hassub"><a href="/doctors" title="Shop">{{ trans('lang.Doctors') }}</a>
                            <li class="level1 dropdown hassub"><a href="/about" title="Shop">{{ trans('lang.About') }}</a>
                            <li class="level1 dropdown hassub"><a href="/contact" title="Shop">{{ trans('lang.Contact') }}</a>
                            <li class="level1 dropdown hassub"><a href="/blogs" title="Shop">{{ trans('lang.Blog') }}</a>

                            </li>

                            {{--                        <li class="level1 active dropdown">--}}
                            {{--                            <a href="#" title="Blog">Blog</a>--}}
                            {{--                            <ul class="dropdown-menu menu-level-1">--}}
                            {{--                                <li><a class="sm_title" href="#" title="Blogs">Blogs</a></li>--}}
                            {{--                                <li class="level2"><a href="06-Blog.html" title="Blog List">Blog List</a></li>--}}
                            {{--                                <li class="level2"><a href="07-Blog_single.html" title="Blog Single">Blog Single</a></li>--}}
                            {{--                            </ul>--}}
                            {{--                        </li>--}}
                        </ul>
                    </div>

                <div class="col-md-2 col-xs-6 col-sm-6 col2 flex justify-content-end">

                    <div class="topbar-left">
                        <div class="element element-search hidden-xs hidden-sm">
                            <div class="dropdown mt-5">

                                <a type="button" class="" data-toggle="dropdown">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-globe" viewBox="0 0 16 16">
                                        <path d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm7.5-6.923c-.67.204-1.335.82-1.887 1.855A7.97 7.97 0 0 0 5.145 4H7.5V1.077zM4.09 4a9.267 9.267 0 0 1 .64-1.539 6.7 6.7 0 0 1 .597-.933A7.025 7.025 0 0 0 2.255 4H4.09zm-.582 3.5c.03-.877.138-1.718.312-2.5H1.674a6.958 6.958 0 0 0-.656 2.5h2.49zM4.847 5a12.5 12.5 0 0 0-.338 2.5H7.5V5H4.847zM8.5 5v2.5h2.99a12.495 12.495 0 0 0-.337-2.5H8.5zM4.51 8.5a12.5 12.5 0 0 0 .337 2.5H7.5V8.5H4.51zm3.99 0V11h2.653c.187-.765.306-1.608.338-2.5H8.5zM5.145 12c.138.386.295.744.468 1.068.552 1.035 1.218 1.65 1.887 1.855V12H5.145zm.182 2.472a6.696 6.696 0 0 1-.597-.933A9.268 9.268 0 0 1 4.09 12H2.255a7.024 7.024 0 0 0 3.072 2.472zM3.82 11a13.652 13.652 0 0 1-.312-2.5h-2.49c.062.89.291 1.733.656 2.5H3.82zm6.853 3.472A7.024 7.024 0 0 0 13.745 12H11.91a9.27 9.27 0 0 1-.64 1.539 6.688 6.688 0 0 1-.597.933zM8.5 12v2.923c.67-.204 1.335-.82 1.887-1.855.173-.324.33-.682.468-1.068H8.5zm3.68-1h2.146c.365-.767.594-1.61.656-2.5h-2.49a13.65 13.65 0 0 1-.312 2.5zm2.802-3.5a6.959 6.959 0 0 0-.656-2.5H12.18c.174.782.282 1.623.312 2.5h2.49zM11.27 2.461c.247.464.462.98.64 1.539h1.835a7.024 7.024 0 0 0-3.072-2.472c.218.284.418.598.597.933zM10.855 4a7.966 7.966 0 0 0-.468-1.068C9.835 1.897 9.17 1.282 8.5 1.077V4h2.355z"/>
                                    </svg>
                                </a>
                                <div class="dropdown-menu">
                                    @foreach (config('app.available_locales') as $locale)
                                        <a href="{{ request()->url() }}?language={{ $locale }}"
                                           class="dropdown-item {{ (App::getLocale()  == $locale) ? 'active' : ''}}">
                                            <div class="lang {{ (App::getLocale()  == $locale) ? 'selected' : ''}}" data-value="en"><i class="flag-icon flag-icon-us"></i> <span class="lang-txt">
                                                    @if ($locale=='az')
                                                        Azerbaijan
                                                    @elseif ($locale=='en')
                                                        English
                                                    @elseif ($locale=='ru')
                                                        Russian
                                                    @elseif ($locale=='tr')
                                                        Turkish
                                                    @else
                                                        {{ strtoupper($locale) }}
                                                    @endif





                                            </span></div>
                                        </a>
                                    @endforeach

                                </div>
                            </div>

                        </div>

                        <div class="element element-user hidden-xs hidden-sm">
                            @if(\Illuminate\Support\Facades\Auth::guest())
                            <a href="/doctor-panel" class="">
                                <svg width="19" height="20" version="1.1" id="Layer_3" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 102.8" style="enable-background:new 0 0 100 102.8;" xml:space="preserve">
                                            <g>
                                                <path d="M75.7,52.4c-2.1,2.3-4.4,4.3-7,6C82.2,58.8,93,69.9,93,83.5v12.3H7V83.5c0-13.6,10.8-24.7,24.3-25.1c-2.6-1.7-5-3.7-7-6
        C10.3,55.9,0,68.5,0,83.5v15.8c0,1.9,1.6,3.5,3.5,3.5h93c1.9,0,3.5-1.6,3.5-3.5V83.5C100,68.5,89.7,55.9,75.7,52.4z" />
                                                <g>
                                                    <path d="M50,58.9c-16.2,0-29.5-13.2-29.5-29.5S33.8,0,50,0s29.5,13.2,29.5,29.5S66.2,58.9,50,58.9z M50,7
            C37.6,7,27.5,17.1,27.5,29.5S37.6,51.9,50,51.9s22.5-10.1,22.5-22.5S62.4,7,50,7z" />
                                                </g>
                                            </g>
                                        </svg>
                            </a>
                            @else
                                @if(\Illuminate\Support\Facades\Auth::user()->role_id==1)
                                    <a href="/admin-panel" class="">
                                        <svg width="19" height="20" version="1.1" id="Layer_3" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 102.8" style="enable-background:new 0 0 100 102.8;" xml:space="preserve">
                                            <g>
                                                <path d="M75.7,52.4c-2.1,2.3-4.4,4.3-7,6C82.2,58.8,93,69.9,93,83.5v12.3H7V83.5c0-13.6,10.8-24.7,24.3-25.1c-2.6-1.7-5-3.7-7-6
        C10.3,55.9,0,68.5,0,83.5v15.8c0,1.9,1.6,3.5,3.5,3.5h93c1.9,0,3.5-1.6,3.5-3.5V83.5C100,68.5,89.7,55.9,75.7,52.4z" />
                                                <g>
                                                    <path d="M50,58.9c-16.2,0-29.5-13.2-29.5-29.5S33.8,0,50,0s29.5,13.2,29.5,29.5S66.2,58.9,50,58.9z M50,7
            C37.6,7,27.5,17.1,27.5,29.5S37.6,51.9,50,51.9s22.5-10.1,22.5-22.5S62.4,7,50,7z" />
                                                </g>
                                            </g>
                                        </svg>
                                    </a>

                                @elseif (\Illuminate\Support\Facades\Auth::user()->role_id==2)
                                    <a href="/manager-panel" class="">
                                        <svg width="19" height="20" version="1.1" id="Layer_3" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 102.8" style="enable-background:new 0 0 100 102.8;" xml:space="preserve">
                                            <g>
                                                <path d="M75.7,52.4c-2.1,2.3-4.4,4.3-7,6C82.2,58.8,93,69.9,93,83.5v12.3H7V83.5c0-13.6,10.8-24.7,24.3-25.1c-2.6-1.7-5-3.7-7-6
        C10.3,55.9,0,68.5,0,83.5v15.8c0,1.9,1.6,3.5,3.5,3.5h93c1.9,0,3.5-1.6,3.5-3.5V83.5C100,68.5,89.7,55.9,75.7,52.4z" />
                                                <g>
                                                    <path d="M50,58.9c-16.2,0-29.5-13.2-29.5-29.5S33.8,0,50,0s29.5,13.2,29.5,29.5S66.2,58.9,50,58.9z M50,7
            C37.6,7,27.5,17.1,27.5,29.5S37.6,51.9,50,51.9s22.5-10.1,22.5-22.5S62.4,7,50,7z" />
                                                </g>
                                            </g>
                                        </svg>
                                    </a>

                                @elseif (\Illuminate\Support\Facades\Auth::user()->role_id==3)
                                    <a href="/staff-panel" class="">
                                        <svg width="19" height="20" version="1.1" id="Layer_3" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 102.8" style="enable-background:new 0 0 100 102.8;" xml:space="preserve">
                                            <g>
                                                <path d="M75.7,52.4c-2.1,2.3-4.4,4.3-7,6C82.2,58.8,93,69.9,93,83.5v12.3H7V83.5c0-13.6,10.8-24.7,24.3-25.1c-2.6-1.7-5-3.7-7-6
        C10.3,55.9,0,68.5,0,83.5v15.8c0,1.9,1.6,3.5,3.5,3.5h93c1.9,0,3.5-1.6,3.5-3.5V83.5C100,68.5,89.7,55.9,75.7,52.4z" />
                                                <g>
                                                    <path d="M50,58.9c-16.2,0-29.5-13.2-29.5-29.5S33.8,0,50,0s29.5,13.2,29.5,29.5S66.2,58.9,50,58.9z M50,7
            C37.6,7,27.5,17.1,27.5,29.5S37.6,51.9,50,51.9s22.5-10.1,22.5-22.5S62.4,7,50,7z" />
                                                </g>
                                            </g>
                                        </svg>
                                    </a>

                                @elseif (\Illuminate\Support\Facades\Auth::user()->role_id==5)
                                    <a href="/doctor-panel" class="">
                                        <svg width="19" height="20" version="1.1" id="Layer_3" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 102.8" style="enable-background:new 0 0 100 102.8;" xml:space="preserve">
                                            <g>
                                                <path d="M75.7,52.4c-2.1,2.3-4.4,4.3-7,6C82.2,58.8,93,69.9,93,83.5v12.3H7V83.5c0-13.6,10.8-24.7,24.3-25.1c-2.6-1.7-5-3.7-7-6
        C10.3,55.9,0,68.5,0,83.5v15.8c0,1.9,1.6,3.5,3.5,3.5h93c1.9,0,3.5-1.6,3.5-3.5V83.5C100,68.5,89.7,55.9,75.7,52.4z" />
                                                <g>
                                                    <path d="M50,58.9c-16.2,0-29.5-13.2-29.5-29.5S33.8,0,50,0s29.5,13.2,29.5,29.5S66.2,58.9,50,58.9z M50,7
            C37.6,7,27.5,17.1,27.5,29.5S37.6,51.9,50,51.9s22.5-10.1,22.5-22.5S62.4,7,50,7z" />
                                                </g>
                                            </g>
                                        </svg>
                                    </a>

                                @endif

                            @endif
                        </div>
                        <div class="element element-cart">
                            <a href="/cart" >
                                <svg width="20" height="20" version="1.1" id="Layer_4" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 55.4 55.4" style="enable-background:new 0 0 55.4 55.4;" xml:space="preserve">
                                            <g>
                                                <rect x="0.2" y="17.4" width="55" height="3.4" />
                                            </g>
                                    <g>
                                        <polygon points="7.1,55.4 3.4,27.8 3.4,24.1 7.3,24.1 7.3,27.6 10.5,51.6 44.9,51.6 48.1,27.6 48.1,24.1 52,24.1 52,27.9
        48.3,55.4   " />
                                    </g>
                                    <g>
                                        <path d="M14,31.4c-0.1,0-0.3,0-0.5-0.1c-1-0.2-1.6-1.3-1.4-2.3L19,1.5C19.2,0.6,20,0,20.9,0c0.1,0,0.3,0,0.4,0
        c0.5,0.1,0.9,0.4,1.2,0.9c0.3,0.4,0.4,1,0.3,1.5l-6.9,27.5C15.6,30.8,14.8,31.4,14,31.4z" />
                                    </g>
                                    <g>
                                        <path d="M41.5,31.4c-0.9,0-1.7-0.6-1.9-1.5L32.7,2.4c-0.1-0.5,0-1.1,0.3-1.5s0.7-0.7,1.2-0.8c0.1,0,0.3,0,0.4,0
        c0.9,0,1.7,0.6,1.9,1.5L43.4,29c0.1,0.5,0,1-0.2,1.5c-0.3,0.5-0.7,0.8-1.1,0.9c-0.2,0-0.3,0-0.4,0.1C41.6,31.4,41.6,31.4,41.5,31.4
        z" />
                                    </g>
                                        </svg>
                                <span class="total-count count cart-count">0</span>
                            </a>
                        </div>
                    </div>
                </div>
                                                               <div class="topbar-right hidden-md hidden-lg">
                            <div class="element">
                                <a href="#" class="icon-pushmenu js-push-menu">
                                    <svg width="26" height="16" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 66 41" style="enable-background:new 0 0 66 41;" xml:space="preserve">
                                        <style type="text/css">
                                        .st0 {
                                            fill: none;
                                            stroke: #000000;
                                            stroke-width: 3;
                                            stroke-linecap: round;
                                            stroke-miterlimit: 10;
                                        }
                                        </style>
                                        <g>
                                            <line class="st0" x1="1.5" y1="1.5" x2="64.5" y2="1.5" />
                                            <line class="st0" x1="1.5" y1="20.5" x2="64.5" y2="20.5" />
                                            <line class="st0" x1="1.5" y1="39.5" x2="64.5" y2="39.5" />
                                        </g>
                                    </svg>
                                </a>
                            </div>
                        </div>

            </div>
        </div>
    </div>
</header>
