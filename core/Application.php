<?php

namespace PHPFramework;

use function PHPSTORM_META\type;

class Application
{

    protected string $uri;
    public Request $request;
    public Response $response;
    public Router $router;
    public View $view;
    public Session $session;
    public Database $db;
    public static Application $app;

    public function __construct()
    {
        self::$app = $this;
        $this->uri = $_SERVER['REQUEST_URI'];
        $this->request = new Request($this->uri);
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        $this->view = new View(LAYOUT);
        $this->session = new Session();
        $this->db = Database::getInstance();
        $this->writeCsrfToken();
    }

    public function run(): void
    {
        echo $this->router->dispatch();
    }

    public function writeCsrfToken(): void
    {
        if(!session()->has('csrf_token'))
        {
            session()->set('csrf_token', bin2hex(random_bytes(32)));
        }
    }

}