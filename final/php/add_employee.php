<?php
include 'db.php';

// Handle form submission
if (isset($_POST['mysubmit'])) {
    $name = $_POST['full_name'];
    $gender = $_POST['gender'];
    $dob = $_POST['date_of_birth'];
    $role = $_POST['role'];
    $dept = $_POST['department'];
    $qual = $_POST['qualification'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $salary = $_POST['salary'];
    $joining = $_POST['joining_date'];

    // Prepared statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO employees 
        (full_name, gender, date_of_birth, role, department, qualification, phone, email, address, salary, joining_date) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssssss", $name, $gender, $dob, $role, $dept, $qual, $phone, $email, $address, $salary, $joining);

    if ($stmt->execute()) {
        $message = "New employee added successfully!";
    } else {
        $message = "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Employee</title>
</head>
<body>
<h2>Add New Employee</h2>

<?php if (isset($message)) echo "<p>$message</p>"; ?>

<form method="post">
    Full Name: <input type="text" name="full_name" required><br>
    Gender: 
    <select name="gender">
        <option value="Male">Male</option>
        <option value="Female">Female</option>
        <option value="Other">Other</option>
    </select><br>
    Date of Birth: <input type="date" name="date_of_birth" required><br>
    Role: <input type="text" name="role" required><br>
    Department: <input type="text" name="department" required><br>
    Qualification: <input type="text" name="qualification"><br>
    Phone: <input type="text" name="phone"><br>
    Email: <input type="email" name="email"><br>
    Address: <textarea name="address"></textarea><br>
    Salary: <input type="number" step="0.01" name="salary" required><br>
    Joining Date: <input type="date" name="joining_date" required><br>
    <button type="submit" name="mysubmit">Add Employee</button>
</form>

<p><a href="list_employees.php">View All Employees</a></p>
</body>
</html>
