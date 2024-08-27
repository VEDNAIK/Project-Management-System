<?php
// Connect to the database
$servername = "localhost:3306";
$username = "root";
$password = "root@123";
$dbname = "techaroha";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get the form data
$pid = $_POST['pid'];
$project_name = $_POST['project_name'];
$project_description = $_POST['project_description'];
$project_type = $_POST['project_type'];

// Convert PID to integer
$pid = intval($pid);

// Insert the data into the database
$sql = "INSERT INTO project (PID, PName, Pdescription, Ptype) VALUES ('$pid', '$project_name', '$project_description', '$project_type')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>