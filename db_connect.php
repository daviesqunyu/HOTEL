<?php
$host = 'localhost';
$dbname = 'hotel_db'; // Updated database name
$username = 'root';
$password = ''; // Enter your database password

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
