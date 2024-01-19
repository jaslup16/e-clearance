<?php
$data = json_decode(file_get_contents("php://input"), true);

$office = $data["office"];
$query = "UPDATE Clearances set $office = ? where student_id = ?";
database()->update($query, "ii", [$data["value"], $data["studentId"]]);

http_response_code(200);
echo json_encode([
    'massage' => 'Successfuly Update Student'
]);
exit;
