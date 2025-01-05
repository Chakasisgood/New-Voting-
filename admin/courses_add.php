<?php
include 'includes/session.php';


if (isset($_POST['add'])) {
    $courses = $_POST['courses'];
    $sql = "SELECT * FROM courses";
    $query = $conn->query($sql);
    $row = $query->fetch_assoc();

    $priority = $row['priority'] + 1;;

    $sql = "INSERT INTO courses (course) VALUES ('$courses')";
    if ($conn->query($sql)) {
        $_SESSION['success'] = 'Courses added successfully';
    } else {
        $_SESSION['error'] = $conn->error;
    }
} else {
    $_SESSION['error'] = 'Fill up add form first';
}

header('location: courses.php');
