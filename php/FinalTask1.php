<?php
$marks = array(45, 70, 62, 30, 80);
echo "<h3>Student Marks:</h3>";
foreach ($marks as $mark) {
    echo $mark . "<br>";
}
$total = 0;
$max = $marks[0];
$min = $marks[0];
foreach ($marks as $mark) {
    $total += $mark;

    if ($mark > $max) {
        $max = $mark;
    }

    if ($mark < $min) {
        $min = $mark;
    }
}
$average = (float)$total / count($marks);
echo "<h3>Statistics:</h3>";
echo "Total: " . $total . "<br>";
echo "Average: " . $average . "<br>";
echo "Maximum: " . $max . "<br>";
echo "Minimum: " . $min . "<br>";
$pass = 0;
$fail = 0;
foreach ($marks as $mark) {
    if ($mark >= 50) {
        $pass++;
    } else {
        $fail++;
    }
}
echo "<h3>Result:</h3>";
echo "Passed Students: " . $pass . "<br>";
echo "Failed Students: " . $fail . "<br>";
$student = array(
    "name" => "Faysal Ahmed",
    "id" => "23-50529-1 ",
    "cgpa" => 3.00
);
echo "<h3>Student Details:</h3>";
foreach ($student as $key => $value) {
    echo $key . " : " . $value . "<br>";
}
function calculateAverage($arr) {
    $sum = array_sum($arr);
    return $sum / count($arr);
}
echo "<h3>Average using Function:</h3>";
echo calculateAverage($marks) . "<br>";
$name = $student["name"];
echo "<h3>String Operations:</h3>";
echo "Uppercase Name: " . strtoupper($name) . "<br>";
echo "Name Length: " . strlen($name) . "<br>";
sort($marks);
echo "<h3>Sorted Marks:</h3>";
foreach ($marks as $mark) {
    echo $mark . "<br>";
}
echo "<h3>Input from URL:</h3>";

if (isset($_GET['studentName'])) {
    $inputName = $_GET['studentName'];
    echo "Student Name from URL: " . $inputName;
} else {
    echo "No name provided ";
}
?>