<?php
// include 'includes/session.php';

// if (isset($_POST['add'])) {
// 	$firstname = $_POST['firstname'];
// 	$lastname = $_POST['lastname'];
// 	$studentid = $_POST['studentid'];
// 	$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
// 	// $filename = $_FILES['photo']['name'];
// 	// if (!empty($filename)) {
// 	// 	move_uploaded_file($_FILES['photo']['tmp_name'], '../images/' . $filename);
// 	// }
// 	//generate voters id
// 	$set = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
// 	$voter = substr(str_shuffle($set), 0, 2);

// 	$sql = "INSERT INTO voters (voters_id, password, firstname, lastname, studentid) VALUES ('$voter', '$password', '$firstname', '$lastname', '$studentid')";
// 	if ($conn->query($sql)) {
// 		$_SESSION['success'] = 'Voter added successfully';
// 	} else {
// 		$_SESSION['error'] = $conn->error;
// 	}
// } else {
// 	$_SESSION['error'] = 'Fill up add form first';
// }

// header('location: voters.php');


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
