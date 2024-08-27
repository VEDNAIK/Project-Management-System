<!DOCTYPE html>
<html>
<head>
<style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 1rem;
            text-align: center;
        }

        section {
            margin: 20px;
        }

        .project-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .project-card {
            background-color: #fff;
            width: 300px; /* Set a fixed width for the project card */
            height: 200px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.2s;
        }

        .project-card:hover {
            transform: scale(1.05);
        }

        .project-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }

        .project-details {
            padding: 1rem;
        }

        .btn-container {
            display: flex;
            justify-content: flex-end; /* Align buttons to the right */
            margin-bottom: 20px;
        }

        .btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
            margin-left: 10px; /* Add margin between the buttons */
        }

        .btn-create {
            background-color: #3498db;
        }
    </style>
  <title>Form</title>
</head>
<body>
    <header>
        <h1>Project Management System</h1>
    </header>
    <section>
      <div>
  <form action="indexx.php" method="post">
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
    <input type="submit" value="Submit" onclick="validateForm()">
  </form>
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

// Initialize variables
$pid = $project_name = $project_description = $project_type = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data if available
    $pid = isset($_POST['pid']) ? intval($_POST['pid']) : 0;
    $project_name = isset($_POST['project_name']) ? $conn->real_escape_string($_POST['project_name']) : "";
    $project_description = isset($_POST['project_description']) ? $conn->real_escape_string($_POST['project_description']) : "";
    $project_type = isset($_POST['project_type']) ? $conn->real_escape_string($_POST['project_type']) : "";

    // Convert PID to integer
    $pid = intval($pid);

    // Insert the data into the database
    $sql = "INSERT INTO project (PID, PName, Pdescription, Ptype) VALUES ('$pid', '$project_name', '$project_description', '$project_type')";

    // Check if the query was successful
    if (@$conn->query($sql)) {
        echo "New record created successfully";
    } else {
        echo "Error creating record. Please try again later.";
        // Log the error for troubleshooting purposes (do not log sensitive data)
        error_log("SQL Error: " . $conn->error, 0);
    }
}

// Close the database connection
$conn->close();
?>

</div>
    </section>
</body>
</html>