<?php
$servername = "64.20.44.202";
$username = "radio_admin";
$password = "G3tR3@dY1970";

// Create connection
$conn = mysqli_connect($servername, $username, $password);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
?>
