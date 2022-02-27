<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo e($company['name']); ?></title>
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


<table class="table">
    <tbody>
    <tr>
        <td class="border-0 pl-0" width="70%">

                <img style="width: 300px" src="<?php echo e(asset('assets/images/logo/logo.png')); ?>" alt="logo">
                <img src="<?php echo e(asset('assets/images/logo/bioha.png')); ?>" alt="logo">

        </td>

        <td class="border-0 pl-0">
            <p>Instagram : <strong>reyoungel_azerbaijan</strong></p>
            <p>Facebook : <strong>Reyoungel Azerbaijan</strong></p>
            <p>Email : <strong>info@reyoungel.az</strong></p>
            <p>Tell & WhatsApp : <strong>+994 55 227 73 89</strong></p>
            <p>Web : <strong>reyoungel.az</strong></p>
        </td>
    </tr>
    </tbody>
</table>
<p>&nbsp;&nbsp; <?php echo e(trans('lang.Serial')); ?>  <strong><?php echo e($data['serila']); ?></strong> &nbsp;&nbsp;  <?php echo e(trans('lang.Date')); ?> : <strong> <?php echo e($data['date']); ?> </strong></p>

<table class="table">
    <thead>
    <tr>
        <th class="border-0 pl-0 party-header" width="48.5%">
            <?php echo e(trans('lang.Customer')); ?>

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
                    <strong><?php echo e($manager['name']); ?></strong>
                </p>

                <p class="seller-address">
                    <?php echo e(trans('lang.address')); ?>  : <?php echo e($manager['address']); ?>

                </p>

                <p class="seller-code">
                    <?php echo e(trans('lang.Telephone')); ?> : <?php echo e($manager['phone']); ?>

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






        </td>
    </tr>
    </tbody>
</table>


<table class="table">
    <thead>
    <tr>
        <th scope="col" class="border-0 pl-0"><?php echo e(trans('lang.N')); ?></th>
        <th scope="col" class="border-0 pl-0"><?php echo e(trans('lang.Product Name')); ?></th>
        <th scope="col" class="text-center border-0"><?php echo e(trans('lang.Units')); ?></th>
        <th scope="col" class="text-center border-0"><?php echo e(trans('lang.Qty')); ?></th>
        <th scope="col" class="text-center border-0"><?php echo e(trans('lang.Price')); ?></th>


        <th scope="col" class="text-right border-0"><?php echo e(trans('lang.Amount')); ?></th>

        <th scope="col" class="text-right border-0"><?php echo e(trans('lang.Paid')); ?></th>

    </tr>
    </thead>
    <tbody>
    
    <?php echo e($i=1); ?>

    <?php echo e($count_amount=0); ?>

    <?php echo e($count_paid=0); ?>

    <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $count_amount +=$item->amount;
            $count_paid +=$item->paid;
        ?>
        <tr>
            <td class="pl-0"><?php echo e($i); ?></td>
            <td class="pl-0"><?php echo e($item->{'name_'.app()->getLocale()}); ?></td>
            <td class="pl-0"><?php echo e($item->units==null ? '--':$item->units); ?></td>


                <td class="text-center"><?php echo e($item->qty==null ? '--': $item->qty); ?></td>
            <td class="text-right">
                <?php echo e(($item->price)); ?> Azn
            </td>
            <td class="text-right"><?php echo e(($item->amount ==null ? '--':$item->amount.' Azn')); ?>

            </td>

            <td class="text-right pr-0">

                <?php echo e(($item->paid ==null ? '--':$item->paid.' Azn')); ?>

            </td>
        </tr>
        <?php echo e($i++); ?>


    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <tr>
                <td colspan="" class="border-0"></td>

                <td class="text-right pr-0 "> Ümumi məbləğ  :</td>
                <td class="text-right pr-0 total-amount"> <?php echo e($count_amount); ?> Azn </td>
                <td class="text-right pr-0 ">Ümumi Ödəniş  :</td>
                <td class="text-right pr-0 total-amount">
                    <?php echo e($count_paid); ?> Azn
                </td>
                <td class="text-right pl-0">
            </tr>
            <tr>

            </tr>
    </tbody>
</table>





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
<?php /**PATH /home/u553624116/domains/reyoungel.az/public_html/resources/views/admin/invoice/report_invoice.blade.php ENDPATH**/ ?>