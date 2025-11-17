<?php

/** Database credentials for XAMPP defaults */
const DB_HOST = 'localhost';
const DB_NAME = 'dhakar-chaka'; 
const DB_USER = 'root';
const DB_PASS = '';


try {
    // ? Data Source Name (DSN)
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
    
    // ? Create a new PDO instance, PDO is PHP Data Objects
    $pdo = new PDO($dsn, DB_USER, DB_PASS, [
        // ? Set error mode to Exception for better error handling
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        // ? Set default fetch mode to associative arrays, Associative arrays are arrays where the keys are the column names
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
    
    echo "Database connected successfully.\n";
    // ? Connection successful! The $pdo variable is ready to use.

} catch (PDOException $e) {
    // ! If connection fails, display an error and terminate
    die("Database connection failed: " . $e->getMessage());
}
?>