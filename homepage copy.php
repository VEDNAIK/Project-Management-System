<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Management</title>
    <link rel="stylesheet" href="style.css">
    
</head>
<body>

    <header>
        <h1>Project Management System</h1>
    </header>

    <section>

        <div class="search-bar">
            <input type="text" class="search-input" placeholder="Search Projects...">
        </div>

        <div class="btn-container">
            <a href="http://localhost:3002" class="btn btn-create">Create New Project</a>
            <a href="#" class="btn btn-edit">Edit Existing Project</a>
        </div>

        <div class="project-container">
            <!-- Sample Project Card -->
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

            // Fetch data from the 'project' table
            $sql = "SELECT PName, PDescription, PID FROM project";
            $result = $conn->query($sql);

            // Display project cards
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="project-card">
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
        </div>
    </section>

</body>
</html>
