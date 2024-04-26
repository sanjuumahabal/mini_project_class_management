<?php
// Start the session
session_start();

// Unset all of the session variables
$_SESSION = array();

// Destroy the session
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <title>Logging Out</title>
</head>
<body>
    <h1>Logging out...</h1>
    <script>
        // Redirect to the login page after a short delay
        setTimeout(function () {
            window.location.href = 'login.html';
        }, 2000); // Change the delay time as needed
    </script>
</body>
</html>
