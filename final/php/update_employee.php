<?php
include 'db.php';

if (!isset($_GET['id'])) {
    die("No employee ID provided.");
}

$id = intval($_GET['id']);
$msg = "";

// Fetch existing data
$res = $conn->query("SELECT * FROM employees WHERE employee_id = $id");
if ($res->num_rows == 0) die("Employee not found.");
$employee = $res->fetch_assoc();

// Handle update form
if (isset($_POST['update'])) {
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

    $stmt = $conn->prepare("UPDATE employees SET full_name=?, gender=?, date_of_birth=?, role=?, department=?, qualification=?, phone=?, email=?, address=?, salary=?, joining_date=? WHERE employee_id=?");
    $stmt->bind_param("sssssssssdsi", $name, $gender, $dob, $role, $dept, $qual, $phone, $email, $address, $salary, $joining, $id);
    if ($stmt->execute()) $msg = "Updated successfully!";
    else $msg = "Error: " . $stmt->error;
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Employee</title>
</head>
<body>
<h2>Update Employee</h2>
<?php if($msg) echo "<p>$msg</p>"; ?>

<form method="post">
    Full Name: <input type="text" name="full_name" value="<?= htmlspecialchars($employee['full_name']) ?>" required><br>
    Gender:
    <select name="gender">
        <option value="Male" <?= $employee['gender']=='Male'?'selected':'' ?>>Male</option>
        <option value="Female" <?= $employee['gender']=='Female'?'selected':'' ?>>Female</option>
        <option value="Other" <?= $employee['gender']=='Other'?'selected':'' ?>>Other</option>
    </select><br>
    Date of Birth: <input type="date" name="date_of_birth" value="<?= $employee['date_of_birth'] ?>" required><br>
    Role: <input type="text" name="role" value="<?= htmlspecialchars($employee['role']) ?>" required><br>
    Department: <input type="text" name="department" value="<?= htmlspecialchars($employee['department']) ?>" required><br>
    Qualification: <input type="text" name="qualification" value="<?= htmlspecialchars($employee['qualification']) ?>"><br>
    Phone: <input type="text" name="phone" value="<?= $employee['phone'] ?>"><br>
    Email: <input type="email" name="email" value="<?= $employee['email'] ?>"><br>
    Address: <textarea name="address"><?= htmlspecialchars($employee['address']) ?></textarea><br>
    Salary: <input type="number" step="0.01" name="salary" value="<?= $employee['salary'] ?>" required><br>
    Joining Date: <input type="date" name="joining_date" value="<?= $employee['joining_date'] ?>" required><br>
    <button type="submit" name="update">Update</button>
</form>

<p><a href="list_employees.php">Back to Employee List</a></p>
</body>
</html>
