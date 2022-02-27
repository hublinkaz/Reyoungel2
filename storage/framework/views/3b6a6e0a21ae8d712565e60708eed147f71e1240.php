<?php $__env->startSection('content'); ?>

    <div class="single-blog">
        <div class="container">

            <div class="single-blog-post">
                <h3 class="title">
                    <a href=""><?php echo e($blog->name_az); ?></a>
                </h3>
                <div class="blog-tag">
                    <div class="blog-date">
                        <?php echo e($blog->created_at); ?>

                    </div>

                </div>
                <div class="single-blog-desc">
                    <div class="blog-second-img text-center">
                        <a href="" class="effect-img3 plus-zoom"><img src="/public/assets/images/blog/<?php echo e($blog->image); ?>" alt="Blog" class="img-responsive"></a>
                    </div>
                    <p style="width:100%">
                    <?php echo $blog->desc_az; ?>

                    </p>


                </div>
            </div>

        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u553624116/domains/reyoungel.az/public_html/resources/views/frontend/blog.blade.php ENDPATH**/ ?>