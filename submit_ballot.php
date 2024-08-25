<?php
include 'includes/session.php';
include 'includes/slugify.php';

if (isset($_POST['vote'])) {
	$_SESSION['post'] = $_POST; // Store the posted data in the session
	$sql = "SELECT * FROM positions";
	$query = $conn->query($sql);
	$sql_array = array();
	$hasVotes = true;

	while ($row = $query->fetch_assoc()) {
		$position = slugify($row['description']);
		$pos_id = $row['id'];
		if (isset($_POST[$position])) {
			if ($row['max_vote'] > 1) {
				if (count($_POST[$position]) > $row['max_vote']) {
					$error = true;
					$_SESSION['error'][] = 'You can only choose ' . $row['max_vote'] . ' candidates for ' . $row['description'];
				} else {
					foreach ($_POST[$position] as $key => $values) {
						$sql_array[] = "INSERT INTO votes (voters_id, candidate_id, position_id) VALUES ('" . $voter['id'] . "', '$values', '$pos_id')";
					}
				}
			} else {
				$candidate = $_POST[$position];
				$sql_array[] = "INSERT INTO votes (voters_id, candidate_id, position_id) VALUES ('" . $voter['id'] . "', '$candidate', '$pos_id')";
			}
		}
	}
	// If no votes were cast, record a submission with 0 to indicate no candidates were chosen
	if ($hasVotes) {
		$sql_array[] = "INSERT INTO votes (voters_id, candidate_id, position_id) VALUES ('" . $voter['id'] . "', 0, 0)";
	}

	if (!$error) {
		foreach ($sql_array as $sql_row) {
			$conn->query($sql_row);
		}

		unset($_SESSION['post']);
		$_SESSION['success'] = 'Ballot Submitted';
	}
} else {
	$_SESSION['error'][] = 'Select candidates to vote first';
}

header('location: home.php');
