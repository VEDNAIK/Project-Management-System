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
            <input type="text" class="search-input" placeholder="Search Projects..." oninput="searchProjects()">
        </div>

        <div class="btn-container">
            <a href="http://localhost:3002" class="btn btn-create">Create New Project</a>
        </div>

        <div class="project-container" id="projectContainer">
            <!-- Project cards will be dynamically added here -->
            <?php
            include 'fetch_all_projects.php';
            ?>
        </div>
    </section>

    <script>
        function searchProjects() {
            var searchInput = document.querySelector('.search-input').value;
            var projectContainer = document.getElementById('projectContainer');

            // Make an AJAX request to the search_projects.php script
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Update the project container with the search results
                    projectContainer.innerHTML = xhr.responseText;
                }
            };
            xhr.open('GET', 'search_projects.php?query=' + searchInput, true);
            xhr.send();
        }

        function openProjectPage(projectID) {
            window.location.href = 'project_details.php?pid=' + projectID;
        }
    </script>

</body>
</html>
