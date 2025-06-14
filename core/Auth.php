<?php

namespace PHPFramework;

class Auth
{
    public static function login(array $creds): bool
    {
        $password = $creds['password'];
        unset($creds['password']);
        $field = array_key_first($creds);
        $value = $creds[$field];
        $user = db()->findOne('users', $value, $field);
        $cart = db()->findOne('cart', $user['id'], 'user_id');

        if(!$user)
        {
            return false;
        }

        if(password_verify($password, $user['password']))
        {
            session()->set('user', ['id' => $user['id'], 'name' => $user['name'], 'email' => $user['email'], 'cart' => $cart['total']]);
            return true;
        }
        return false;
    }

    public static function user()
    {
        return session()->get('user');
    }

    public static function isAuth(): bool
    {
        return session()->has('user');
    }

    public static function logout(): void
    {
        session()->remove('user');
    }

    public static function setUser(): void
    {
        if($user_data = self::user())
        {
            $user = db()->findOne('users', $user_data['id']);
            if($user)
            {
                session()->set('user', ['id' => $user['id'], 'name' => $user['name'], 'email' => $user['email']]);
            }
        }
    }
}