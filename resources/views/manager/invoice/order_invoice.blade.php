<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ $company['name'] }}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <style type="text/css" media="screen">
        html {
            font-family: sans-serif;
            line-height: 1.15;
            margin: 0;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            text-align: left;
            background-color: #fff;
            font-size: 10px;
            margin: 1pt;
        }

        h4 {
            margin-top: 0;
            margin-bottom: 0.5rem;
        }

        p {
            margin-top: 0;
            margin-bottom: 1rem;
        }

        strong {
            font-weight: bolder;
        }

        img {
            vertical-align: middle;
            border-style: none;
            width: 20%;
        }

        table {
            border-collapse: collapse;
        }

        th {
            text-align: inherit;
        }

        h4, .h4 {
            margin-bottom: 0.5rem;
            font-weight: 500;
            line-height: 1.2;
        }

        h4, .h4 {
            font-size: 1.5rem;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
        }

        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
        }

        .table tbody + tbody {
            border-top: 2px solid #dee2e6;
        }

        .mt-5 {
            margin-top: 3rem !important;
        }

        .pr-0,
        .px-0 {
            padding-right: 0 !important;
        }

        .pl-0,
        .px-0 {
            padding-left: 0 !important;
        }

        .text-right {
            text-align: right !important;
        }

        .text-center {
            text-align: center !important;
        }

        .text-uppercase {
            text-transform: uppercase !important;
        }
        * {
            font-family: "DejaVu Sans";
        }
        body, h1, h2, h3, h4, h5, h6, table, th, tr, td, p, div {
            line-height: 1.1;
        }
        .party-header {
            font-size: 1.5rem;
            font-weight: 400;
        }
        .total-amount {
            font-size: 12px;
            font-weight: 700;
        }
        .border-0 {
            border: none !important;
        }
    </style>
</head>

<body>
{{-- Header --}}

<table class="table">
    <tbody>
    <tr>
        <td class="border-0 pl-0" width="70%">

                <img src="{{asset('assets/images/logo/logo.png')}}" alt="logo">

            <h5 class="text">
                {{$company['email']}} <br>{{$company['phone']}}
            </h5>

        </td>
        <td class="border-0 pl-0">
            <p>Serial <strong>{{$data['serila']}}</strong></p>
            <p>Tarix: <strong>{{ now() }}</strong></p>
            <p>*Bu qaimədə ödəniş alınmadı və <br>  2 nüsxə olaraq imzalarla təsdiq edildi.		</p>
        </td>
    </tr>
    </tbody>
</table>

{{-- Seller - Buyer --}}
<table class="table">
    <thead>
    <tr>
        <th class="border-0 pl-0 party-header" width="48.5%">
            Müştəri
        </th>
        <th class="border-0" width="3%"></th>
        <th class="border-0 pl-0 party-header">
        </th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td class="px-0">
                <p class="seller-name">
                    <strong>{{ $manager['name'] }}</strong>
                </p>



                <p class="seller-code">
                    Tell: {{ $manager['phone'] }}
                </p>



        </td>
        <td class="border-0"></td>
        <td class="px-0">
                <p class="buyer-name">
                    <strong></strong>
                </p>

                <p class="buyer-address">


                </p>

                <p class="buyer-phone">

                </p>


{{--                <p class="buyer-custom-field">--}}
{{--                    {{ ucfirst($key) }}: {{ $value }}--}}
{{--                </p>--}}

        </td>
    </tr>
    </tbody>
</table>

{{-- Table --}}
<table class="table">
    <thead>
    <tr>
        <th scope="col" class="border-0 pl-0">{{ trans('lang.N') }}</th>
        <th scope="col" class="border-0 pl-0">{{ trans('lang.Name') }}</th>

        <th scope="col" class="text-center border-0">{{ trans('lang.Units') }}</th>


        <th scope="col" class="text-right border-0">{{ trans('lang.Price') }}</th>

        <th scope="col" class="text-right border-0">{{ trans('lang.Qty') }}</th>

        <th scope="col" class="text-right border-0 pr-0">{{ trans('lang.Sub Total') }}</th>
    </tr>
    </thead>
    <tbody>
    {{-- Items --}}
    {{$i=1}}
    {{$count=0}}
    @foreach($items as $item)

        <tr>
            <td class="pl-0">{{ $i }}</td>
            <td class="pl-0">{{ $item->{'name_'.app()->getLocale()} }}</td>

{{--                <td class="text-center">{{ $item['name'] }}</td>--}}
                <td class="text-center">{{ $item['units'] }}</td>
            <td class="text-right">
                {{($item['price']) }} Azn
            </td>
            <td class="text-right">{{ $item['qty'] }}</td>

            <td class="text-right pr-0">
                {{ ($item['price']*$item['qty']) }} Azn
            </td>
        </tr>
        {{$i++}}
        {{ ($count=$count+($item['price']*$item['qty'])) }}
    @endforeach

            <tr>
                <td colspan="" class="border-0"></td>

                <td class="text-right pr-0 ">
                <td class="text-right pr-0 ">
                <td class="text-right pr-0 ">
                <td class="text-right pl-0">Toplam Cəmi :</td>
                <td class="text-right pr-0 total-amount">
                    {{$count}} Azn
                </td>
            </tr>
    </tbody>
</table>


    <p>
        {{ trans('lang.Note') }}: <br>
    </p>

<script type="text/php">
            if (isset($pdf) && $PAGE_COUNT > 1) {
                $text = "Page {PAGE_NUM} / {PAGE_COUNT}";
                $size = 10;
                $font = $fontMetrics->getFont("Verdana");
                $width = $fontMetrics->get_text_width($text, $font, $size) / 2;
                $x = ($pdf->get_width() - $width);
                $y = $pdf->get_height() - 35;
                $pdf->page_text($x, $y, $text, $font, $size);
            }
        </script>
</body>
</html>
