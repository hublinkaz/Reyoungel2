<?php $__env->startSection('title', 'General'); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/date-picker.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/owlcarousel.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/prism.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/whether-icon.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>
<?php
 $last_qty=0;
   $last_amount=0;
    $last_total_qty=0;
  $last_total_amount=0;
  $last_company_price=0;
   $last_manager_price=0;
?>





<?php $__env->startSection('content'); ?>
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h5><?php echo e(trans('lang.Daily Operations')); ?></h5>
                <div class="card-header-right">
                    <ul class="list-unstyled card-option">
                        <li><i class="fa fa-spin fa-cog"></i></li>
                        <li><i class="view-html fa fa-code"></i></li>
                        <li><i class="icofont icofont-maximize full-card"></i></li>
                        <li><i class="icofont icofont-minus minimize-card"></i></li>
                        <li><i class="icofont icofont-refresh reload-card"></i></li>
                        <li><i class="icofont icofont-error close-card"></i></li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <div class="user-status table-responsive">
                    <table class="table table-bordernone">
                        <thead>
                        <tr>
                            <th scope="col"><?php echo e(trans('lang.id')); ?></th>
                            <th scope="col"><?php echo e(trans('lang.Manager Name')); ?></th>
                            <th scope="col"><?php echo e(trans('lang.Price Qty')); ?></th>
                            <th scope="col"><?php echo e(trans('lang.Total Payment')); ?></th>
                            <th scope="col"><?php echo e(trans('lang.Operation Qty')); ?></th>
                            <th scope="col"><?php echo e(trans('lang.Totol Operation Paid')); ?></th>



                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            $total_qty =0;
                            $total_amount =0;
                            $total_total_qty =0;
                            $total_total_amount =0;

                        ?>

                        <?php $__currentLoopData = $managers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $manager): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <?php
                                $total_qty +=$manager->qty;
                                $total_amount += round($manager->amount,1);
                                $total_total_qty +=$manager->total_qty;
                                $total_total_amount +=round($manager->total_amount,1);

                            ?>

                            <tr>

                                <td><a href="<?php echo e(route('manager.profile',$manager->id)); ?>"><?php echo e($manager->id); ?> </a></td>
                                <td><a href="<?php echo e(route('manager.profile',$manager->id)); ?>"><?php echo e($manager->first_name); ?> <?php echo e($manager->last_name); ?></a></td>
                                <td><?php echo e($manager->qty); ?></td>
                                <td><?php echo e(round($manager->amount,1)); ?></td>
                                <td><?php echo e($manager->total_qty); ?></td>
                                <td><?php echo e(round($manager->total_amount,1)); ?></td>



                            </tr>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <tr style="background-color:#ffae00; font-weight: 700;">

                            <td> </td>
                            <td><?php echo e(trans('lang.Total')); ?></td>
                            <td><?php echo e($total_qty); ?></td>
                            <td><?php echo e($total_amount); ?></td>
                            <td><?php echo e($total_total_qty); ?></td>
                            <td><?php echo e($total_total_amount); ?></td>
                        </tr>

                        </tbody>
                    </table>
<br>
<br>
                    <table class="table table-bordernone">
                        <thead>
                        <tr>
                            <th scope="col"><?php echo e(trans('lang.id')); ?></th>
                            <th scope="col"><?php echo e(trans('lang.Manager Name')); ?></th>
                               <th scope="col"><?php echo e(trans('lang.Totol Operation Paid')); ?></th>
                            <th scope="col"><?php echo e(trans('lang.Paid Company')); ?></th>
                            <th scope="col"><?php echo e(trans('lang.Manager Paid')); ?></th>


                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            $total_qty =0;
                            $total_amount =0;
                            $total_total_qty =0;
                            $total_total_amount =0;
                            $total_company_price =0;
                            $total_manager_price =0;
                        ?>

                        <?php $__currentLoopData = $manager_prices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $manager_price): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <?php
                            if (empty($manager_price->paid)){
                                $total_qty +=0;
                                $total_amount += 0;
                                $total_total_qty +=0;

                            }else{
                                $total_qty +=$manager_price->paid;
                                $total_amount += round($manager_price->paid-round($manager_price->manager,1),1);
                                $total_total_qty +=round($manager_price->manager,1);

                                }
                            ?>

                            <tr>

                                <td><a href="<?php echo e(route('manager.profile',$manager_price->id)); ?>"><?php echo e($manager_price->id); ?> </a></td>
                                <td><a href="<?php echo e(route('manager.profile',$manager_price->id)); ?>"><?php echo e($manager_price->first_name); ?> <?php echo e($manager_price->last_name); ?></a></td>
                                <td><?php echo e($manager_price->paid); ?></td>
                                <td><?php echo e($manager_price->paid-round($manager_price->manager,1)); ?></td>
                                <td><?php echo e(round($manager_price->manager,1)); ?></td>


                            </tr>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <tr style="background-color:#ffae00; font-weight: 700;">

                            <td> </td>
                            <td><?php echo e(trans('lang.Total')); ?></td>
                            <td><?php echo e($total_qty); ?></td>
                            <td><?php echo e($total_amount); ?></td>
                            <td><?php echo e($total_total_qty); ?></td>


                        </tr>

                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </div>





    <div class="container-fluid">
        <div class="row">


            <div class="col-xl-6 xl-100 box-col-12">
                <div class="card">
                    <div class="mobile-clock-widget">
                        <div class="bg-svg">
                            <svg class="climacon climacon_cloudLightningMoon" id="cloudLightningMoon" version="1.1" viewBox="15 15 70 70">
                                <clippath id="moonCloudFillClipfill11">
                                    <path d="M0,0v100h100V0H0z M60.943,46.641c-4.418,0-7.999-3.582-7.999-7.999c0-3.803,2.655-6.979,6.211-7.792c0.903,4.854,4.726,8.676,9.579,9.58C67.922,43.986,64.745,46.641,60.943,46.641z"></path>
                                </clippath>
                                <clippath id="cloudFillClipfill19">
                                    <path d="M15,15v70h70V15H15z M59.943,61.639c-3.02,0-12.381,0-15.999,0c-6.626,0-11.998-5.371-11.998-11.998c0-6.627,5.372-11.999,11.998-11.999c5.691,0,10.434,3.974,11.665,9.29c1.252-0.81,2.733-1.291,4.334-1.291c4.418,0,8,3.582,8,8C67.943,58.057,64.361,61.639,59.943,61.639z"></path>
                                </clippath>
                                <g class="climacon_iconWrap climacon_iconWrap-cloudLightningMoon">
                                    <g clip-path="url(#cloudFillClip)">
                                        <g class="climacon_wrapperComponent climacon_wrapperComponent-moon climacon_componentWrap-moon_cloud" clip-path="url(#moonCloudFillClip)">
                                            <path class="climacon_component climacon_component-stroke climacon_component-stroke_sunBody" d="M61.023,50.641c-6.627,0-11.999-5.372-11.999-11.998c0-6.627,5.372-11.999,11.999-11.999c0.755,0,1.491,0.078,2.207,0.212c-0.132,0.576-0.208,1.173-0.208,1.788c0,4.418,3.582,7.999,8,7.999c0.614,0,1.212-0.076,1.788-0.208c0.133,0.717,0.211,1.452,0.211,2.208C73.021,45.269,67.649,50.641,61.023,50.641z"></path>
                                        </g>
                                    </g>
                                    <g class="climacon_wrapperComponent climacon_wrapperComponent-lightning">
                                        <polygon class="climacon_component climacon_component-stroke climacon_component-stroke_lightning" points="48.001,51.641 57.999,51.641 52,61.641 58.999,61.641 46.001,77.639 49.601,65.641 43.001,65.641 "></polygon>
                                    </g>
                                    <g class="climacon_wrapperComponent climacon_wrapperComponent-cloud">
                                        <path class="climacon_component climacon_component-stroke climacon_component-stroke_cloud" d="M59.999,65.641c-0.28,0-0.649,0-1.062,0l3.584-4.412c3.182-1.057,5.478-4.053,5.478-7.588c0-4.417-3.581-7.998-7.999-7.998c-1.602,0-3.083,0.48-4.333,1.29c-1.231-5.316-5.974-9.29-11.665-9.29c-6.626,0-11.998,5.372-11.998,12c0,5.446,3.632,10.039,8.604,11.503l-1.349,3.777c-6.52-2.021-11.255-8.098-11.255-15.282c0-8.835,7.163-15.999,15.998-15.999c6.004,0,11.229,3.312,13.965,8.204c0.664-0.114,1.338-0.205,2.033-0.205c6.627,0,11.999,5.371,11.999,11.999C71.999,60.268,66.626,65.641,59.999,65.641z"></path>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <div>
                            <ul class="clock" id="clock">
                                <li class="hour" id="hour"></li>
                                <li class="min" id="min"></li>
                                <li class="sec" id="sec"></li>
                            </ul>
                            <div class="date f-24 mb-2" id="date"><span id="monthDay"></span><span id="year">, </span></div>
                            <div>
                                <p class="m-0 f-14 text-light"><?php echo e(trans('lang.Daily reports must be submitted by 04:00.')); ?></p>
                                <p class="m-0 f-14 text-light">Baku, Azerbaijan </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>





















































        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('assets/js/prism/prism.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/clipboard/clipboard.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/counter/jquery.waypoints.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/counter/jquery.counterup.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/counter/counter-custom.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/custom-card/custom-card.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datepicker/date-picker/datepicker.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datepicker/date-picker/datepicker.en.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datepicker/date-picker/datepicker.custom.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/owlcarousel/owl.carousel.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/general-widget.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/height-equal.js')); ?>"></script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layouts.simple.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\resources\views/admin/dashboard/index.blade.php ENDPATH**/ ?>