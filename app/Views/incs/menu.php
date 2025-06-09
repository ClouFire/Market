<div class="site-navbar bg-white py-2">

    <div class="search-wrap">
        <div class="container">
            <a href="#" class="search-close js-search-close"><span class="icon-close2"></span></a>
            <form action="#" method="post">
                <input type="text" class="form-control" placeholder="Search keyword and hit enter...">
            </form>
        </div>
    </div>

    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <div class="logo">
                <div class="site-logo">
                    <a href="<?= baseUrl('/'); ?>" class="js-logo-clone">ShopMax</a>
                </div>
            </div>
            <div class="main-nav d-none d-lg-block">
                <nav class="site-navigation text-right text-md-center" role="navigation">
                    <ul class="site-menu js-clone-nav d-none d-lg-block">
                        <li class="active">
                            <a href="<?= baseUrl('/'); ?>">Home</a>
                        </li>
                        <li>
                            <a href="<?= baseUrl('/shop')?>">Shop</a>
                        </li>
                        <li>
                            <a href="<?= baseUrl('/catalogue')?>">Catalogue</a>
                        </li>
                        <li>
                            <a href="<?= baseUrl('/new_arrivals')?>">New Arrivals</a>
                        </li>
                        <li>
                            <a href="<?= baseUrl('/contact')?>">Contact</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="icons">
                <a href="<?= baseUrl('/search'); ?>" class="icons-btn d-inline-block js-search-open"><span class="icon-search"></span></a>
                <a href="<?= baseUrl('/liked'); ?>" class="icons-btn d-inline-block"><span class="icon-heart-o"></span></a>
                <a href="<?= baseUrl('/cart'); ?>" class="icons-btn d-inline-block bag">
                    <span class="icon-shopping-bag"></span>
                    <span class="number">2</span>
<!--                    чуть выше (вместо 2) должен быть вывод числа покупок в корзине, можно через db()->countAll
                        или не отображать ничего, если count = 0
-->
                </a>
                <a href="#" class="site-menu-toggle js-menu-toggle ml-3 d-inline-block d-lg-none"><span class="icon-menu"></span></a>
            </div>
        </div>
    </div>
</div>