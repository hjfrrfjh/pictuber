<?php
$servername = "localhost";
$username = "root";
$password = "1234";

// Create connection
$conn = mysqli_connect($servername, $username, $password,"picktuber");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

mysqli_set_charset($conn, "utf8")
?>