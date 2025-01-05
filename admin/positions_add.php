<?php
include 'includes/session.php';

if (isset($_POST['add'])) {
	$description = $_POST['description'];
	$max_vote = $_POST['max_vote'];
	$applicable_for = $_POST['applicable_for']; // This field will indicate "all" or "course"

	// Determine course ID or assign ALL_STUDENTS
	if ($applicable_for === 'all') {
		$course = 'ALL_STUDENTS'; // Assign ALL_STUDENTS for all students
	} else {
		$course = $_POST['course']; // Use the selected course ID
	}

	// Get the next priority value
	$sql = "SELECT priority FROM positions ORDER BY priority DESC LIMIT 1";
	$query = $conn->query($sql);

	if ($query->num_rows > 0) {
		$row = $query->fetch_assoc();
		$priority = $row['priority'] + 1; // Increment the highest priority by 1
	} else {
		$priority = 1; // Default priority if no records exist
	}

	// Insert into the database
	$sql = "INSERT INTO positions (description, courses_id, max_vote, priority) VALUES (?, ?, ?, ?)";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("ssii", $description, $course, $max_vote, $priority);

	if ($stmt->execute()) {
		$_SESSION['success'] = 'Position added successfully';
	} else {
		$_SESSION['error'] = 'Database error: ' . $stmt->error;
	}

	$stmt->close();
} else {
	$_SESSION['error'] = 'Fill up the add form first.';
}

header('location: positions.php');
