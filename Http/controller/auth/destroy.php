<?php

$query = "UPDATE Users set login = ? where userId = ?";
database()->update($query, "ii", [0, $_SESSION["user"]["_id"]]);

$_SESSION = [];
session_destroy();

$params = session_get_cookie_params();
setcookie("PHPSESSID", "", time() - 3600, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);

redirect("/login");
