<?php
require_once('db.php');
session_start();
if(isset($_POST['csv_export'])){
    $query = $conn->query("SELECT types.typ,count(drinks.id_people) as pocet_vypito from drinks inner join people on people.id = drinks.id_people inner join types on types.id = drinks.id_types where people.name =" . "'" . $_POST["csv_export"] . "'" . "and month(drinks.date) = month(now())-1 group by people.name, types.typ order by people.name, types.typ desc;");
}else{
    $query = $conn->query("SELECT types.typ,count(drinks.id_people) as pocet_vypito from drinks inner join people on people.id = drinks.id_people inner join types on types.id = drinks.id_types where people.name =" . "'" . $_SESSION['name'] . "'" . "and month(drinks.date) = month(now())-1 group by people.name, types.typ order by people.name, types.typ desc;");
}
if($_POST['csv_export'] != "coffemaster"){
if ($query->num_rows > 0) {
    $delimiter = ",";
    $filename = "export_" . date('m') - 1 . ".csv";

    $f = fopen('php://memory', 'w');

    $fields = array('TYP_DRINKU', 'POCET_VYPITO');
    fputcsv($f, $fields, $delimiter);

    while ($row = $query->fetch_assoc()) {
        $lineData = array($row['typ'], $row['pocet_vypito']);
        fputcsv($f, $lineData, $delimiter);
    }

    fseek($f, 0);

    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');

    fpassthru($f);
}
}else{
    header('Location: login.php?name=' . $_POST['csv_export']);
}