<div class="site-section">
    <div class="container">
        <form method="post" action="<?= baseUrl('/checkout') ?>" id="checkoutForm">
        <div class="row">
            <div class="col-md-6 mb-5 mb-md-0">
                <h2 class="h3 mb-3 text-black">Billing Details</h2>
                <div class="p-3 p-lg-5 border">
                        <?= getCsrfField(); ?>
                        <?= getHiddenProps($cart); ?>
                        <?php if($coupon) : ?>
                        <?= '<input type="hidden" name="coupon" value="' . encrypt($params['id']) . '">' ?>
                        <?php endif; ?>
                        <?php if($params) : ?>
                        <?= '<input type="hidden" name="price" value="' .  encrypt(getTotalPrice($cart, $params)) . '">' ?>
                        <?php else : ?>
                        <?= '<input type="hidden" name="price" value="' .  encrypt(getTotalPrice($cart)) . '">' ?>
                        <?php endif; ?>
                    <div class="form-group">
                        <label for="c_country" class="text-black">Country <span class="text-danger">*</span></label>
                        <select id="c_country" class="form-control <?= getValidationClass('c_country'); ?>" name="c_country">
                            <?= getOptions(); ?>
                        </select>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="c_fname" class="text-black">First Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control <?= getValidationClass('c_fname'); ?>" id="c_fname" name="c_fname" value="<?= old('name'); ?>">
                            <?= get_errors('c_fname');?>
                        </div>
                        <div class="col-md-6">
                            <label for="c_lname" class="text-black">Last Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control <?= getValidationClass('c_lname'); ?>" id="c_lname" name="c_lname" value="<?= old('name'); ?>">
                            <?= get_errors('c_lname');?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="c_companyname" class="text-black">Company Name </label>
                            <input type="text" class="form-control" id="c_companyname" name="c_companyname">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="c_address" class="text-black">Address <span class="text-danger">*</span></label>
                            <input type="text" class="form-control <?= getValidationClass('c_address'); ?>" id="c_address" name="c_address" placeholder="Street address">
                            <?= get_errors('c_address');?>
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Apartment, suite, unit etc. (optional)">
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="c_state_country" class="text-black">State / Country <span class="text-danger">*</span></label>
                            <input type="text" class="form-control <?= getValidationClass('c_state_country'); ?>" id="c_state_country" name="c_state_country">
                            <?= get_errors('c_state_country');?>
                        </div>
                        <div class="col-md-6">
                            <label for="c_postal_zip" class="text-black">Posta / Zip <span class="text-danger">*</span></label>
                            <input type="text" class="form-control <?= getValidationClass('c_postal_zip'); ?>" id="c_postal_zip" name="c_postal_zip">
                            <?= get_errors('c_postal_zip');?>
                        </div>
                    </div>

                    <div class="form-group row mb-5">
                        <div class="col-md-6">
                            <label for="c_email_address" class="text-black">Email Address <span class="text-danger">*</span></label>
                            <input type="text" class="form-control <?= getValidationClass('c_email_address'); ?>" id="c_email_address" name="c_email_address">
                            <?= get_errors('c_email_address');?>
                        </div>
                        <div class="col-md-6">
                            <label for="c_phone" class="text-black">Phone <span class="text-danger">*</span></label>
                            <input type="text" class="form-control <?= getValidationClass('c_phone'); ?>" id="c_phone" name="c_phone" placeholder="Phone Number">
                            <?= get_errors('c_phone');?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="c_order_notes" class="text-black">Order Notes</label>
                        <textarea name="c_order_notes" id="c_order_notes" cols="30" rows="5" class="form-control" placeholder="Write your notes here..."></textarea>
                    </div>

                </div>
            </div>
            </form>
            <div class="col-md-6">
                <form action="<?= baseUrl('/checkout/coupon') ?>" method="post" id="couponForm">
                    <?= getCsrfField(); ?>
                    <div class="row md-5">
                        <div class="col-md-12">
                            <label class="text-black h4" for="coupon">Coupon</label>
                            <p>Enter your coupon code if you have one.</p>
                        </div>
                        <div class="col-md-8 mb-3 mb-md-0">
                            <input type="text" class="form-control py-3" id="coupon" name="coupon" placeholder="Coupon Code">
                        </div>
                </form>
                <?php if(!$coupon) : ?>
                        <div class="col-md-4">
                            <button form="couponForm" type="submit" class="btn btn-primary btn-sm px-4">Apply Coupon</button>
                        </div>
                <?php else : ?>
                        <div class="col-md-4">
                            <button class="btn btn-primary btn-sm px-4" disabled>Coupon already used</button>
                        </div>
                <?php endif; ?>
            </div>
            <form method="post" action="<?= baseUrl('/checkout') ?>" id="checkoutForm">
                <div class="row mb-5">
                    <div class="col-md-12">
                        <h2 class="h3 mb-3 text-black">Your Order</h2>
                        <div class="p-3 p-lg-5 border">
                            <table class="table site-block-order-table mb-5">
                                <thead>
                                <th>Product</th>
                                <th>Total</th>
                                </thead>
                                <tbody>
                                <?= getCartTitles($cart); ?>
                                <tr>
                                    <td class="text-black font-weight-bold"><strong>Cart Subtotal</strong></td>
                                    <td class="text-black">$<?= getTotalPrice($cart); ?>.00</td>
                                </tr>
                                <tr>
                                    <td class="text-black font-weight-bold"><strong>Order Total</strong></td>
                                    <?php if($params) : ?>
                                    <td class="text-black font-weight-bold"><strong>$<?= getTotalPrice($cart, $params); ?>.00</strong></td>
                                    <?php else : ?>
                                        <td class="text-black font-weight-bold"><strong>$<?= getTotalPrice($cart); ?>.00</strong></td>
                                    <?php endif; ?>
                                </tr>
                                </tbody>
                            </table>

                            <div class="border p-3 mb-3">
                                <h3 class="h6 mb-0"><a class="d-block" data-toggle="collapse" href="#collapsebank" role="button" aria-expanded="false" aria-controls="collapsebank">Direct Bank Transfer</a></h3>

                                <div class="collapse" id="collapsebank">
                                    <div class="py-2">
                                        <p class="mb-0">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="border p-3 mb-3">
                                <h3 class="h6 mb-0"><a class="d-block" data-toggle="collapse" href="#collapsecheque" role="button" aria-expanded="false" aria-controls="collapsecheque">Cheque Payment</a></h3>

                                <div class="collapse" id="collapsecheque">
                                    <div class="py-2">
                                        <p class="mb-0">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="border p-3 mb-5">
                                <h3 class="h6 mb-0"><a class="d-block" data-toggle="collapse" href="#collapsepaypal" role="button" aria-expanded="false" aria-controls="collapsepaypal">Paypal</a></h3>

                                <div class="collapse" id="collapsepaypal">
                                    <div class="py-2">
                                        <p class="mb-0">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" form="checkoutForm" class="btn btn-primary btn-lg btn-block">Place Order</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </form>
            <?php
            session()->remove('form_errors');
            session()->remove('form_data');
            ?>
        </div>
    </div>
</div>