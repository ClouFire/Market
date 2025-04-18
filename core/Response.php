<?php

namespace PHPFramework;

class Response
{

    public function setResponseCode(int $code): void
    {
        http_response_code($code);
    }

    public function redirect($url = ''): void
    {
        if ($url) 
        {
            $redirect = '/api_project' . $url;       
        }
        else
        {
            $redirect = $_SERVER['HTTP_REFERER'] ?? '/api_project';
        }
        header("Location: $redirect");
        die();
    }
}