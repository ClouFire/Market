<?php

namespace PHPFramework;

use LDAP\Result;

class Router
{
    protected Request $request;
    protected Response $response;

    protected array $routes = [];
    protected array $route_params = [];

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;

    }

    public function add($path, $callback, $method): self
    {
        $path = trim($path,"/");

        if(is_array($method))
        {
            $method = array_map('strtoupper', $method);
        }
        else
        {
            $method = [strtoupper($method)];
        }

        $this->routes[] = 
        [
            'path'=> "/$path",
            'callback'=> $callback,
            'method'=> $method,
            'middleware' => null,
            'checkCsrfToken' => true,
        ];

        return $this;
    }

    public function getRoutes(): array
    {
        return $this->routes;
    }

    public function get($path, $callback): self
    {
        return $this->add($path, $callback, ["GET"]);
    }

    public function post($path, $callback): self
    {
        return $this->add($path, $callback, ["POST"]);
    }

    public function dispatch()
    {
        $path = $this->request->getPath();
        $route = $this->matchRoute($path);
        if(false === $route)
        {
            abort();
        }
        else
        {
            if(is_array($route['callback']))
            {
                $route['callback'][0] = new $route['callback'][0];
            }
            return call_user_func($route['callback']);

        }
    }

    protected function matchRoute($path): mixed
    {
        foreach($this->routes as $route)
        {
            if(preg_match("#^{$route['path']}$#", "/{$path}", $matches)
            &&
            in_array($this->request->getMethod(), $route["method"])
            )
            {

                if(request()->isPost())
                {
                    if($route['checkCsrfToken'] && !$this->checkCSRF())
                    {
                        if(request()->isAjax())
                        {
                            echo json_encode([
                                'status' => 'Error',
                                'data' => 'Security error',
                            ]);
                            die;
                        }
                        else
                        {
                            abort('Page expired', 419);
                        }
                    }
                }

                foreach($matches as $key => $match)
                {
                    if(is_string($key))
                    {
                        $this->route_params[$key] = $match;
                    }
                }
                return $route;
            }
        }
        return false;
    }

    public function checkCSRF()
    {
        return request()->post('csrf_token') && (session()->get('csrf_token') == request()->post('csrf_token'));
    }

    public function disableCsrfToken(): self
    {
        $this->routes[array_key_last($this->routes)]['checkCsrfToken'] = false;
        return $this;
    }
}

