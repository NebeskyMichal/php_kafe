<body>
    <?php
    require_once('head.php');
    require_once('db.php');
    session_start();
    function first_login($conn,$email) {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array();
        $alphaLength = strlen($alphabet) - 1;

        for ($i = 0; $i < 15; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        $pass = implode($pass);
        $msg = "Vítejte vzhledem k tomu že toto je vaše první přihlášení bylo Vám vygenerováno heslo. Heslo: " . $pass;
        echo "<script type='text/javascript'>alert('$msg');</script>";
        $sql_insert = "update people set password = '" . $pass . "', logged = 1 where email = '" . $email . "'";
        $result = $conn->query($sql_insert);
    }
    if (isset($_POST['email']) && isset($_POST['auth'])) {
        $email = $_POST["email"];
        $auth_type = $_POST['auth'];
    }

    if (isset($_GET['name'])) {
        $name = $_GET['name'];
    }

    switch ($auth_type) {
        case "http_auth":
            $sql = "select name,password,logged from people where email = '$email'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $pass = $row["password"];
                    $logged = $row["logged"];
                    $name = $row["name"];
                    $_SESSION['name'] = $name;
                }
                if ($logged == 0) {
                    first_login($conn,$email);
                } else {
                    if (
                        empty($_SERVER['PHP_AUTH_USER']) ||
                        $_SERVER['PHP_AUTH_USER'] != $name ||
                        $_SERVER['PHP_AUTH_PW'] != $pass
                    ) {
                        header('WWW-Authenticate: Basic realm="My Realm"');
                        header('HTTP/1.0 401 Unauthorized');
                        echo 'Zde nemáte přístup bez jména a hesla';
                        exit;
                    }
                }
            }
            break;
        default:
            break;
    }
    if ($name == "coffemaster") {
        echo '<section><h3>Nastavte cenu pro kafe</h3>';
        echo '<form method="post" action="set_price.php"><select name="coffe_type">';
        $sql = "select typ from types";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $name = $row["typ"];
                echo "<option name=\"vyber\" value=\"$name\" selected>$name</option>";
            }
        }
        echo '</select><label for="price">Cena na 1ml/g:</label><input type="number" id="price" name="price" required><button type="submit">Odeslat</button></form><h3>Export uživatele</h3><form method="post" action="csv_export.php"><select name="csv_export">';
        $sql = "select name from people";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $name = $row["name"];
                echo "<option name=\"vyber\" value=\"$name\" selected>$name</option>";
            }
        }
        echo '</select><button type="submit">export</button></form></section><main><h2>Vítejte coffemaster, zde vidíte výpis všech uživatelů za měsíc ' . date('m') - 1 . '</h2>';
        $sql = "select name from people";
        $names = [];
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $names[] = $row["name"];
            }
        }
        foreach ($names as &$value) {
            if ($value != "coffemaster") {
                echo "<h3>Výpis pro uživatele $value</h3>";
                echo "<table class=\"center table table-responsive{-sm|-md|-lg|-xl} table-bordered table-hover table-striped table-sm\"><thead class=\"thead-dark\"><tr><th scope=\"col\">drink</th><th scope=\"col\">vypito</th></tr></thead><tbody>";
                $sql = "SELECT types.typ,count(drinks.id_people) as pocet_vypito from drinks inner join people on people.id = drinks.id_people inner join types on types.id = drinks.id_types where people.name =" . "'" . $value . "'" . "and month(drinks.date) = month(now())-1 group by people.name, types.typ order by people.name, types.typ desc;";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td style=\"width: 50%\">" . $row["typ"] . "</td>";
                        echo "<td style=\"width: 50%\">" . $row["pocet_vypito"] . "</td>";
                        echo "</tr>";
                    }
                    echo " </tbody></table>";
                }
            }
        }
        echo "</main>";
        exit;
    }
    $mesic = date("m")-1;
    echo "<h1>Vítejte <strong>" . $name . "</strong>. Zde najdete výpis toho co jste vypil/a za měsíc " . $mesic . "</h1>";
    $sql = "SELECT types.typ,count(drinks.id_people) as pocet_vypito from drinks inner join people on people.id = drinks.id_people inner join types on types.id = drinks.id_types where people.name =" . "'" . $name . "'" . "and month(drinks.date) = month(now())-1 group by people.name, types.typ order by people.name, types.typ desc;";
    $result = $conn->query($sql);
    echo "<main>";
    echo "<table class=\"center table table-responsive{-sm|-md|-lg|-xl} table-bordered table-hover table-striped table-sm\"><thead class=\"thead-dark\"><tr><th scope=\"col\">drink</th><th scope=\"col\">vypito</th></tr></thead><tbody>";
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td style=\"width: 50%\">" . $row["typ"] . "</td>";
            echo "<td style=\"width: 50%\">" . $row["pocet_vypito"] . "</td>";
            echo "</tr>";
        }
        echo " </tbody></table>";
    }

    $sql = "select name,sum(price) as cena from paid inner join people on people.id = paid.people_id group by people_id order by cena asc limit 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($row['name'] == $_SESSION['name']) {
                echo "<h1 style=\"color:red\">Je na čase zaplatit!!</h1>";
            }
        }
    }
    echo "<h3>Zadejte co jste zakoupil/a a kolik gramů/mililitrů</h3>";
    ?>
    <form method="post" action="pay.php">
        <select name="myGrams">
            <?php
            $sql = "select typ from types";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $name = $row["typ"];
                    echo "<option name=\"vyber\" value=\"$name\" selected>$name</option>";
                }
            }
            echo "</select><label for=\"grams\">Kolik gramů/ml:</label><input type=\"number\" id=\"grams\" name=\"grams\" required ><label for=\"price\">Kolik czk na 1g/ml:</label><input type=\"number\" id=\"price\" name=\"price\" required ><button type=\"submit\">Odeslat</button></form>";
            ?>
            <form method="post" action="csv_export.php">
                <input type="submit" name="export" value="CSV EXPORT" />
            </form>
            <form method="post" action="change_pswd.php">
                <br>
                <label for="email">Nové heslo</label>
                <input type="password" id="pswd" name="pswd" minlenght="5" maxlength="50">
                <input type="submit" name="pswd_send" value="Změnit heslo" />
            </form>