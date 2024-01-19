<?php

function destroyUser($userId)
{
    try {
        $query = "DELETE FROM Users where userId = ?";
        database()->destroy($query, "i", [$userId]);
    } catch (Exception $e) {
        echo "\nException caught: " . $e->getMessage() . PHP_EOL;
    }
}

function store($post = [])
{
    if ($post["user"] == "student") {
        destroyUser($post["userId"]);
        $uri = $_SESSION["user"]["level"] . "?path=student";
        redirect("/$uri");
    }
    if ($post["user"] == "dean") {
        destroyUser($post["userId"]);
        $uri = $_SESSION["user"]["level"] . "?path=dean";
        redirect("/$uri");
    }
    if ($post["user"] == "staff") {
        destroyUser($post["userId"]);
        $uri = $_SESSION["user"]["level"] . "?path=staff";
        redirect("/$uri");
    }
}

if (isset($_POST))
    store($_POST);
