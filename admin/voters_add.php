<?php
include 'includes/session.php';

if (isset($_POST['add'])) {
	$fullname = $_POST['fullname'];
	$course = $_POST['course'];
	$email = $_POST['email'];
	$studentid = $_POST['studentid'];
	$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

	$sql = "INSERT INTO voters (password, fullname, course,  email, studentid) VALUES ('$password', '$fullname', '$course', '$email', '$studentid')";
	if ($conn->query($sql)) {
		$_SESSION['success'] = 'Candidate added successfully';
	} else {
		$_SESSION['error'] = $conn->error;
	}
} else {
	$_SESSION['error'] = 'Fill up add form first';
}
	
header('location: voters.php');
