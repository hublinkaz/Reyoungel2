<?php $__env->startSection('content'); ?>


    <!-- start Home Slider -->

    <!-- content -->
    <div class="slide v2">
        <div class="js-slider-v3">
            <?php $__currentLoopData = $slides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="slide-img">
                    <img src="public/assets/images/slider/<?php echo e($slide->image); ?>" alt="" class="img-responsive">
                    <div class="box-center content1">

                        <h1 ><?php echo e($slide->{'text_'.app()->getLocale()}); ?></h1>
                        <a  style="color: #FFFFFF" href="<?php echo e($slide->button_link); ?>" class="slide-btn"><?php echo e($slide->{'button_text_'.app()->getLocale()}); ?></a>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>
        <div class="custom">
            <div class="pagingInfo"></div>
        </div>
    </div>
    <!-- End content -->


    <div class="banner pad">
        <div class="container container-content">
            <div class="row">
                <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="banner-img">
                        <a href="" class="effect-img3">
                            <img class="img-responsive" src="/public/assets/images/banner/<?php echo e($banner->image); ?>" alt="">
                        </a>
                        <div class="box-center content">

                        </div>
                    </div>
                                                <h4> <?php echo e($banner->{'text_'.app()->getLocale()}); ?></h4>
                            <a href="<?php echo e($banner->url); ?>"><?php echo e(trans('lang.Details')); ?></a>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
    <div class="zoa-product pad" id="products">
        <h3 class="title home-title text-center"><?php echo e(trans('lang.Products')); ?></h3>
        <div class="container container-content">
            <div class="row engoc-row-equal">
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <div class="col-xs-6 col-sm-4 col-md-15 col-lg-15 product-item">
                        <div class="product-img">
                            <a href="/product/<?php echo e($product->id); ?>"><img src="public/assets/images/product/<?php echo e($product->image); ?>" alt="" class="img-responsive"></a>
    
                            <div class="product-button-group">

                                <a href="#" class="add-to-cart zoa-btn zoa-addcart" data-id="<?php echo e($product->id); ?>" data-price="<?php echo e($product->price); ?>" data-name_az="<?php echo e($product->name_az); ?>" data-name_en="<?php echo e($product->name_en); ?>" data-name_ru="<?php echo e($product->name_ru); ?>" data-name_tr="<?php echo e($product->name_tr); ?>" data-image="<?php echo e($product->image); ?>" >
                                    <span class="zoa-icon-cart"></span>
                                </a>
                            </div>
                        </div>
                        <div class="product-info text-center">
                            <h3 class="product-title">
                                <a href="/product/<?php echo e($product->id); ?>"><?php echo e($product->{'name_'.app()->getLocale()}); ?></a>
                            </h3>
                            <?php if(!\Illuminate\Support\Facades\Auth::guest()): ?>
                                <div class="product-price">
                                    <span><?php echo e($product->price); ?> ₼</span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>

        </div>
    </div>





















<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\resources\views/frontend/home.blade.php ENDPATH**/ ?>