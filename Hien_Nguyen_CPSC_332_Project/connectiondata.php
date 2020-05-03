<?php

$servername = "localhost";
$username = "root";
$password = "0909409761Bv";
$dbname = "doctoroffice";
$port = "3306";
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    echo '<script>alert("Connection failed")</script>';
    die();
}
?>