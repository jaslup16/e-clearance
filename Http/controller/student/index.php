<?php
$profileQuery = "SELECT studentId, name, course, year, divisionName from Students
             inner join Users
             on student_user_id = userId
             inner join Divisions
             on student_division_id = divisionId
             where student_user_id = ?";

$profile = database()->show($profileQuery, "i", [$_SESSION["user"]["_id"]]);

$statusQuery = "SELECT DSSC, LIRC, CIMS, LABORATORY, CSG, DEAN, CASHIER from Students 
                    inner join Clearances
                    on studentId = student_id
                    inner join Users
                    on student_user_id = userId
                    where student_user_id = ?";
$status = database()->show($statusQuery, "i", [$_SESSION["user"]["_id"]]);


view("student/index.view.php", [
    "profile" => $profile[0],
    "status" => $status[0],
]);
