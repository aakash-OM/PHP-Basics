<?php
// Establish a connection to MySQL server
$servername = "localhost";
$username = "root";
$password = "";
//$dbname = "Record";
$conn = mysqli_connect($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Task 1: Create Database and table

$sql = "CREATE DATABASE Record";
if (mysqli_query($conn, $sql)) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . mysqli_error($conn);
}
//$dbname = "students";
//mysqli_select_db($conn, $dbname);
?>
