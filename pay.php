<?php
require_once('db.php');
session_start();
$name = $_SESSION['name'];
$grams = $_POST['grams'];
$price = $_POST['price'];
$final_price = $price * $grams;

$sql = "select id from people where name = '$name'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $id = $row['id'];
    }
}

$sql = "insert into paid(people_id,price,date) values($id,$final_price,now());";
$result = $conn->query($sql);
header('Location: login.php?name=' . $name);