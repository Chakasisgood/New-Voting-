<?php
include 'includes/session.php';

if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $courses = $_POST['courses'];

    $sql = "UPDATE courses SET course = '$courses' WHERE id = '$id'";
    if ($conn->query($sql)) {
        $_SESSION['success'] = 'Courses updated successfully';
    } else {
        $_SESSION['error'] = $conn->error;
    }
} else {
    $_SESSION['error'] = 'Fill up edit form first';
}

header('location: courses.php');
