<?php

// dd($_GET);
// QUERY PROFILE
$profileQuery = "SELECT deanId, name, divisionName, divisionId from Deans
                inner join Divisions
                on dean_division_id = divisionId
                where dean_user_id = ?";

$profile = database()->show($profileQuery, "i", [validateToken()]);


// QUERY STUDENT STATUS
$divisionId =  $profile[0]["divisionId"];

if (isset($_GET["student-year-level-order"])) {
    if ($_GET["student-year-level-order"] == "ascending") {
        $statusQuery = "SELECT dean, studentId, name, course, year, divisionName from Students 
                            inner join Clearances 
                            on studentId = student_id
                            inner join Divisions
                            on student_division_id = divisionId
                            where student_division_id = ?
                            ORDER by year asc";

        $status = database()->show($statusQuery, "i", [$divisionId]);
    }
    if ($_GET["student-year-level-order"] == "descending") {

        $statusQuery = "SELECT dean, studentId, name, course, year from Students 
                            inner join Clearances 
                            on studentId = student_id
                            inner join Divisions
                            on student_division_id = divisionId
                            where student_division_id = ?
                            ORDER by year desc";
        $status = database()->show($statusQuery, "i", [$divisionId]);
    }
} elseif (isset($_GET["studentname-or-email"])) {
    $statusQuery = "SELECT dean, studentId, name, course, year from Students 
                    inner join Users
                    on student_user_id = userId
                    inner join Clearances 
                    on studentId = student_id
                    inner join Divisions
                    on student_division_id = divisionId
                    where student_division_id = ? and name LIKE ? and email LIKE ?";

    $status = database()->show($statusQuery, "iss", [$divisionId, "%" . $_GET["studentname-or-email"] . "%",  "%" . $_GET["studentname-or-email"] . "%"]);
} elseif (isset($_GET["status"])) {
    $isApproved = 0;
    if ($_GET["status"] == "approved") $isApproved = 1;
    if ($_GET["status"] == "pending") $isApproved = 0;

    $statusQuery = "SELECT dean, studentId, name, course, year from Students 
                    inner join Clearances 
                    on studentId = student_id
                    inner join Divisions
                    on student_division_id = divisionId
                    where student_division_id = ? and DEAN  = ?";

    $status = database()->show($statusQuery, "ii", [$divisionId, $isApproved]);
} else {
    $statusQuery = "SELECT dean, studentId, name, course, year from Students 
                    inner join Clearances 
                    on studentId = student_id
                    inner join Divisions
                    on student_division_id = divisionId
                    where student_division_id = ?";
    $status = database()->show($statusQuery, "i", [$divisionId]);
}

// QUERY DIVISION
$divisionQuery = "SELECT * from Divisions";
$division = database()->show($divisionQuery);

http_response_code(200);
echo json_encode([
    "profile" => $profile[0],
    "division" => $division,
    "status" => $status,
    "count" => count($status),
]);
exit;
