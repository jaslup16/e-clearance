<?php

function showDivision()
{
    $query = "SELECT * from Divisions";
    return database()->show($query);
}
function showOffice()
{
    $query = "SELECT * from Offices";
    return database()->show($query);
}

function showDean()
{
    $query = "SELECT  email, name, divisionName, login, userId from Deans
              inner join Users 
              on dean_user_id = userId 
              inner join Divisions
              on dean_division_id = divisionId";

    $assigned = showDivision();
    $info = database()->show($query);

    return [$assigned, $info];
}

function showStaff()
{
    $query = "SELECT  email, name,  officeName, login, userId from Staffs
              inner join Users 
              on staff_user_id = userId 
              inner join Offices
              on staff_office_id = officeId";
    $assigned = showOffice();
    $info =  database()->show($query);
    return [$assigned, $info];
}

function showStudent()
{
    if (isset($_GET["student-year-level-order"])) {
        if ($_GET["student-year-level-order"] == "ascending") {
            $query = "SELECT email, name, course, year, divisionName, login, userId, studentId from   Students
                            inner join Users
                            on student_user_id = userId
                            inner join Divisions
                            on student_division_id = divisionId
                            ORDER by year asc";

            $info = database()->show($query);
        }
        if ($_GET["student-year-level-order"] == "descending") {

            $query = "SELECT email, name, course, year, divisionName, login, userId, studentId from   Students
                            inner join Users
                            on student_user_id = userId
                            inner join Divisions
                            on student_division_id = divisionId
                            ORDER by year desc";
            $info = database()->show($query);
        }
    } elseif (isset($_GET["studentname-or-email"])) {
        $query = "SELECT email, name, course, year, divisionName, login, userId, studentId from   Students
                        inner join Users
                        on student_user_id = userId
                        inner join Divisions
                        on student_division_id = divisionId
                        where name LIKE ? or email LIKE ?";

        $info = database()->show($query, "ss", ["%" . $_GET["studentname-or-email"] . "%", "%" . $_GET["studentname-or-email"] . "%"]);
    } elseif (isset($_GET["division-name"])) {
        $query = "SELECT email, name, course, year, divisionName, login, userId, studentId from   Students
                            inner join Users
                            on student_user_id = userId
                            inner join Divisions
                            on student_division_id = divisionId
                            WHERE divisionName = ?";

        $info = database()->show($query, "s", [$_GET["division-name"]]);
    } else {
        $query = "SELECT email, name, course, year, divisionName, login, userId, studentId from   Students
                        inner join Users
                        on student_user_id = userId
                        inner join Divisions
                        on student_division_id = divisionId";

        $info = database()->show($query);
    }
    $assigned = showDivision();
    return [$assigned, $info];
}


function resolve($paths)
{

    if ($paths == "student") {
        return showStudent();
    }
    if ($paths == "dean") {
        return showDean();
    }
    if ($paths == "staff") {
        return showStaff();
    }
}
