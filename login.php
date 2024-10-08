<?php
session_start();
include 'includes/conn.php';

if (isset($_POST['login'])) {
	$student_id = $_POST['voter'];
	$password = $_POST['password'];

	$sql = "SELECT * FROM voters WHERE studentid = '$student_id'";
	$query = $conn->query($sql);

	if ($query->num_rows < 1) {
		$_SESSION['error'] = 'Cannot find Voter with the Student ID';
	} else {
		$row = $query->fetch_assoc();
		if (password_verify($password, $row['password'])) {
			$_SESSION['voter'] = $row['id'];
			$_SESSION['courses'] = $row['course'];
		} else {
			$_SESSION['error'] = 'Incorrect Password';
		}
	}
} else {
	$_SESSION['error'] = 'Input voter credentials first';
}

header('location: user.php');
