@extends('frontend.layout')

@section('content')

    <!-- breadcrumb-area -->
    <div class="container">
        <div class="row">
        <div class="zoa-cart">
            <ul class="account-tab">
                <li class="active"><a data-toggle="tab" href="#cart" aria-expanded="false">{{ trans('lang.Shopping Cart') }}</a></li>
            </ul>
            <div class="tab-content">
                <div id="cart" class="tab-pane fade in active">
                    <div class="shopping-cart">
                        <div class="table-responsive">
                            <table class="table cart-table">
                                <thead >
                                <tr>
                                    <th style="padding: 30px 90px 30px 0; width:256px;" class="product-thumbnail">{{ trans('lang.Image') }}</th>
                                    <th style="padding: 30px 90px 30px 0;" class="product-name">{{ trans('lang.Name') }}</th>
                                    <th style="padding: 30px 90px 30px 0;" class="product-name">{{ trans('lang.Price') }}</th>
                                    <th style="padding: 30px 90px 30px 0;" class="product-name">{{ trans('lang.Count') }}</th>
                                    <th style="padding: 30px 90px 30px 0;" class="product-price">{{ trans('lang.Total Price') }}</th>
                                    <th style="padding: 30px 90px 30px 0;" class="product-quantity">{{ trans('lang.Minus') }}</th>
                                    <th style="padding: 30px 90px 30px 0;" class="product-subtotal">{{ trans('lang.Plus') }}</th>
                                </tr>
                                </thead>
                                <tbody class="show-cart">

                                </tbody>
                            </table>
                        </div>
                        <div class="table-cart-bottom">
                            <div class="row">
{{--                                <div class="col-md-7 col-sm-6 col-xs-12">--}}
{{--                                    <div class="cart-btn-group">--}}
{{--                                        <a href="" class="btn-continue">Continue shopping</a>--}}
{{--                                        <a href="" class="btn-clear">clear cart</a>--}}
{{--                                    </div>--}}
{{--                                    <div class="coupon-group">--}}
{{--                                        <form class="form_coupon" action="#" method="post">--}}
{{--                                            <input type="email" value="" placeholder="COUPON CODE" name="EMAIL" id="mail" class="newsletter-input form-control">--}}
{{--                                            <label for="location"></label><textarea name="location" required id="location" placeholder="Your location" class="form-control btn-square" ></textarea>--}}

{{--                                            <div class="input-icon">--}}
{{--                                                <img src="img/coupon.png" alt="">--}}
{{--                                            </div>--}}
{{--                                        </form>--}}
{{--                                        <a href="#" class="btn-update">Update cart</a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                @if (!Auth::guest())
                                    <div class="col-md-5 col-sm-6 col-xs-12">
                                        <form>
                                            @if (\Illuminate\Support\Facades\Auth::user()->role_id == 5)
                                                <label for="location"></label><textarea name="location" required id="location" placeholder="{{ trans('lang.Note') }}" class="form-control btn-square" ></textarea>
                                            @else
                                                <label for="location"></label><textarea name="location" required id="location" placeholder="{{ trans('lang.Note') }}" class="form-control btn-square" ></textarea>

                                            @endif

                                                <label for="doctorid">{{ trans('lang.Doctor') }}</label>

                                                <select required name="order_type" id="order_type" class="form-control" title="Select customer...">
                                                    <option value="1">{{ trans('lang.Purchase in cash') }}</option>
                                                    <option value="2">{{ trans('lang.Deposit') }}</option>

                                                </select>



                                            <input class="form-control" type="hidden"  name="user" id="user" value="{{Auth::user()->id}}" >
                                            <input class="form-control" type="hidden"  name="doctorid" id="doctorid" value="{{Auth::user()->id}}" >



                                            <input class="form-control" type="hidden"  name="role" id="role" value="5" >
                                            <input class="form-control" type="hidden"  name="pdf" id="pdf" value="{{time()}}" >
                                            <div class="cart-text">
                                                {{--                                        <div class="cart-element">--}}
                                                {{--                                            <p>Total products:</p>--}}
                                                {{--                                            <p>$118.00</p>--}}
                                                {{--                                        </div>--}}
                                                {{--                                        <div class="cart-element">--}}
                                                {{--                                            <p>Estimated shipping costs:</p>--}}
                                                {{--                                            <p>$0.00</p>--}}
                                                {{--                                        </div>--}}
                                                <div class="cart-element text-bold">
                                                    <p>{{ trans('lang.Total') }}:</p>
                                                    <p class="total-cart"></p>AZN
                                                </div>
                                            </div>



                                                <a href="#" class="zoa-btn zoa-checkout checkout_post">{{ trans('lang.Checkout') }}</a>
                                        </form>
                                    </div>
                                @else
                                    <a href="/login" class="zoa-btn zoa-checkout ">{{ trans('lang.Checkout') }}</a>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
    <!-- cart-area-end -->


@endsection
