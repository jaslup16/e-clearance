<?php

function destroyUser($userId)
{
    try {
        $query = "DELETE FROM Users where userId = ?";
        database()->destroy($query, "i", [$userId]);
    } catch (Exception $e) {
        http_response_code(400);
        echo json_encode([
            'error' => 'Unable to remove user'
        ]);
        exit;
    }
}

function destroy($post = [])
{
    if ($post["user"] == "student") {
        destroyUser($post["userId"]);
        http_response_code(200);
        echo json_encode([
            'massage' => 'Successfuly Remove Student'
        ]);
        exit;
    }
    if ($post["user"] == "dean") {
        destroyUser($post["userId"]);
        http_response_code(200);
        echo json_encode([
            'massage' => 'Successfuly Remove Dean'
        ]);
        exit;
    }
    if ($post["user"] == "staff") {
        destroyUser($post["userId"]);
        http_response_code(200);
        echo json_encode([
            'massage' => 'Successfuly Remove Staff'
        ]);
        exit;
    }
}

$data = json_decode(file_get_contents("php://input"), true);

if ($data['userId'] == 1) {
    http_response_code(400);
    echo json_encode([
        'error' => 'Bad Request'
    ]);
    exit;
}
if (isset($data))
    destroy($data);
