<?php

function storeStudent($post)
{
    try {
        $userId  = addUser($post, 6);

        $studentQuery = "INSERT INTO Students (name, course, year, student_division_id, student_user_id) value (?, ?,?,?,?)";
        $studentId = database()->create($studentQuery, "ssiii", [$post["name"], $post["course"], $post["year"], $post["division"], $userId]);

        $clearanceQuery = "INSERT INTO Clearances (student_id) value (?)";
        database()->create($clearanceQuery, "i", [$studentId]);
    } catch (Exception $e) {
        http_response_code(400);
        echo json_encode([
            'error' => 'Duplicate Entries'
        ]);
        exit;
    }
}
function storeDean($post)
{
    try {
        $userId  = addUser($post, 4);

        $deanQuery = "INSERT INTO Deans (name, dean_division_id, dean_user_id) value (?,?,?)";
        database()->create($deanQuery, "sii", [$post["name"], $post["division"], $userId]);
    } catch (Exception $e) {
        http_response_code(400);
        echo json_encode([
            'error' => 'Duplicate Entries'
        ]);
        exit;
    }
}

function storeStaff($post)
{
    try {
        $userId  = addUser($post, 5);
        $staffQuery = "INSERT INTO Staffs (name, staff_office_id, staff_user_id) value (?,?,?)";
        database()->create($staffQuery, "sii", [$post["name"], $post["office"], $userId]);
    } catch (Exception $e) {
        http_response_code(400);
        echo json_encode([
            'error' => 'Duplicate Entries'
        ]);
        exit;
    }
}



function addUser($post, $level)
{
    $query = "INSERT INTO Users (email, password) value (?,?)";
    $userId = database()->create($query, "ss", [$post["email"], $post["password"]]);
    addRole($userId, $level);

    return $userId;
}
function addRole($userId, $level)
{
    $query = "INSERT INTO Roles (user_id, level_id) value(?,?)";
    database()->create($query, "ii", [$userId, $level]);
}



function store($post = [])
{
    if ($post["user"] == "student") {
        storeStudent($post);
        http_response_code(200);
        echo json_encode([
            'massage' => 'Successfuly Add Student'
        ]);
        exit;
    }
    if ($post["user"] == "dean") {
        storeDean($post);
        http_response_code(200);
        echo json_encode([
            'massage' => 'Successfuly Add Dean'
        ]);
        exit;
    }
    if ($post["user"] == "staff") {
        storeStaff($post);
        http_response_code(200);
        echo json_encode([
            'massage' => 'Successfuly Add Staff'
        ]);
        exit;
    }
}
