<?php

namespace Core;

class RouterController
{

    protected $routes = [];

    public function add($method, $uri, $controller)
    {
        $this->routes[] = [
            "uri" => $uri,
            "controller" => $controller,
            "method" => $method,
            "middleware" => null,
            "role" => null
        ];
        return $this;
    }
    public function get($uri, $controller)
    {
        return $this->add("GET", $uri, $controller);
    }

    public function post($uri, $controller)
    {
        return $this->add("POST", $uri, $controller);
    }

    public function delete($uri, $controller)
    {
        return $this->add("DELETE", $uri, $controller);
    }

    public function patch($uri, $controller)
    {
        return $this->add("PATCH", $uri, $controller);
    }

    public function put($uri, $controller)
    {
        return $this->add("PUT", $uri, $controller);
    }

    public function only($key)
    {
        $this->routes[array_key_last($this->routes)]["middleware"] = $key;
        return $this;
    }
    public function role($key)
    {
        $this->routes[array_key_last($this->routes)]["role"] = $key;
        return $this;
    }

    public function route($uri, $method)
    {
        foreach ($this->routes as $route) {
            if ($route["uri"] === $uri && $route["method"] === strtoupper($method)) {
                if ($route["middleware"]) {
                    if ($route["role"]) {
                        if (verify() == $route["role"]) {
                            $_SESSION["user"]["role"] = verify();
                        } else {
                            redirect("/login");
                        }
                    }
                }

                return require base_path("Http/controller/" . $route["controller"]);
            }
        }
        $this->abort();
        // exit();
    }
    public function abort($code = 404)
    {
        http_response_code($code);
        require base_path("views/{$code}.view.php");
        die();
    }
}
