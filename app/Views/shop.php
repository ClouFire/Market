<div class="site-section">
    <div class="site-blocks-cover inner-page" data-aos="fade">
        <div class="container">
            <div class="row">
                <div class="col-md-6 ml-auto order-md-2 align-self-start">
                    <div class="site-block-cover-content">
                        <h2 class="sub-title">#New Summer Collection 2019</h2>
                        <h1>Arrivals Sales</h1>
                        <p><a href="#" class="btn btn-black rounded-0">Shop Now</a></p>
                    </div>
                </div>
                <div class="col-md-6 order-1 align-self-end">
                    <img src="<?= baseUrl('/assets/images/model_4.png') ?>" alt="Image" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
    <?= getBreadcrumbs(); ?>
    <div class="container">

        <div class="row mb-5">
            <div class="col-md-9 order-1">

                <div class="row align">
                    <div class="col-md-12 mb-5">
                        <div class="float-md-left"><h2 class="text-black h5">Shop All</h2></div>
                        <div class="d-flex">
                            <div class="dropdown mr-1 ml-md-auto">
                                <button type="button" class="btn btn-white btn-sm dropdown-toggle px-4" id="dropdownMenuOffset" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Latest
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuOffset">
                                    <a class="dropdown-item" href="#">Men</a>
                                    <a class="dropdown-item" href="#">Women</a>
                                    <a class="dropdown-item" href="#">Children</a>
                                </div>
                            </div>
                            <div class="btn-group">
                                <button type="button" class="btn btn-white btn-sm dropdown-toggle px-4" id="dropdownMenuReference" data-toggle="dropdown">Reference</button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuReference">
                                    <a class="dropdown-item" href="#">Relevance</a>
                                    <a class="dropdown-item" href="#">Name, A to Z</a>
                                    <a class="dropdown-item" href="#">Name, Z to A</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Price, low to high</a>
                                    <a class="dropdown-item" href="#">Price, high to low</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-5">

                    <?php foreach($products as $product) : ?>
                        <?= getSmallCards($product); ?>
                    <?php endforeach; ?>

                </div>

                <?= $pagination; ?>
            </div>

            <div class="col-md-3 order-2 mb-5 mb-md-0">
                <div class="border p-4 rounded mb-4">
                    <h3 class="mb-3 h6 text-uppercase text-black d-block">Categories</h3>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-1"><a href="<?= baseUrl('/shop') . getPropertyHref('Men'); ?>" class="d-flex"><span>Men</span> <span class="text-black ml-auto">(<?= countItems('good_catigories', 'Men') ?>)</span></a></li>
                        <li class="mb-1"><a href="#" class="d-flex"><span>Women</span> <span class="text-black ml-auto">(<?= countItems('good_catigories', 'Women') ?>)</span></a></li>
                        <li class="mb-1"><a href="#" class="d-flex"><span>Children</span> <span class="text-black ml-auto">(<?= countItems('good_catigories', 'Children') ?>)</span></a></li>
                    </ul>
                </div>

                <div class="border p-4 rounded mb-4">
                    <div class="mb-4">
                        <h3 class="mb-3 h6 text-uppercase text-black d-block">Filter by Price</h3>
                        <div id="slider-range" class="border-primary"></div>
                        <input type="text" name="text" id="amount" class="form-control border-0 pl-0 bg-white" disabled="" />
                    </div>

                    <div class="mb-4">
                        <h3 class="mb-3 h6 text-uppercase text-black d-block">Size</h3>
                        <label for="s_sm" class="d-flex">
                            <input type="checkbox" id="s_sm" class="mr-2 mt-1"> <span class="text-black">Small (<?= countItems('good_attributes', 'Small') ?>)</span>
                        </label>
                        <label for="s_md" class="d-flex">
                            <input type="checkbox" id="s_md" class="mr-2 mt-1"> <span class="text-black">Medium (<?= countItems('good_attributes', 'Medium') ?>)</span>
                        </label>
                        <label for="s_lg" class="d-flex">
                            <input type="checkbox" id="s_lg" class="mr-2 mt-1"> <span class="text-black">Large (<?= countItems('good_attributes', 'Large') ?>)</span>
                        </label>
                    </div>

                    <div class="mb-4">
                        <h3 class="mb-3 h6 text-uppercase text-black d-block">Color</h3>
                        <a href="#" class="d-flex color-item align-items-center" >
                            <span class="bg-danger color d-inline-block rounded-circle mr-2"></span> <span class="text-black">Red (<?= countItems('good_attributes', 'Red') ?>)</span>
                        </a>
                        <a href="#" class="d-flex color-item align-items-center" >
                            <span class="bg-success color d-inline-block rounded-circle mr-2"></span> <span class="text-black">Green (<?= countItems('good_attributes', 'Green') ?>)</span>
                        </a>
                        <a href="#" class="d-flex color-item align-items-center" >
                            <span class="bg-info color d-inline-block rounded-circle mr-2"></span> <span class="text-black">Blue (<?= countItems('good_attributes', 'Blue') ?>)</span>
                        </a>
                        <a href="#" class="d-flex color-item align-items-center" >
                            <span class="bg-primary color d-inline-block rounded-circle mr-2"></span> <span class="text-black">Purple (<?= countItems('good_attributes', 'Purple') ?>)</span>
                        </a>
                    </div>

                </div>
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
                    <a href="#" class="product-category">Women <span><?= countItems('good_catigories', 'Women') ?> <?= countItems('good_catigories', 'Women') > 1 ? 'items' : 'item' ?></span></a>
                    <img src="<?= baseUrl('/assets/images/model_4.png')?>" alt="Image" class="img-fluid">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="product-item sm-height bg-gray mb-4">
                    <a href="#" class="product-category">Men <span><?= countItems('good_catigories', 'Men') ?> <?= countItems('good_catigories', 'Men') > 1 ? 'items' : 'item' ?></span></a>
                    <img src="<?= baseUrl('/assets/images/model_5.png')?>" alt="Image" class="img-fluid">
                </div>

                <div class="product-item sm-height bg-gray">
                    <a href="#" class="product-category">Shoes <span><?= countItems('good_catigories', 'Shoes') ?> <?= countItems('good_catigories', 'Shoes') > 1 ? 'items' : 'item' ?></span></a>
                    <img src="<?= baseUrl('/assets/images/model_6.png')?>" alt="Image" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</div>