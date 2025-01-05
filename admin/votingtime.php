<?php include "includes/conn.php"; ?>
<?php include "includes/header.php"; ?>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $countdown = $_POST['countdown'];

    // Insert countdown datetime into database
    $sql = "INSERT INTO countdown (countdown) VALUES ('$countdown')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>
    alert('Voting Countdown Save Successfully');
</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

header('location: candidates.php');
