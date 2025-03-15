<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

// Initialize students array in session if not already set
if (!isset($_SESSION['students'])) {
    $_SESSION['students'] = [];
}

// Function to add a student
function addStudent($name, $age, $grade) {
    $student = [
        'name' => $name,
        'age' => $age,
        'grade' => $grade
    ];
    $_SESSION['students'][] = $student;
}

// Function to delete a student
function deleteStudent($index) {
    if (isset($_SESSION['students'][$index])) {
        array_splice($_SESSION['students'], $index, 1);
    }
}

// Handle form actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    if ($action === 'add') {
        $name = $_POST['name'];
        $age = $_POST['age'];
        $grade = $_POST['grade'];
        addStudent($name, $age, $grade);

        // Redirect to the student list
        header("Location: manage_students.php?action=view");
        exit();
    } elseif ($action === 'edit') {
        $index = $_POST['index'];
        $name = $_POST['name'];
        $age = $_POST['age'];
        $grade = $_POST['grade'];

        // Update the student data in the session
        $_SESSION['students'][$index] = [
            'name' => $name,
            'age' => $age,
            'grade' => $grade
        ];

        // Debug: Print updated session data
        echo "<pre>";
        print_r($_SESSION['students']);
        echo "</pre>";

        // Redirect to the student list
        header("Location: manage_students.php?action=view");
        exit();
    }
}

// Handle GET actions (delete or view)
if (isset($_GET['action'])) {
    $action = $_GET['action'];

    if ($action === 'delete') {
        $index = $_GET['index'];
        deleteStudent($index);

        // Redirect to the student list after deletion
        header("Location: manage_students.php?action=view");
        exit();
    } elseif ($action === 'view') {
        // Display all students
        echo "<h1>Student List</h1>";
        echo "<table border='1'>";
        echo "<tr><th>Name</th><th>Age</th><th>Grade</th><th>Actions</th></tr>";
        foreach ($_SESSION['students'] as $index => $student) {
            echo "<tr>";
            echo "<td>{$student['name']}</td>";
            echo "<td>{$student['age']}</td>";
            echo "<td>{$student['grade']}</td>";
            echo "<td>
                    <a href='edit_student.php?index={$index}'>Edit</a> | 
                    <a href='manage_students.php?action=delete&index={$index}'>Delete</a>
                  </td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "<a href='index.html'>Back to Add Student</a>";
        exit();
    }
}
?>