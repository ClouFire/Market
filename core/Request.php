<?php

namespace PHPFramework;

class Request
{

    public string $uri;

    public function __construct($uri)
    {

        $this->uri = trim(urldecode($uri), '/');

    }

    public function getMethod(): string
    {
        return strtoupper($_SERVER['REQUEST_METHOD']);
    }

    public function getPath(): string
    {
        return $this->removeQueryString();
    }

    protected function removeQueryString(): string
    {
        if($this->uri)
        {
            $params = explode('?', $this->uri);
            $params[0] = str_replace('api_project/', '', $params[0]);
            return trim($params[0], '/');
        }
        return "";
    }

    public function isGet(): bool
    {
        return $this->getMethod() == 'GET';
    }

    public function isPost(): bool
    {
        return $this->getMethod() == 'POST';
    }

    public function isAjax(): bool
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    }

    public function getData(): array
    {
        $data = [];
        $request_data = $this->isPost() ? $_POST : $_GET;
        foreach($request_data as $key => $value)
        {
            if(is_string($value))
            {
                $value = trim($value);
            }
            $data[$key] = $value;
        }     
        return $data;
    }

    public function post($data): bool 
    {
        if(isset($_POST[$data])) return $_POST[$data];
        return false;
    }

    public function get($data): bool 
    {
        if(isset($_GET[$data])) return $_GET[$data];
        return false;
    }
}