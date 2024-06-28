<?php

class App {
    protected $controller = 'Home';
    protected $method = 'index';
    protected $params = [];

    public function __construct() {
        $url = $this->parseUrl();

        // Check for specific routes first
        $this->handleSpecificRoutes($url);

        // Default controller and method if specific routes are not matched
        if (file_exists('app/controllers/' . ucfirst($url[0]) . '.php')) {
            $this->controller = ucfirst($url[0]);
            unset($url[0]);
        }

        require_once 'app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        $this->params = $url ? array_values($url) : [];

        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseUrl() {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }

    private function handleSpecificRoutes($url) {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        switch ($uri) {
            case '/login':
                $this->controller = 'Login';
                $this->method = 'index';
                break;
            case '/login/authenticate':
                $this->controller = 'Login';
                $this->method = 'authenticate';
                break;
            case '/register':
                $this->controller = 'register';
                $this->method = 'index';
                break;
            case '/register/create':
                $this->controller = 'register';
                $this->method = 'create';
                break;
            case '/home':
                $this->controller = 'Home';
                $this->method = 'index';
                break;
            case '/notes':
                $this->controller = 'Notes';
                $this->method = 'index';
                break;
            case '/notes/create':
                $this->controller = 'Notes';
                $this->method = 'create';
                break;
            case (preg_match('/\/notes\/edit\/\d+/', $uri) ? true : false):
                $this->controller = 'Notes';
                $this->method = 'edit';
                $this->params = [(int) substr($uri, strrpos($uri, '/') + 1)];
                break;
            case (preg_match('/\/notes\/delete\/\d+/', $uri) ? true : false):
                $this->controller = 'Notes';
                $this->method = 'delete';
                $this->params = [(int) substr($uri, strrpos($uri, '/') + 1)];
                break;
            default:
                $this->controller = 'Login';
                $this->method = 'index';
                break;
        }

        // Require and initialize the controller
        $controllerPath = 'app/controllers/' . ucfirst($this->controller) . '.php';
        if (file_exists($controllerPath)) {
            require_once $controllerPath;
            $this->controller = new $this->controller;
        } else {
            throw new Exception("Controller file $controllerPath not found");
        }

        // Clear $url to prevent further processing
        $url = [];
    }
}