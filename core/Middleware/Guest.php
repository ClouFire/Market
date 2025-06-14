<?php

namespace PHPFramework\Middleware;

class Guest
{
    public function handle(): void
    {
        if(isAuth()) response()->redirect('/');
    }
}