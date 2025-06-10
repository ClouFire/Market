<div class="site-wrap">

    <div class="site-blocks-cover" data-aos="fade">
        <div class="container">
            <div class="row">
                <div class="col-md-6 ml-auto order-md-2 align-self-start">
                    <div class="site-block-cover-content">
                        <h2 class="sub-title">#New Summer Collection 2019</h2>
                        <h1>Arrivals Sales</h1>
                        <p><a href="<?= baseUrl('/shop')?>" class="btn btn-black rounded-0">Shop Now</a></p>
                    </div>
                </div>
                <div class="col-md-6 order-1 align-self-end">
                    <img src="<?= baseUrl('/assets/images/model_3.png') ?>" alt="Image" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

    <div class="site-section">
        <div class="container">
            <div class="title-section mb-5">
                <h2 class="text-uppercase"><span class="d-block">Discover</span> The Collections</h2>
            </div>
            <div class="row align-items-stretch">
                <div class="col-lg-8">
                    <div class="product-item sm-height full-height bg-gray">
                        <a href="#" class="product-category">Women <span><?= countItems('Women') ?> <?= countItems('Women') > 1 ? 'items' : 'item' ?></span></a>
                        <img src="<?= baseUrl('/assets/images/model_4.png')?>" alt="Image" class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="product-item sm-height bg-gray mb-4">
                        <a href="#" class="product-category">Men <span><?= countItems('Men') ?> <?= countItems('Men') > 1 ? 'items' : 'item' ?></span></a>
                        <img src="<?= baseUrl('/assets/images/model_5.png')?>" alt="Image" class="img-fluid">
                    </div>

                    <div class="product-item sm-height bg-gray">
                        <a href="#" class="product-category">Shoes <span><?= countItems('Shoes') ?> <?= countItems('Shoes') > 1 ? 'items' : 'item' ?></span></a>
                        <img src="<?= baseUrl('/assets/images/model_6.png')?>" alt="Image" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="site-section">
        <div class="container">
            <div class="row">
                <div class="title-section mb-5 col-12">
                    <h2 class="text-uppercase">Popular Products</h2>
                </div>
            </div>
            <div class="row">
                <?php for($i = 1; $i <= 6; $i++) :?>
                <?= getProductsCards($i); ?>
                <?php endfor; ?>
            </div>
        </div>
    </div>

    <div class="site-section">
        <div class="container">
            <div class="row">
                <div class="title-section text-center mb-5 col-12">
                    <h2 class="text-uppercase">Most Rated</h2>
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

    <div class="site-blocks-cover inner-page py-5" data-aos="fade">
        <div class="container">
            <div class="row">
                <div class="col-md-6 ml-auto order-md-2 align-self-start">
                    <div class="site-block-cover-content">
                        <h2 class="sub-title">#New Summer Collection 2019</h2>
                        <h1>New Shoes</h1>
                        <p><a href="<?= baseUrl('/shop')?>" class="btn btn-black rounded-0">Shop Now</a></p>
                    </div>
                </div>
                <div class="col-md-6 order-1 align-self-end">
                    <img src="<?= baseUrl('/assets/images/model_6.png')?>" alt="Image" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

</div>

<script src="<?= baseUrl('/assets/js/jquery-3.3.1.min.js') ?>"></script>
<script src="<?= baseUrl('/assets/js/jquery-ui.js') ?>"></script>
<script src="<?= baseUrl('/assets/js/popper.min.js') ?>"></script>
<script src="<?= baseUrl('/assets/js/bootstrap.min.js') ?>"></script>
<script src="<?= baseUrl('/assets/js/owl.carousel.min.js') ?>"></script>
<script src="<?= baseUrl('/assets/js/jquery.magnific-popup.min.js') ?>"></script>
<script src="<?= baseUrl('/assets/js/aos.js') ?>"></script>

<script src="<?= baseUrl('/assets/js/main.js') ?>"></script>