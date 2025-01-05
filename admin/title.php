<?php
include 'includes/session.php';

if (isset($_POST['add'])) {
	$title = $_POST['title'];
	// var_dump($title);

	$sql = "INSERT INTO title (titles) VALUES ('$title')";

	if ($conn->query($sql)) {
		$_SESSION['success'] = 'Title added successfully';
	} else {
		$_SESSION['error'] = $conn->error;
	}
} else {
	$_SESSION['error'] = 'Fill up add form first';
}

header('location: candidates.php');
