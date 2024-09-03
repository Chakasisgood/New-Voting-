<?php
include 'includes/session.php';
if (isset($_GET['return'])) {
	$return = $_GET['return'];
} else {
	$return = 'home.php';
}

if (isset($_POST['save'])) {
	$curr_password = $_POST['curr_password'];
	$fullname = $_POST['fullname'];
	$password = $_POST['password'];
	$course = $_POST['course'];
	$email = $_POST['email'];
	$studentid = $_POST['studentid'];

	if (password_verify($curr_password, $voter['password'])) {

		if ($password == $voter['password']) {
			$password = $voter['password'];
		} else {
			$password = password_hash($password, PASSWORD_DEFAULT);
		}

		$sql = "UPDATE voters SET password = '$password', fullname = '$fullname', course = '$course', email = '$email', studentid = '$studentid' WHERE id = '" . $voter['id'] . "'";
		if ($conn->query($sql)) {
			$_SESSION['success'] = 'Voters profile updated successfully';
		} else {
			$_SESSION['error'] = $conn->error;
		}
	} else {
		$_SESSION['error'] = 'Incorrect password';
	}
} else {
	$_SESSION['error'] = 'Fill up required details first';
}

header('location:' . $return);
