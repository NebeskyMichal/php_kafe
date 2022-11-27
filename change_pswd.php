<?php
require_once('db.php');
session_start();
$pswd = $_POST['pswd'];
$name = $_SESSION['name'];
$sql = "update people set password = '" . "$pswd' where name = '" . "$name'";
$result = $conn->query($sql);
header('Location: login.php?name=' . $name);