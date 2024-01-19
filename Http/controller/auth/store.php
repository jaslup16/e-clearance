<?php
$query = "SELECT userId, email, password from Users
where email = ?";
$result = database()->show($query, "s", [$_POST["email"]]);

if (empty($result)) {
    $_SESSION["_flushed"]["login"]["email"] = $_POST["email"];
    $_SESSION["_flushed"]["login"]["error"] = "Invalid Credential";
    return redirect("/login");
}
if ($result[0]["password"] !== $_POST["password"]) {
    $_SESSION["_flushed"]["login"]["email"] = $_POST["email"];
    $_SESSION["_flushed"]["login"]["error"] = "Invalid Credential";
    return redirect("/login");
}

$query = "UPDATE Users set login = ? where userId = ?";
database()->update($query, "ii", [1, $result[0]["userId"]]);

$_SESSION["user"]["_id"] = $result[0]["userId"];
$uri = strtolower(verify());

redirect("/{$uri}");
