<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= baseUrl('/assets/bootstrap/css/bootstrap.min.css'); ?>">
    <title>PHPFramework :: <?= $title ?? '';?></title>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-dark mb-3" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="<?= baseUrl('/'); ?>">Home</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" aria-current="page" href="<?= baseUrl('/register'); ?>">Register</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" aria-current="page" href="<?= baseUrl('/login'); ?>">Login</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" aria-current="page" href="<?= baseUrl('/dashboard'); ?>">Dashboard</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" aria-current="page" href="<?= baseUrl('/users'); ?>">Users list</a>
            </li>
        </ul>
        </div>
    </div>
    </nav>    

    <?php get_alerts(); ?>
    <?=$this->content;?>    

<script src="<?= baseUrl('/assets/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>