<?php

include("includes/conn.php");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['studentid'])) {
    $studentid = $_GET['studentid'];
    $stmt = $conn->prepare("SELECT COUNT(*) FROM voters WHERE student_id = ?");
    $stmt->bind_param("s", $studentid);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    $response = array('exists' => $count > 0);
    echo json_encode($response);
}

$conn->close();
