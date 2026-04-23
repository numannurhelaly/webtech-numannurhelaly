<?php

// ---------- Indexed Array ----------

$marks = [65, 45, 80, 55, 30];

// ---------- Display using foreach ----------

echo "<h3>Student Marks:</h3>";

foreach ($marks as $m) {

    echo $m . " ";

}

// ---------- Function to calculate average ----------

function calculateAverage($arr) {

    $total = array_sum($arr);

    $count = count($arr);

    return $total / $count;

}

// ---------- Total, Average, Max, Min ----------

$total = array_sum($marks);

$average = calculateAverage($marks);

$max = max($marks);

$min = min($marks);

// Type casting example

$average = (float)$average;

echo "<br><br>Total Marks: " . $total;

echo "<br>Average Marks: " . $average;

echo "<br>Maximum Marks: " . $max;

echo "<br>Minimum Marks: " . $min;

// ---------- Pass / Fail Count ----------

$pass = 0;

$fail = 0;

foreach ($marks as $m) {

    if ($m >= 50) {

        $pass++;

    } else {

        $fail++;

    }

}

echo "<br><br>Passed Students: " . $pass;

echo "<br>Failed Students: " . $fail;

// ---------- Associative Array ----------

$student = [

    "name" => "Asif",

    "id" => "CSE123",

    "cgpa" => 3.75

];

echo "<br><br><h3>Student Details:</h3>";

foreach ($student as $key => $value) {

    echo $key . " : " . $value . "<br>";

}

// ---------- String Operations ----------

$name = $student["name"];

echo "<br>Uppercase Name: " . strtoupper($name);

echo "<br>Name Length: " . strlen($name);

// ---------- Built-in Array Function ----------

sort($marks);

echo "<br><br>Sorted Marks: ";

foreach ($marks as $m) {

    echo $m . " ";

}

// ---------- Superglobal ($_GET) ----------

if (isset($_GET['username'])) {

    $user = $_GET['username'];

    echo "<br><br>Input Name from URL: " . $user;

} else {

    echo"<br><br>No input name provided.";

}

?>
 