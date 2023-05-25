<?php
// Establish a connection to MySQL server
$servername = "localhost";
$username = "root";
$password = "";

$conn = mysqli_connect($servername, $username, $password);

// Check connection
if ($conn) {
echo "Done";
}

$sql = "CREATE DATABASE Record";
if (mysqli_query($conn, $sql)) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . mysqli_error($conn);
}

?>