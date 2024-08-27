<?php
$servername = "localhost:3306";
$username = "root";
$password = "root@123";
$dbname = "techaroha";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = $_GET['query'];

$sql = "SELECT PID, PName, PDescription FROM project WHERE PName LIKE '%$query%'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="project-card" onclick="openProjectPage(' . $row['PID'] . ')">
                <div class="project-details">
                    <h6>' . $row['PID'] . '</h6>
                    <h3>' . $row['PName'] . '</h3>
                    <h4><p>' . $row['PDescription'] . '</p></h4>
                </div>
            </div>';
    }
} else {
    echo "No projects found.";
}

$conn->close();
?>
