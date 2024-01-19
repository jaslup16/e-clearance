<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function dd($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";

    die();
}
function pre($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
}
function base_path($path)
{
    return BASE_PATH . $path;
}

function view($path, $attribute = [])
{
    extract($attribute);
    require base_path("views/" . $path);
}

function redirect($path)
{
    header("location: {$path}");
    exit();
}

function abort($code = 404)
{
    http_response_code($code);
    require base_path("views/{$code}.view.php");
    die();
}
function database()
{
    $config = require base_path("config.php");
    return new \Core\Database(...$config["database"]);
}

function validateToken()
{
    if (!isset($_SERVER['HTTP_AUTHORIZATION'])) {
        http_response_code(401);
        echo json_encode(['error' => 'Warning! Unauthorized']);
        exit;
    }
    try {
        $bearer = $_SERVER['HTTP_AUTHORIZATION'];
        list(, $token) = explode(" ", $bearer);
        $secretKey = "SECRET_KEY";

        // Decode and verify the JWT using the provided secret key
        $decoded = JWT::decode($token, new Key($secretKey, 'HS256'));
        // The token is valid; you can access the decoded claims in $decoded
        return $decoded->user_id;
    } catch (Exception $e) {
        // An error occurred, and the token is invalid
        return false;
    }
}

function verify()
{

    try {

        $userId = $_SESSION["user"]["_id"];
        $verifyIfRegister = "SELECT * from Users where userId = ?";
        $verifyResult =  database()->show($verifyIfRegister, "i", [$userId]);
        if (count($verifyResult) == 0) {
            $_SESSION = [];
            session_destroy();
            redirect("/login");
        } else {
            $query = "SELECT level from Roles inner join Levels on level_id = levelId inner join Users on user_id = userId WHERE user_id = ?";
            $result =  database()->show($query, "i", [$userId]);
            $_SESSION["user"]["level"] = strtolower($result[0]["level"]);
            return $result[0]["level"];
        }
    } catch (Exception $e) {
        echo "\nException caught: " . $e->getMessage() . PHP_EOL;
    }
}
