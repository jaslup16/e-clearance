<?php

require "showFunction.php";

$currentpath = "student";

$result = resolve("student");
if (isset($_GET["path"])) {
    $currentpath = $_GET["path"];
    $result = resolve($currentpath);
}

view("superadmin/index.view.php", [
    "current" => $currentpath,
    "assigned" => $result[0],
    "infos" => $result[1],
]);
