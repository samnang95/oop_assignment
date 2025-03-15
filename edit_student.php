<?php
session_start();

if (!isset($_GET['index'])) {
    die("Invalid request.");
}

$index = $_GET['index'];
$student = $_SESSION['students'][$index];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
</head>
<body>
    <h1>Edit Student</h1>
    <form action="manage_students.php" method="post">
        <input type="hidden" name="action" value="edit">
        <input type="hidden" name="index" value="<?php echo $index; ?>">

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $student['name']; ?>" required><br><br>

        <label for="age">Age:</label>
        <input type="number" id="age" name="age" value="<?php echo $student['age']; ?>" required><br><br>

        <label for="grade">Grade:</label>
        <input type="text" id="grade" name="grade" value="<?php echo $student['grade']; ?>" required><br><br>

        <button type="submit">Update Student</button>
    </form>
    <a href="manage_students.php?action=view">Back to Student List</a>
</body>
</html>