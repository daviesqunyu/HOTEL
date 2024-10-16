<?php
include 'db.php';

if ($conn) {
    echo "Database connection successful!";
} else {
    echo "Error: " . mysqli_connect_error();
}
?>
