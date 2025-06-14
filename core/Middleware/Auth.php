<?php

namespace PHPFramework\Middleware;

class Auth
{

    public function handle(): void
    {
        if(!isAuth())
        {
            response()->redirect('/register');
        }
    }

}