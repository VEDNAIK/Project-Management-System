<?php
// Assuming you have a database connection
$servername = "localhost:3306";
$username = "root";
$password = "root@123";
$dbname = "techaroha";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$pid = isset($_POST['pid']) ? $_POST['pid'] : '5';
$pname = isset($_POST['pname']) ? $_POST['pname'] : '';
$pdescription = isset($_POST['pdescription']) ? $_POST['pdescription'] : '';
$ptype = isset($_POST['ptype']) ? $_POST['ptype'] : '';

// Insert data into the database
$sql = "INSERT INTO project (PID, PName, Pdescription, Ptype) VALUES ('$pid', '$pname', '$pdescription', '$ptype')";

if ($conn->query($sql) === TRUE) {
    echo "Project added successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
