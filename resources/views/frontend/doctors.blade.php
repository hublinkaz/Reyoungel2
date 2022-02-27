@extends('frontend.layout')

@section('content')

<br>
<br>
<br>
    <div class="container container-content">
        <div class="filter-collection-left hidden-lg hidden-md">

        </div>
        <div class="shop-top">
            <div class="shop-element left">

            </div>
            <div class="shop-element right">

                <div class="view-mode view-group">

                </div>
            </div>
        </div>
        <div class="product-collection-grid product-grid bd-bottom">
            <div class="row engoc-row-equal">
                @foreach($doctors as $doctor)
                <div class="col-xs-6 col-sm-4 col-md-2 col-lg-2 product-item">
                    <div class="product-img">

                        <a href="/doctor/{{$doctor->id}}"><img style="object-fit: cover" src="public/assets/images/doctors/{{json_decode($doctor->images)[0]}}" alt="" class="img-responsive"></a>
                    </div>
                    <div class="product-info text-center">
                        <h3 class="product-title">
                            <a href="">{{$doctor->name}}</a>
                        </h3>

                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </div>


@endsection
