<?php
$servername = "localhost:3306";
$username = "root";
$password = "root@123";
$dbname = "techaroha";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $editPid = $_POST['editPid'];
    $editName = $_POST['editName'];
    $editDescription = $_POST['editDescription'];

    $sql = "UPDATE project SET PName='$editName', Pdescription='$editDescription' WHERE PID=$editPid";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>
