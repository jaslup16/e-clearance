<?php
session_start();
clearstatcache();

const BASE_PATH = __DIR__ . "/../";
require BASE_PATH . "Core/function.php";
require BASE_PATH . "vendor/autoload.php";

spl_autoload_register(function ($class) {
    $result = str_replace("\\", "/", $class);
    require base_path("{$result}.php");
});

$routerController = new \Core\RouterController();
$routerApi = new \Core\RouterApi();

require base_path("routes.php");
$uri = parse_url($_SERVER["REQUEST_URI"])["path"];
$method = $_POST["_method"] ?? $_SERVER["REQUEST_METHOD"];

// Check if the URI contains "/api/"
if (strpos($uri, '/api/') !== false) {
    // Set headers to allow cross-origin resource sharing (CORS)
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    $routerApi->route($uri, $method);
} else {
    // Handle regular non-API requests
    $routerController->route($uri, $method);
}
