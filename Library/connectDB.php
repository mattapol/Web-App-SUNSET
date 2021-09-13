<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbName = "library";

// Create connection
$conn = new mysqli($serverName,$username,$password,$dbName);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$conn->set_charset('utf8');

?>