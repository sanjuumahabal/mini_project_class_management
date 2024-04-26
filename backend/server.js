const express = require('express');
const bodyParser = require('body-parser');
const mysql = require('mysql');

const app = express();
const port = 3000;

const router = require('./router');
// // Middleware for parsing JSON bodies
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: true }));

// Create a MySQL connection pool
const connection = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: 'Niru@1234',
    database: 'Miniproject1'
});


app.use('route', router);
// Route to handle login requests
app.get('/login', (req, res) => {
    res.render('login')

    //     // Check if username and password are provided
    //     if (!username || !password) {
    //         return res.status(400).json({ error: 'Username and password are required' });
    //     }

    //     // Query the database to verify credentials
    //     pool.query('SELECT * FROM login_user WHERE username = ? AND password = ?', [username, password], (error, results, fields) => {
    //         if (error) {
    //             console.error('Error querying database:', error);
    //             return res.status(500).json({ error: 'Internal server error' });
    //         }

    //         // Check if the user exists and credentials are correct
    //         if (results.length > 0) {
    //             // User authenticated successfully
    //             return res.json({ message: 'Login successful' });
    //         } else {
    //             // User not found or credentials are incorrect
    //             return res.status(401).json({ error: 'Invalid username or password' });
    //         }
    //     });
    // 
});

// Start the server
app.listen(port, () => {
    console.log(`Server is running on http://localhost:${port}`);
});


