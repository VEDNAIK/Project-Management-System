<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Details</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f2f2f2;
            color: #333;
            margin: 20px;
            padding: 20px;
        }

        h1 {
            color: #4285f4;
            font-size: 2.5em;
            margin-bottom: 20px;
        }

        .project-info {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        p {
            font-size: 1.2em;
            margin-bottom: 10px;
        }

        strong {
            color: #4285f4;
        }

        a {
            color: #0d6efd;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        li {
            margin-bottom: 5px;
        }

        .upload-btn-wrapper {
            position: relative;
            overflow: hidden;
            display: inline-block;
        }

        .btn {
            border: 2px solid gray;
            color: gray;
            background-color: white;
            padding: 8px 20px;
            border-radius: 8px;
            font-size: 1.2em;
            font-weight: bold;
        }

        .upload-btn-wrapper input[type=file] {
            font-size: 100px;
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
        }

        .edit-btn {
            background-color: #4caf50;
            color: white;
            padding: 8px 20px;
            border-radius: 8px;
            font-size: 1.2em;
            font-weight: bold;
            margin-right: 10px;
            cursor: pointer;
        }

        .edit-form {
            display: none;
            max-width: 400px;
            margin-top: 20px;
        }

    </style>
</head>
<body>

    <?php
    $pid = isset($_GET['pid']) ? $_GET['pid'] : null;

    if (!$pid) {
        echo "Invalid project ID";
        exit;
    }

    $servername = "localhost:3306";
    $username = "root";
    $password = "root@123";
    $dbname = "techaroha";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM project WHERE PID = $pid";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $projectName = $row['PName'];
        $projectDescription = $row['Pdescription'];
        $projectid = $row['PID'];
        $projectType = $row['Ptype'];
        // Add more fields as needed

        // Display project details
        echo "<div class='project-info'>";
        echo "<h1>Project Details</h1>";
        echo "<p><strong>Project ID:</strong> $projectid</p>";
        echo "<p><strong>Project Name:</strong> $projectName</p>";
        echo "<p><strong>Description:</strong> $projectDescription</p>";
        echo "<p><strong>Type:</strong> $projectType</p>";

        // Display files from the folder
        $folderPath = "/Users/ved/Desktop/Techaroha/Database/$pid";
        if (file_exists($folderPath)) {
            $files = scandir($folderPath);
            if (count($files) > 2) {
                echo "<p><strong>Files:</strong></p>";
                echo "<ul>";
                foreach ($files as $file) {
                    if ($file !== "." && $file !== ".." && $file !== ".DS_Store") {
                        $filePath = $folderPath . "/" . $file;
                        echo "<li><a href='download.php?file=$filePath' download>$file</a></li>";
                    }
                }
                echo "</ul>";
            } else {
                echo "<p>No files found for this project.</p>";
            }
        } else {
            echo "<p>No files found for this project.</p>";
        }

        // File upload form
        echo "<div class='upload-btn-wrapper'>";
        echo "<button class='btn'>Upload a File</button>";
        echo "<form action='upload.php' method='post' enctype='multipart/form-data'>";
        echo "<input type='file' name='file' onchange='this.form.submit()'>";
        echo "<input type='hidden' name='pid' value='$pid'>";
        echo "</form>";
        echo "</div>";

        echo "</div>";
    } else {
        echo "Project not found.";
    }

    $conn->close();
    echo "<button class='edit-btn' onclick='openEditForm()'>Edit Project</button>";

    echo "<div class='edit-form'>";
    echo "<h2>Edit Project</h2>";
    echo "<form action='edit_project.php' method='post'>";
    echo "<label for='editName'>Project Name:</label>";
    echo "<input type='text' id='editName' name='editName' value='$projectName'><br>";
    echo "<br>";
    echo "<br>";
    echo "<label for='editDescription'>Description:</label>";
    echo "<textarea id='editDescription' name='editDescription'>$projectDescription</textarea><br>";
    echo "<input type='hidden' name='editPid' value='$projectid'>";
    echo "<br>";
    echo "<input type='submit' value='Save'>";
    echo "</form>";
    echo "</div>";

    ?>

    <script>
        function openEditForm() {
            var editForm = document.querySelector('.edit-form');
            editForm.style.display = 'block';
        }
    </script>

</body>
</html>
