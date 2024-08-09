<?php
include 'includes/session.php';

if (isset($_POST['edit'])) {
	$id = $_POST['id'];
	$fullname = $_POST['fullname'];
	$age = $_POST['age'];
	$position = $_POST['position'];
	$platform = $_POST['platform'];

	$sql = "UPDATE candidates SET fullname = '$fullname', age = '$age', position_id = '$position', platform = '$platform' WHERE id = '$id'";
	if ($conn->query($sql)) {
		$_SESSION['success'] = 'Candidate updated successfully';
	} else {
		$_SESSION['error'] = $conn->error;
	}
} else {
	$_SESSION['error'] = 'Fill up edit form first';
}

header('location: candidates.php');
