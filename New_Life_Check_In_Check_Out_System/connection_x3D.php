<?php
//Database parameters
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "NewLifeHomeTrustDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?> 
