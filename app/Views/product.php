<?= getBreadcrumbs(['product' => [
        'name' => $product['name'],
        'id' => $product['id'],
]]); ?>

    <div class="site-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="item-entry">
                        <a href="#" class="product-item md-height bg-gray d-block">
                            <img src="<?= baseUrl("/assets/{$product['image']}") ?>" alt="Image" class="img-fluid">
                        </a>

                    </div>

                </div>
                <div class="col-md-6">
                    <h2 class="text-black"><?= $product['name'] ?></h2>
                    <p><?= $product['description'] ?></p>
                    <p class="mb-4">In stock now: <?= $product['amount'] ?></p>
                    <p><strong class="text-primary h4">$<?= $product['price'] ?>.00</strong></p>
                    <form action="<?= baseUrl("/shop/product?id={$product['id']}") ?>" method="post">
                    <div class="mb-1 d-flex">
                        <label for="option-sm" class="d-flex mr-3 mb-3">
                            <span class="d-inline-block mr-2" style="top:-2px; position: relative;"><input type="radio" id="option-sm" name="shop-sizes" checked></span> <span class="d-inline-block text-black">Small</span>
                        </label>
                        <label for="option-md" class="d-flex mr-3 mb-3">
                            <span class="d-inline-block mr-2" style="top:-2px; position: relative;"><input type="radio" id="option-md" name="shop-sizes"></span> <span class="d-inline-block text-black">Medium</span>
                        </label>
                        <label for="option-lg" class="d-flex mr-3 mb-3">
                            <span class="d-inline-block mr-2" style="top:-2px; position: relative;"><input type="radio" id="option-lg" name="shop-sizes"></span> <span class="d-inline-block text-black">Large</span>
                        </label>
                        <label for="option-xl" class="d-flex mr-3 mb-3">
                            <span class="d-inline-block mr-2" style="top:-2px; position: relative;"><input type="radio" id="option-xl" name="shop-sizes"></span> <span class="d-inline-block text-black"> Extra Large</span>
                        </label>
                    </div>
                        <?= getCsrfField(); ?>
                        <input type="hidden" name="return_url" value="<?= $_SERVER['REQUEST_URI'] ?>">
                        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                        <input type="hidden" name="product_amount" value="<?= $product['amount'] ?>">
                    <div class="mb-5">
                        <div class="input-group mb-3" style="max-width: 120px;">
                            <div class="input-group-prepend">
                                <button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
                            </div>
                            <input type="text" class="form-control text-center" name="product_cart_amount" value="1" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                            <div class="input-group-append">
                                <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
                            </div>
                        </div>
                    </div>
                        <?php if(db()->execute("SELECT id FROM cart_item WHERE good_id = ? AND cart_id = ?", [$product['id'], getUserCartId()])->getStatement()->fetchAll()) : ?>
                        <p><button type="submit" class="buy-now btn btn-sm height-auto px-4 py-3 btn-primary" disabled>Already in cart</button></p>
                        <?php else : ?>
                            <p><button type="submit" class="buy-now btn btn-sm height-auto px-4 py-3 btn-primary">Add to cart</button></p>
                        <?php endif; ?>
                    </form>


                </div>
            </div>
        </div>
    </div>

    <div class="site-section block-3 site-blocks-2">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-7 site-section-heading text-center pt-4">
                    <h2>Featured Products</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 block-3">
                    <div class="nonloop-block-3 owl-carousel">
                        <?= getMostRated(5); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>