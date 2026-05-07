<?php

// Student data array
$student = array(
    "name" => "Numan Nur Helaly",
    "id" => "23-50633-1",
    "department" => "Computer Science & Engineering",
    "cgpa" => "3.85"
);

// Convert array to JSON
echo json_encode($student);

?>