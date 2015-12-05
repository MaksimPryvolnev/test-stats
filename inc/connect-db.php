<?php
$servername = "localhost";
$username = "root";
$password = "123456";
$conn = new mysqli($servername, $username, $password, "test_stats");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
