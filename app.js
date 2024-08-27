const express = require('express');
const mysql = require('mysql');
const bodyParser = require('body-parser');
const fs = require('fs');

const app = express();
const port = 3002;

// Create a MySQL connection pool
const pool = mysql.createPool({
  host: 'localhost',
  user: 'root',
  password: 'root@123',
  database: 'techaroha',
  insecureAuth: true,
});

// Middleware to parse JSON and URL-encoded data
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: true }));

// Serve the HTML form
app.get('/', (req, res) => {
  res.sendFile(__dirname + '/index.html');
});

// Handle form submission
app.post('/submit', (req, res) => {
  const { pid, project_name, project_description, project_type } = req.body;

  // Acquire a connection from the pool
  pool.getConnection((err, connection) => {
    if (err) {
      console.error('Error getting MySQL connection:', err);
      res.status(500).send('Internal Server Error');
      return;
    }

    // Insert data into the database
    const sql = `INSERT INTO project (PID, PName, Pdescription, Ptype) VALUES (?, ?, ?, ?)`;
    connection.query(sql, [pid, project_name, project_description, project_type], (queryErr, results) => {
      connection.release(); // Release the connection back to the pool

      if (queryErr) {
        console.error('Error executing MySQL query:', queryErr);
        res.status(500).send('Internal Server Error');
        return;
      }

      // Create a folder with PID as the name
      const folderPath = `/Users/ved/Desktop/Techaroha/Database/${pid}`;

      fs.mkdir(folderPath, (mkdirErr) => {
        if (mkdirErr) {
          console.error('Error creating folder:', mkdirErr);
          res.status(500).send('Internal Server Error');
          return;
        }

        res.send('New record created successfully and folder created: ' + folderPath);
      });
    });
  });
});

// Start the server
app.listen(port, () => {
  console.log(`Server is running at http://localhost:${port}`);
});
