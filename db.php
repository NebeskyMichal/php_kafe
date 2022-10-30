<?php
$servername = "localhost";
$username = "id19514078_admin";
$password = "daX!*<7}(?geBtb+";
$dbname = "id19514078_coffe_lmsoft_cz";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>