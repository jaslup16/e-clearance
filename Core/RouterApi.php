<?php

namespace Core;

class RouterApi
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
                        if ($this->verify() !== $route["role"]) {
                            // $_SESSION["user"]["role"] = verify();
                            http_response_code(403);
                            echo json_encode(['error' => 'Warning! Forbidden']);
                            exit;
                        }
                    }
                }
                return require base_path("Http/api/" . $route["controller"]);
            }
        }
        $this->abort();
        // exit();
    }


    public function abort($code = 404)
    {
        http_response_code($code);
        echo json_encode(['error' => 'Page not found!']);
        die();
    }


    function verify()
    {


        $userId = validateToken();
        $verifyIfRegister = "SELECT * from Users where userId = ?";
        $verifyResult =  database()->show($verifyIfRegister, "i", [$userId]);
        if (count($verifyResult) == 0) {
            // http_response_code(401);
            // echo json_encode(['error' => 'Warning! Unauthorized']);
            // exit;
            return null;
        } else {
            $query = "SELECT level from Roles inner join Levels on level_id = levelId inner join Users on user_id = userId WHERE user_id = ?";
            $result =  database()->show($query, "i", [$userId]);
            $_SESSION["user"]["level"] = strtolower($result[0]["level"]);
            return $result[0]["level"];
        }
    }
}
