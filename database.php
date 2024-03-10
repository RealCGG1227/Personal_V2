<?php

$host = "localhost"; 
$username = "id21974797_cy_website"; 
$password = "Real_CGG2001"; 
$database = "id21974797_user_db"; 

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
