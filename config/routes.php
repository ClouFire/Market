<?php

/** @var /PHPFramework/Application $app */

use App\Controllers\HomeController;
use App\Controllers\UserController;
use App\Models\User;

const MIDDLEWARE = [
    'auth' => \PHPFramework\Middleware\Auth::class,
];

$app->router->get(str_replace('/', '', PATH), [HomeController::class,'getHomePage']);
$app->router->get('register', [UserController::class,'register']);
$app->router->post('register', [UserController::class,'store']);
$app->router->get('login', [UserController::class,'login']);
$app->router->get('dashboard', [HomeController::class, 'dashboard'])->middleware(['auth']);
$app->router->get('users', [UserController::class, 'index']);

/* $app->router->get('/post/(?P<slug>[a-z0-9-]+)/?', function() {
    return '<p>Some post</p>';
});
*/
