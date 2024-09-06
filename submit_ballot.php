<?php
include 'includes/session.php';
include 'includes/slugify.php';

if (isset($_POST['vote'])) {
	$_SESSION['post'] = $_POST; // Store the posted data in the session
	$sql = "SELECT * FROM positions";
	$query = $conn->query($sql);
	$sql_array = array();
	$error = false; // Track if there are any errors
	$hasVotes = false; // Track if any valid votes are cast

	while ($row = $query->fetch_assoc()) {
		$position = slugify($row['description']);
		$pos_id = $row['id'];

		if (isset($_POST[$position])) {
			$hasVotes = true; // At least one vote has been cast

			if ($row['max_vote'] > 1) {
				if (count($_POST[$position]) > $row['max_vote']) {
					$error = true;
					$_SESSION['error'][] = 'You can only choose ' . $row['max_vote'] . ' candidates for ' . $row['description'];
				} else {
					// Insert votes for positions with multiple candidates
					foreach ($_POST[$position] as $key => $values) {
						$sql_array[] = "INSERT INTO votes (voters_id, candidate_id, position_id) VALUES ('" . $voter['id'] . "', '$values', '$pos_id')";
					}
				}
			} else {
				// Insert vote for positions with a single candidate
				$candidate = $_POST[$position];
				$sql_array[] = "INSERT INTO votes (voters_id, candidate_id, position_id) VALUES ('" . $voter['id'] . "', '$candidate', '$pos_id')";
			}
		}
	}

	// If no votes were cast, insert the 0 placeholder
	if (!$hasVotes) {
		$sql_array[] = "INSERT INTO votes (voters_id, candidate_id, position_id) VALUES ('" . $voter['id'] . "', 0, 0)";
	}

	// Process SQL insertions if no errors occurred
	if (!$error) {
		foreach ($sql_array as $sql_row) {
			$conn->query($sql_row);
		}

		unset($_SESSION['post']); // Clear session post data
		$_SESSION['success'] = 'Ballot Submitted';
	}
} else {
	$_SESSION['error'][] = 'Select candidates to vote first';
}

header('location: home.php');
