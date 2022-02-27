<?php $__env->startSection('content'); ?>

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
                <?php $__currentLoopData = $doctors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-xs-6 col-sm-4 col-md-2 col-lg-2 product-item">
                    <div class="product-img">

                        <a href="/doctor/<?php echo e($doctor->id); ?>"><img style="object-fit: cover" src="public/assets/images/doctors/<?php echo e(json_decode($doctor->images)[0]); ?>" alt="" class="img-responsive"></a>
                    </div>
                    <div class="product-info text-center">
                        <h3 class="product-title">
                            <a href=""><?php echo e($doctor->name); ?></a>
                        </h3>

                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

        </div>
    </div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u553624116/domains/reyoungel.az/public_html/resources/views/frontend/doctors.blade.php ENDPATH**/ ?>