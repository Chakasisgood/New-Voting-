<?php

include 'includes/conn.php'; // Include your database connection
header('Content-Type: application/json'); // Set the content type to JSON

$response = array('success' => false, 'message' => '');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $fullname = $_POST['fullname'];
    $course = $_POST['course'];
    $email = $_POST['email'];
    $studentid = $_POST['studentid'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if student ID already exists
    $stmt = $conn->prepare("SELECT COUNT(*) FROM voters WHERE studentid = ?");
    $stmt->bind_param("s", $studentid);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    if ($count > 0) {
        $response['message'] = 'Student ID already exists.';
    } else {
        // Insert new voter
        $stmt = $conn->prepare("INSERT INTO voters (password, fullname, course, email, studentid) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $password, $fullname, $course, $email, $studentid);

        if ($stmt->execute()) {
            $response['success'] = true;
        } else {
            $response['message'] = 'Error: ' . $stmt->error;
        }
        $stmt->close();
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Fetch ENUM values for the course column
    $tableName = 'voters'; // Table name
    $columnName = 'course'; // ENUM column name

    // Query the information schema to get ENUM values
    $sql = "SELECT COLUMN_TYPE 
            FROM INFORMATION_SCHEMA.COLUMNS 
            WHERE TABLE_NAME = '$tableName' 
            AND COLUMN_NAME = '$columnName'";

    $result = $conn->query($sql);

    if ($result && $row = $result->fetch_assoc()) {
        // Extract ENUM values from the COLUMN_TYPE
        $enumType = $row['COLUMN_TYPE'];
        preg_match('/^enum\((.*)\)$/i', $enumType, $matches);

        if (isset($matches[1])) {
            $enumValues = explode(',', $matches[1]);
            $enumValues = array_map(function ($value) {
                return trim($value, "'"); // Remove single quotes
            }, $enumValues);

            $response['courses'] = $enumValues;
            $response['success'] = true;
        } else {
            $response['message'] = 'Failed to parse ENUM values.';
        }
    } else {
        $response['message'] = 'Failed to fetch ENUM column details.';
    }
}

$conn->close();
echo json_encode($response); // Return JSON response