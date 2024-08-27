<!DOCTYPE html>
<html>
<head>
  <title>Form</title>
</head>
<body>
  <form>
    <label for="pid">PID:</label>
    <input type="number" id="pid" name="pid" >
    <br>
    <label for="project_name">Project Name:</label>
    <input type="text" id="project_name" name="project_name" >
    <br>
    <label for="project_description">Project Description:</label>
    <textarea id="project_description" name="project_description" ></textarea>
    <br>
    <label for="project_type">Project Type:</label>
    <input type="text" id="project_type" name="project_type" >
    <br>
    <input type="submit" value="Submit" onclick="submit()">
  </form>

<script>
    function submit() {
    // Validate the form (you can add more validation if needed)
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
    // Submit the form
    
}

</script>
 
</body>
</html>