<div class="site-section">
    <div class="container">
        <div class="row mb-5">
            <form class="col-md-12" method="post">
                <div class="site-blocks-table">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th class="product-thumbnail">Image</th>
                            <th class="product-name">Product</th>
                            <th class="product-price">Price</th>
                            <th class="product-quantity">Quantity</th>
                            <th class="product-total">Total</th>
                            <th class="product-remove">Remove</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?= getCartRow($cart); ?>
                        </tbody>
                    </table>
                </div>
            </form>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="row mb-5">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <button class="btn btn-primary btn-sm btn-block" onclick="window.location.reload()">Update Cart</button>
                    </div>
                    <div class="col-md-6">
                        <button onclick="window.location.href='<?= baseUrl('/shop') ?>'" class="btn btn-outline-primary btn-sm btn-block">Continue Shopping</button>
                    </div>
                </div>
                <form action="<?= baseUrl('/cart/coupon') ?>" method="post">
                    <?= getCsrfField(); ?>
                <div class="row">
                    <div class="col-md-12">
                        <label class="text-black h4" for="coupon">Coupon</label>
                        <p>Enter your coupon code if you have one.</p>
                    </div>
                    <div class="col-md-8 mb-3 mb-md-0">
                        <input type="text" class="form-control py-3" id="coupon" name="coupon" placeholder="Coupon Code">
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-primary btn-sm px-4">Apply Coupon</button>
                    </div>

                </div>
                </form>
            </div>
            <div class="col-md-6 pl-5">
                <div class="row justify-content-end">
                    <div class="col-md-7">
                        <div class="row">
                            <div class="col-md-12 text-right border-bottom mb-5">
                                <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <span class="text-black">Subtotal</span>
                            </div>
                            <div class="col-md-6 text-right">
                                <?php if(isset($cart['price'])) : ?>
                                <strong class="text-black">$<?= getTotalPrice($cart) ?>.00</strong>
                                <?php else : ?>
                                <strong class="text-black">$0</strong>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-6">
                                <span class="text-black">Total</span>
                            </div>
                            <div class="col-md-6 text-right">
                                <?php if($params) : ?>
                                <strong class="text-black">$<?= getTotalPrice($cart, $params) ?>.00</strong>
                                <?php else : ?>
                                <?php if(isset($cart['price'])) : ?>
                                <strong class="text-black">$<?= getTotalPrice($cart) ?>.00</strong>
                                <?php else : ?>
                                <strong class="text-black">$0</strong>
                                <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-primary btn-lg btn-block" onclick="window.location='<?= baseUrl('/checkout') ?>'">Proceed To Checkout</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>