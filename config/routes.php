<?php

/** @var /PHPFramework/Application $app */

use App\Controllers\HomeController;
use App\Controllers\UserController;
use App\Controllers\ProductController;
use App\Controllers\CartController;

const MIDDLEWARE = [
    'auth' => \PHPFramework\Middleware\Auth::class,
    'cache' => \PHPFramework\Middleware\CachePage::class,
    'guest' => \PHPFramework\Middleware\Guest::class,
];

$app->router->get(str_replace('/', '', PATH), [HomeController::class,'getHomePage']);
$app->router->get('register', [UserController::class,'register'])->middleware(['guest']);
$app->router->post('register', [UserController::class,'store'])->middleware(['guest']);
$app->router->get('login', [UserController::class,'login'])->middleware(['guest']);
$app->router->post('login', [UserController::class,'auth'])->middleware(['guest']);
$app->router->get('dashboard', [HomeController::class, 'dashboard']);
$app->router->get('users', [UserController::class, 'index']);
$app->router->post('subscribe', [HomeController::class, 'subscribe']);
$app->router->get('cart', [CartController::class, 'cart'])->middleware(["auth"]);
$app->router->post('cart', [CartController::class, 'deleteFromCart'])->middleware(["auth"]);
$app->router->post('cart/coupon', [CartController::class, 'editTotalPrice'])->middleware(["auth"]);
$app->router->get('shop', [HomeController::class, 'shop']);
$app->router->get('logout', [UserController::class, 'logout'])->middleware(["auth"]);
$app->router->get("shop/product", [ProductController::class, 'product']);
$app->router->post('shop/product', [CartController::class, 'addToCart'])->middleware(['auth']);
$app->router->get('contact', [HomeController::class, 'contact']);
$app->router->get('checkout', [CartController::class, 'checkout'])->middleware(['auth']);
$app->router->post('contact', [HomeController::class, 'registerMessage']);

/* $app->router->get('/post/(?P<slug>[a-z0-9-]+)/?', function() {
    return '<p>Some post</p>';
});
*/
