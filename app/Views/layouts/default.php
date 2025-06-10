<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700">
    <link rel="stylesheet" href="<?= baseUrl('/assets/fonts/icomoon/style.css') ?>">
    <link rel="stylesheet" href="<?= baseUrl('/assets/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= baseUrl('/assets/css/magnific-popup.css') ?>">
    <link rel="stylesheet" href="<?= baseUrl('/assets/css/jquery-ui.css') ?>">
    <link rel="stylesheet" href="<?= baseUrl('/assets/css/owl.carousel.min.css') ?>">
    <link rel="stylesheet" href="<?= baseUrl('/assets/css/owl.theme.default.min.css') ?>">
    <link rel="stylesheet" href="<?= baseUrl('/assets/css/aos.css') ?>">
    <link rel="stylesheet" href="<?= baseUrl('/assets/css/style.css') ?>">

    <title><?= $title ?? '';?></title>
</head>
<body>
     <?php if($page = cache()->get('menu')) : ?>
        <?= $page; ?>
    <?php else :?>
        <?= app()->get('menu'); ?>
    <?php endif ?>

    <?php get_alerts(); ?>
    <?=$this->content;?>

<script src="<?= baseUrl('/assets/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
</body>

<footer class="site-footer custom-border-top">
    <div class="container">
        <div class="row">
            <?php if($page = cache()->get('news')) : ?>
                <?= $page; ?>
            <?php else :?>
                <?= app()->get('news'); ?>
            <?php endif ?>
            <div class="col-lg-5 ml-auto mb-5 mb-lg-0">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="footer-heading mb-4">Quick Links</h3>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <ul class="list-unstyled">
                            <li><a href="#">Sell online</a></li>
                            <li><a href="#">Features</a></li>
                            <li><a href="#">Shopping cart</a></li>
                            <li><a href="#">Store builder</a></li>
                        </ul>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <ul class="list-unstyled">
                            <li><a href="#">Mobile commerce</a></li>
                            <li><a href="#">Dropshipping</a></li>
                            <li><a href="#">Website development</a></li>
                        </ul>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <ul class="list-unstyled">
                            <li><a href="#">Point of sale</a></li>
                            <li><a href="#">Hardware</a></li>
                            <li><a href="#">Software</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="block-5 mb-5">
                    <h3 class="footer-heading mb-4">Contact Info</h3>
                    <ul class="list-unstyled">
                        <li class="address">203 Fake St. Mountain View, San Francisco, California, USA</li>
                        <li class="phone"><a href="tel://23923929210">+2 392 3929 210</a></li>
                        <li class="email">emailaddress@domain.com</li>
                    </ul>
                </div>

                <div class="block-7">
                    <form action="<?= baseUrl('/subscribe')?>" method="post">
                        <?= getCsrfField(); ?>
                        <label for="email_subscribe" class="footer-heading">Subscribe</label>
                        <div class="form-group">
                            <input type="email" class="form-control py-4 <?= getValidationClass('email'); ?>" id="email_subscribe" required placeholder="Email" value="<?= old('email'); ?>">
                            <?= get_errors('email');?>
                            <input type="submit" class="btn btn-sm btn-primary" value="Send">
                        </div>
                    </form>
                    <?php
                    session()->remove('form_errors');
                    session()->remove('form_data');
                    ?>
                </div>
            </div>
        </div>
        <div class="row pt-5 mt-5 text-center">
            <div class="col-md-12">
                <p>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" class="text-primary">Colorlib</a>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                </p>
            </div>

        </div>
    </div>
</footer>

</html>