<?php

use Firebase\JWT\JWT;

$data = json_decode(file_get_contents("php://input"), true);

$query = "SELECT userId, email, password from Users
where email = ?";
$result = database()->show($query, "s", [$data["email"]]);



if (empty($result)) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid Credential']);
    return;
}
if ($result[0]["password"] !== $data["password"]) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid Credential']);
    return;
}

$query = "UPDATE Users set login = ? where userId = ?";
database()->update($query, "ii", [1, $result[0]["userId"]]);

$secretKey = "SECRET_KEY";
$tokenPayload = ['user_id' => $result[0]["userId"], 'mail' => $data["email"]];

$token = JWT::encode($tokenPayload, $secretKey, 'HS256');

http_response_code(200);
echo json_encode([
    'massage' => 'Successfuly login', 'token' => $token
]);
