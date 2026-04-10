<?php
// Set correct timezone for the error logs
date_default_timezone_set('Europe/London');

// 1. Turn off error printing on the screen (Client-Side)
ini_set('display_errors', 0);

// 2. Turn on error logging (Server-Side)
ini_set('log_errors', 1);
// Ensure this path is writable by your server. 
// For XAMPP, this will save 'php_errors.log' inside the include folder.
ini_set('error_log', __DIR__ . '/php_errors.log');

// 3. Tell MySQLi to throw Exceptions instead of silent warnings or errors
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// 4. Set a Global Exception Handler
set_exception_handler(function ($e) {
    // Log the actual secure error message to our file behind the scenes
    error_log("Uncaught Exception: " . $e->getMessage() . " in " . $e->getFile() . " on line " . $e->getLine());

    // Redirect the user to our friendly error page
    $scriptName = $_SERVER['SCRIPT_NAME'];
    if (strpos($scriptName, '/include/') !== false) {
        header("Location: ../error.php");
    } else {
        header("Location: error.php");
    }
    exit();
});

// Database Credentials
$servername = "localhost";
$username = "root";
$password = "";
$database = "CultureConnect";

// 5. Connect to the Database
// Since mysqli_report is set to STRICT, if this fails, it will 
// throw an exception and automatically trigger our set_exception_handler above!
$connection = new mysqli($servername, $username, $password, $database);
?>