<?php

require "storeFunction.php";

$data = json_decode(file_get_contents("php://input"), true);

store($data);
