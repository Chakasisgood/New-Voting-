<?php
include 'includes/session.php';

if (isset($_POST['edit'])) {
	$id = $_POST['id'];
	$description = $_POST['description'];
	$course = $_POST['course'];
	$max_vote = $_POST['max_vote'];

	$sql = "UPDATE positions SET description = '$description', courses_id = '$course', max_vote = '$max_vote' WHERE id = '$id'";
	if ($conn->query($sql)) {
		$_SESSION['success'] = 'Position updated successfully';
	} else {
		$_SESSION['error'] = $conn->error;
	}
} else {
	$_SESSION['error'] = 'Fill up edit form first';
}

header('location: positions.php');
