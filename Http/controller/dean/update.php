<?php

$office = $_POST["office"];
$query = "UPDATE Clearances set $office = ? where student_id = ?";
database()->update($query, "ii", [$_POST["value"], $_POST["studentId"]]);

redirect("/staff");
