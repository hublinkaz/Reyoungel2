<?php $__env->startSection('content'); ?>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="container">
        <div class="contact-form">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12 ">
                    <div class="contact-img hover-images contact-item">
                        <a href="" class="">
                            <img src="public/frontend/img/contact_img.jpg" alt="" class="img-responsive">
                        </a>
                        <div class="box-center overlay-img contact-overlay-img">
                            <a class="email" href="">info@reyoungel.az</a>
                            <div class="social">
                                <a href="https://www.facebook.com/Reyoungel-Azerbaijan-102633278214319"><i class="fa fa-facebook"></i></a>
                                <a href="https://api.whatsapp.com/send?phone=+994552277389"><i class="fa fa-whatsapp"></i></a>
                                <a href="https://www.instagram.com/reyoungel_azerbaijan/"><i class="fa fa-instagram"></i></a>
                                <a href="tel:055-227-73-89"><i class="fa fa-phone"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <h3 class="contact-title"><?php echo e(trans('lang.Contact us')); ?></h3>

                    <form method="post" class="form-customer form-login">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="offer" id="flexRadioDefault1" checked>
                            <label class="form-check-label" for="flexRadioDefault2">
                                <?php echo e(trans('lang.Buy Product')); ?>

                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="offer" id="flexRadioDefault2" >
                            <label class="form-check-label" for="flexRadioDefault2">
                                <?php echo e(trans('lang.Aesthetic Procedure')); ?>

                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="offer" id="flexRadioDefault3">
                            <label class="form-check-label" for="flexRadioDefault1">
                                <?php echo e(trans('lang.Offer')); ?>

                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="offer" id="flexRadioDefault4" >
                            <label class="form-check-label" for="flexRadioDefault2">
                                <?php echo e(trans('lang.Complaint')); ?>

                            </label>
                        </div>

                        <div class="form-group">
                            <input type="email" class="form-control form-account" placeholder="<?php echo e(trans('lang.Full Name')); ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-account" placeholder="<?php echo e(trans('lang.Email')); ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-account" placeholder="<?php echo e(trans('lang.Telephone')); ?>">
                        </div>
                        <div class="form-group">
                            <textarea rows="7" name="note" placeholder="<?php echo e(trans('lang.Tell Us More')); ?>" class="form-control form-account"></textarea>
                        </div>
                        <div class="btn-button-group mg-top-30 mg-bottom-15">
                            <button type="submit" class="zoa-btn btn-login hover-white"><?php echo e(trans('lang.Send Message')); ?></button>
                        </div>
                    </form>
                </div>
            </div>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d759.4821361651287!2d49.861552129222666!3d40.4104337198548!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40307d568097bec1%3A0x2ffe03e49292067d!2s23a%20Ahmad%20Rajabli%2C%20Baku%201075%2C%20Azerbaycan!5e0!3m2!1str!2sus!4v1636743125526!5m2!1str!2sus" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>        </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u553624116/domains/reyoungel.az/public_html/resources/views/frontend/contact.blade.php ENDPATH**/ ?>