<?php

$host = "localhost";

$user = "root";

$password = "";

$databasename = "votesystem";

$con = mysqli_connect($host, $user, $password, $databasename);

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";


//set random name for the image, used time() for uniqueness

$filename =  time() . '.jpg';
$filepath = 'cam/';
if (!is_dir($filepath))
	mkdir($filepath);
if (isset($_FILES['webcam'])) {
	move_uploaded_file($_FILES['webcam']['tmp_name'], $filepath . $filename);
	$sql = "INSERT INTO tb_image(camera_upload) values('$filename')";
	$result = mysqli_query($con, $sql);
	echo $filepath . $filename;
}
