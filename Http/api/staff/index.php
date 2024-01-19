<?php

// dd($_GET);
// QUERY PROFILE
$profileQuery = "SELECT staffId, name, officeName, officeId from Staffs
                inner join Offices
                on staff_office_id = officeId
                where staff_user_id = ?";

$profile = database()->show($profileQuery, "i", [validateToken()]);

// QUERY STUDENT STATUS
$office =  $profile[0]["officeName"];


if (isset($_GET["division-name"])) {
    $statusQuery = "SELECT $office, studentId, name, course, year, divisionName from Students 
                      inner join Clearances 
                      on studentId = student_id
                      inner join Divisions
                      on student_division_id = divisionId
                      WHERE divisionName = ?";
    $status = database()->show($statusQuery, "s", [$_GET["division-name"]]);
} elseif (isset($_GET["student-year-level-order"])) {

    $orderBy = 'desc';
    if ($_GET["student-year-level-order"] == "ascending") {
        $statusQuery = "SELECT $office, studentId, name, course, year, divisionName from Students 
                            inner join Clearances 
                            on studentId = student_id
                            inner join Divisions
                            on student_division_id = divisionId
                            ORDER by year asc";

        $status = database()->show($statusQuery);
    }
    if ($_GET["student-year-level-order"] == "descending") {

        $statusQuery = "SELECT $office, studentId, name, course, year, divisionName from Students 
                            inner join Clearances 
                            on studentId = student_id
                            inner join Divisions
                            on student_division_id = divisionId
                            ORDER by year desc";
        $status = database()->show($statusQuery);
    }
} elseif (isset($_GET["studentname-or-email"])) {
    $statusQuery = "SELECT $office, studentId, name, course, year, divisionName from Students 
                    inner join Users
                    on student_user_id = userId
                    inner join Clearances 
                    on studentId = student_id
                    inner join Divisions
                    on student_division_id = divisionId
                    where name LIKE ? or email LIKE ?";

    $status = database()->show($statusQuery, "ss", ["%" . $_GET["studentname-or-email"] . "%", "%" . $_GET["studentname-or-email"] . "%"]);
} elseif (isset($_GET["status"])) {
    $isApproved = 0;
    if ($_GET["status"] == "approved") $isApproved = 1;
    if ($_GET["status"] == "pending") $isApproved = 0;

    $statusQuery = "SELECT $office, studentId, name, course, year, divisionName from Students 
                    inner join Clearances 
                    on studentId = student_id
                    inner join Divisions
                    on student_division_id = divisionId
                    where $office = ?";

    $status = database()->show($statusQuery, "i", [$isApproved]);
} else {
    $statusQuery = "SELECT $office, studentId, name, course, year, divisionName from Students 
                    inner join Clearances 
                    on studentId = student_id
                    inner join Divisions
                    on student_division_id = divisionId";
    $status = database()->show($statusQuery);
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
