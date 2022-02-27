<?php $__env->startSection('content'); ?>
<br>
<br>
<br>
    <div class="blog-list">
        <div class="container">
            <div class="row">
                <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="blog-list-item">
                    <div class="col-md-5 col-sm-6 col-xs-12">
                        <div class="blog-list-info">
                            <div class="blog-tag">
                                <div class="blog-date text-uppercase">
                                    <?php echo e($blog->created_at); ?>

                                </div>
                            </div>
                            <h3 class="blog-title">
                                <a href="/blog/<?php echo e($blog->id); ?>"><?php echo e($blog->{'name_'.app()->getLocale()}); ?></a>
                            </h3>
                            <p class="blog-desc"> <?php echo \Illuminate\Support\Str::limit($blog->{'desc_'.app()->getLocale()}  , 500, ' ...'); ?> </p>
                            <a href="/blog/<?php echo e($blog->id); ?>" class="read-more">Ətraflı</a>
                        </div>
                    </div>
                    <div class="col-md-7 col-sm-6 col-xs-12">
                        <div class="blog-img">
                            <a href="/blog/<?php echo e($blog->id); ?>" class="effect-img3 plus-zoom">
                                <img style="width:100%" src="public/assets/images/blog/<?php echo e($blog->image); ?>" alt="" class="img-reponsive">

                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>
            <ul class="pagination">
                <?php if($blogs->links()->paginator->hasPages()): ?>

                    <?php echo e($blogs->render()); ?>


                <?php endif; ?>
            </ul>
        </div>
    </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u553624116/domains/reyoungel.az/public_html/resources/views/frontend/blogs.blade.php ENDPATH**/ ?>