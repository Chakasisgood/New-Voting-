<?php

include 'includes/conn.php';

if (isset($_GET['studentid'])) {
    $studentid = $_GET['studentid'];

    // Prepare the SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT COUNT(*) FROM voters WHERE studentid = ?");
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("s", $studentid);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    // Return JSON response
    $response = array('exists' => $count > 0);
    echo json_encode($response);
} else {
    // Handle case where studentid is not set
    echo json_encode(array('error' => 'No student ID provided.'));
}

$conn->close();
