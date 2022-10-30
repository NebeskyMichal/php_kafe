<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<?php
require_once "db.php";

$sql = "SELECT people.name,types.typ, count(drinks.id_people) as pocet_vypito from drinks 
inner join people on people.id = drinks.id_people inner join types on types.id = drinks.id_types group by people.name, types.typ";

$result = $conn->query($sql);

echo "<table class=\"table table-bordered table-hover table-striped\">
<thead class=\"thead-dark\">
<tr>
<th scope=\"col\" >jmeno</th>
<th scope=\"col\">drink</th>
<th scope=\"col\">vypito</th></tr>
</thead>
<tbody>";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['typ'] . "</td>";
            echo "<td>" . $row['pocet_vypito'] . "</td>";
            echo "</tr>";
    }
        echo " </tbody></table>";
}

?>
<form method="POST">
<select name="mySelect">
    <?php
    $sql = "select name from people";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $name = $row["name"];
                echo "<option name=\"vyber\" value=\"$name\" selected>$name</option>";
        }
    }
  ?>
</select>  
<button type="submit">Zjistit</button>
</form>
<?php
error_reporting(E_ALL ^ E_NOTICE);  
$select = $_POST["mySelect"];
if(strlen($select) > 0){
    $sql = "SELECT people.name,types.typ,MONTH(drinks.date) as mesic, count(drinks.id_people) as pocet_vypito from drinks inner join people on people.id = drinks.id_people inner join types on types.id = drinks.id_types where people.name = '$select' group by people.name, types.typ, mesic 
    ORDER BY `mesic` DESC;";
}else{
    $sql = "SELECT people.name,types.typ,count(drinks.id_people) as pocet_vypito,MONTH(drinks.date) as mesic from drinks inner join people on people.id = drinks.id_people inner join types on types.id = drinks.id_types where people.name = 'Masopust Lukáš' group by people.name, types.typ, mesic  order by mesic desc,people.name, types.typ;";
}

$result = $conn->query($sql);
echo "<table class=\"table table-bordered table-hover table-striped\">
<thead class=\"thead-dark\">
<tr>
<th scope=\"col\" >jmeno</th>
<th scope=\"col\">drink</th>
<th scope=\"col\">vypito</th><th scope=\"col\">mesic</th></tr>
</thead>
<tbody>";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['typ'] . "</td>";
            echo "<td>" . $row['pocet_vypito'] . "</td>";
            echo "<td>" . $row['mesic'] . "</td>";
            echo "</tr>";
    }
        echo " </tbody></table>";
}


$coffe_desc = [[1,10,50],[2,12,7],[3,24,14],[4,10,14],[5,65,21]];
echo "<table class=\"table table-bordered table-hover table-striped\">
<thead class=\"thead-dark\">
<tr>
<th scope=\"col\" >jmeno</th>
<th scope=\"col\">drink</th>
<th scope=\"col\">propito v kč</th></tr>
</thead>
<tbody>";

for ($i = 0; $i < count($coffe_desc); $i++) {
    $drink_id = $coffe_desc[$i][0];
    $drink_price = $coffe_desc[$i][1];
    $drink_weight = $coffe_desc[$i][2];
    $sql = "select name, typ, count(*)*$drink_weight/10*$drink_price as propito_v_kc from drinks inner join people on drinks.id_people = people.ID inner join types on types.ID = drinks.id_types where id_types = $drink_id  group by name, typ;";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['typ'] . "</td>";
                echo "<td>" . round($row['propito_v_kc']). "</td>";
                echo "</tr>";
            }
        }
}
 echo " </tbody></table>";
?>
