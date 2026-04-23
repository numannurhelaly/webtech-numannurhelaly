<?php
include 'db.php';

// Handle delete request
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM employees WHERE employee_id = $id");
}

// Fetch all employees
$result = $conn->query("SELECT * FROM employees ORDER BY employee_id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Employee List</title>
</head>
<body>
<h2>All Employees</h2>
<p><a href="add_employee.php">Add New Employee</a></p>

<table border="1" cellpadding="5" cellspacing="0">
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Gender</th>
    <th>DOB</th>
    <th>Role</th>
    <th>Department</th>
    <th>Salary</th>
    <th>Joining Date</th>
    <th>Actions</th>
</tr>

<?php while ($row = $result->fetch_assoc()): ?>
<tr>
    <td><?= $row['employee_id'] ?></td>
    <td><?= htmlspecialchars($row['full_name']) ?></td>
    <td><?= $row['gender'] ?></td>
    <td><?= $row['date_of_birth'] ?></td>
    <td><?= htmlspecialchars($row['role']) ?></td>
    <td><?= htmlspecialchars($row['department']) ?></td>
    <td><?= $row['salary'] ?></td>
    <td><?= $row['joining_date'] ?></td>
    <td>
        <a href="update_employee.php?id=<?= $row['employee_id'] ?>">Edit</a> |
        <a href="list_employees.php?delete=<?= $row['employee_id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
    </td>
</tr>
<?php endwhile; ?>
</table>
</body>
</html>
