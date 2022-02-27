<?php $__env->startSection('content'); ?>

<br>
<br>
<br>
<br>
<br>
<br>
    <div class="container container-content">
        <div class="single-product-detail">

            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="flex product-img-slide">
                        <div class="product-images">
                            <div class="main-img js-product-slider">
                                <?php $__currentLoopData = json_decode($doctor->images); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="#" class="hover-images effect"><img src="/public/assets/images/doctors/<?php echo e($image); ?>" alt="photo" class="img-responsive"></a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                $link='https://www.youtube.com/embed/'.$doctor->video_url;


                                 ?>

                            </div>
                        </div>
                        <div class="multiple-img-list-ver2 js-click-product">

                            <?php $__currentLoopData = json_decode($doctor->images); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="product-col">
                                    <div class="img">
                                        <img src="/public/assets/images/doctors/<?php echo e($image); ?>" alt="images" class="img-responsive">
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="single-product-info product-info product-grid-v2">
                        <h3 class="product-title"><a href="#"><?php echo e($doctor->name); ?></a></h3>
                        <div class="product-price">
                            <span><?php echo e(trans('lang.doctor_')); ?></span>
                            <span><?php echo e($doctor->workplace); ?></span>
                        </div>
                        <p class="product-desc"><?php echo e($doctor->phone); ?></p>
                        <p class="product-desc"><?php echo e($doctor->location); ?></p>

                        <div class="short-desc">
                            <?php echo $doctor->text; ?>


                        </div>
                        <?php if(!empty($link)): ?>
                            <a href="#" class="hover-images effect">  <iframe width="100%" height="100%" src="<?php echo e($link); ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- EndContent -->
    </div>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u553624116/domains/reyoungel.az/public_html/resources/views/frontend/doctor.blade.php ENDPATH**/ ?>