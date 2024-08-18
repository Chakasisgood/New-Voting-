<?php
include 'includes/conn.php'; // Include your database connection

header('Content-Type: application/json'); // Set the content type to JSON

$response = array('success' => false, 'voters' => array());

$sql = "SELECT course FROM voters"; // Adjust the query to your table and column names
$result = $conn->query($sql);

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $response['voters'][] = $row['course'];
    }
    $response['success'] = true;
} else {
    $response['message'] = 'Failed to fetch courses.';
}

$conn->close();
echo json_encode($response); // Return JSON response
