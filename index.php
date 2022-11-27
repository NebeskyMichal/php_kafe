<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
require_once "head.php";
require_once "db.php";
?>

<body>
    <section>
        <div class="log_form">
            <form method="POST" action="login.php">
                <label for="email">E-Mail</label><br>
                <input type="text" id="email" name="email" required minlength="10" maxlength="50">
                <br>
                <label for="http">HTTP autentifikace</label>
                <input type="radio" id="http_auth" name="auth" value="http_auth" checked="checked">
                <button type="submit">Přihlásit se</button>
            </form>
        </div>
    </section>
    <?php


    $sql = "SELECT people.name,types.typ, count(drinks.id_people) as pocet_vypito from drinks 
inner join people on people.id = drinks.id_people inner join types on types.id = drinks.id_types group by people.name, types.typ";

    $result = $conn->query($sql);
    echo "<main>";
    echo "<table class=\"center table table-responsive{-sm|-md|-lg|-xl} table-bordered table-hover table-striped table-sm\"><thead class=\"thead-dark\"><tr><th scope=\"col\" >jmeno</th><th scope=\"col\">drink</th><th scope=\"col\">vypito</th></tr></thead><tbody>";
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td style=\"width: 33%\">" . $row["name"] . "</td>";
            echo "<td style=\"width: 33%\">" . $row["typ"] . "</td>";
            echo "<td style=\"width: 33%\">" . $row["pocet_vypito"] . "</td>";
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
    $select = $_POST["mySelect"];
    if (isset($_POST['mySelect'])) {
        $sql = "SELECT people.name,types.typ,MONTH(drinks.date) as mesic, count(drinks.id_people) as pocet_vypito from drinks inner join people on people.id = drinks.id_people inner join types on types.id = drinks.id_types where people.name = '$select' group by people.name, types.typ, mesic 
  ORDER BY `mesic` DESC;";
    } else {
        $sql =
            "SELECT people.name,types.typ,count(drinks.id_people) as pocet_vypito,MONTH(drinks.date) as mesic from drinks inner join people on people.id = drinks.id_people inner join types on types.id = drinks.id_types where people.name = 'Masopust Lukáš' group by people.name, types.typ, mesic  order by mesic desc,people.name, types.typ;";
    }

    $result = $conn->query($sql);
    echo "<table class=\" center table table-responsive{-sm|-md|-lg|-xl} table-bordered table-hover table-striped table-sm\"><thead class=\"thead-dark\"><tr><th scope=\"col\" >jmeno</th><th scope=\"col\">drink</th><th scope=\"col\">vypito</th><th scope=\"col\">mesic</th></tr></thead><tbody>";
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td style=\"width: 25%\">" . $row["name"] . "</td>";
            echo "<td style=\"width: 25%\">" . $row["typ"] . "</td>";
            echo "<td style=\"width: 25%\">" . $row["pocet_vypito"] . "</td>";
            echo "<td style=\"width: 25%\">" . $row["mesic"] . "</td>";
            echo "</tr>";
        }
        echo " </tbody></table>";
    }
    $coffe_desc = [];
    $sql = "select id, price,weight from types;";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            array_push($coffe_desc,[$row["id"],$row["price"],$row["weight"]]);
        }
    }
    echo "<table class=\" center table table-responsive{-sm|-md|-lg|-xl} table-bordered table-hover table-striped table-sm\"><thead class=\"thead-dark\"><thead class=\"thead-dark\"><tr><th scope=\"col\" >jmeno</th><th scope=\"col\">drink</th><th scope=\"col\">propito v kč</th></tr></thead><tbody>";
    for ($i = 0; $i < count($coffe_desc); $i++) {
        $drink_id = $coffe_desc[$i][0];
        $drink_price = $coffe_desc[$i][1];
        $drink_weight = $coffe_desc[$i][2];
        $sql = "select name, typ, count(*)*$drink_weight/10*$drink_price as propito_v_kc from drinks inner join people on drinks.id_people = people.ID inner join types on types.ID = drinks.id_types where id_types = $drink_id  group by name, typ;";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td style=\"width: 33%\">" . $row["name"] . "</td>";
                echo "<td style=\"width: 33%\">" . $row["typ"] . "</td>";
                echo "<td style=\"width: 33%\">" .
                    round($row["propito_v_kc"]) .
                    "</td>";
                echo "</tr>";
            }
        }
    }
    echo " </tbody></table>";
    echo "</main>";

    ?>
</body>