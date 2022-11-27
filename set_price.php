<?php
require_once('db.php');
session_start();
$coffe_type = $_POST["coffe_type"];
$coffe_price = $_POST["price"];
$name = $_SESSION['name'];
echo $coffe_type . " " . $coffe_price;
$result = $conn->query("update types set price = $coffe_price where typ = '$coffe_type';");
header('Location: login.php?name=' . $name);