<?php

require "showFunction.php";

$currentpath = "student";

$result = resolve("student");
if (isset($_GET["path"])) {
    $currentpath = $_GET["path"];
    $result = resolve($currentpath);
}

http_response_code(200);
echo json_encode([
    "current" => $currentpath,
    "assigned" => $result[0],
    "infos" => $result[1],
]);
exit;
