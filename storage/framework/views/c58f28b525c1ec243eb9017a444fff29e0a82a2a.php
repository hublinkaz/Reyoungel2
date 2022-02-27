<?php $__env->startSection('content'); ?>

    <!-- breadcrumb-area -->
    <div class="container">
        <div class="row">
        <div class="zoa-cart">
            <ul class="account-tab">
                <li class="active"><a data-toggle="tab" href="#cart" aria-expanded="false"><?php echo e(trans('lang.Shopping Cart')); ?></a></li>
            </ul>
            <div class="tab-content">
                <div id="cart" class="tab-pane fade in active">
                    <div class="shopping-cart">
                        <div class="table-responsive">
                            <table class="table cart-table">
                                <thead >
                                <tr>
                                    <th style="padding: 30px 90px 30px 0; width:256px;" class="product-thumbnail"><?php echo e(trans('lang.Image')); ?></th>
                                    <th style="padding: 30px 90px 30px 0;" class="product-name"><?php echo e(trans('lang.Name')); ?></th>
                                    <th style="padding: 30px 90px 30px 0;" class="product-name"><?php echo e(trans('lang.Price')); ?></th>
                                    <th style="padding: 30px 90px 30px 0;" class="product-name"><?php echo e(trans('lang.Count')); ?></th>
                                    <th style="padding: 30px 90px 30px 0;" class="product-price"><?php echo e(trans('lang.Total Price')); ?></th>
                                    <th style="padding: 30px 90px 30px 0;" class="product-quantity"><?php echo e(trans('lang.Minus')); ?></th>
                                    <th style="padding: 30px 90px 30px 0;" class="product-subtotal"><?php echo e(trans('lang.Plus')); ?></th>
                                </tr>
                                </thead>
                                <tbody class="show-cart">

                                </tbody>
                            </table>
                        </div>
                        <div class="table-cart-bottom">
                            <div class="row">

















                                <?php if(!Auth::guest()): ?>
                                    <div class="col-md-5 col-sm-6 col-xs-12">
                                        <form>
                                            <?php if(\Illuminate\Support\Facades\Auth::user()->role_id == 5): ?>
                                                <label for="location"></label><textarea name="location" required id="location" placeholder="<?php echo e(trans('lang.Note')); ?>" class="form-control btn-square" ></textarea>
                                            <?php else: ?>
                                                <label for="location"></label><textarea name="location" required id="location" placeholder="<?php echo e(trans('lang.Note')); ?>" class="form-control btn-square" ></textarea>

                                            <?php endif; ?>

                                                <label for="doctorid"><?php echo e(trans('lang.Doctor')); ?></label>

                                                <select required name="order_type" id="order_type" class="form-control" title="Select customer...">
                                                    <option value="1"><?php echo e(trans('lang.Purchase in cash')); ?></option>
                                                    <option value="2"><?php echo e(trans('lang.Deposit')); ?></option>

                                                </select>



                                            <input class="form-control" type="hidden"  name="user" id="user" value="<?php echo e(Auth::user()->id); ?>" >
                                            <input class="form-control" type="hidden"  name="doctorid" id="doctorid" value="<?php echo e(Auth::user()->id); ?>" >



                                            <input class="form-control" type="hidden"  name="role" id="role" value="5" >
                                            <input class="form-control" type="hidden"  name="pdf" id="pdf" value="<?php echo e(time()); ?>" >
                                            <div class="cart-text">
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                <div class="cart-element text-bold">
                                                    <p><?php echo e(trans('lang.Total')); ?>:</p>
                                                    <p class="total-cart"></p>AZN
                                                </div>
                                            </div>



                                                <a href="#" class="zoa-btn zoa-checkout checkout_post"><?php echo e(trans('lang.Checkout')); ?></a>
                                        </form>
                                    </div>
                                <?php else: ?>
                                    <a href="/login" class="zoa-btn zoa-checkout "><?php echo e(trans('lang.Checkout')); ?></a>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
    <!-- cart-area-end -->


<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u553624116/domains/reyoungel.az/public_html/resources/views/frontend/cart.blade.php ENDPATH**/ ?>