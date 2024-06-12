<?php

if(isset($_POST['rendben'])){
    $fajta = htmlspecialchars(trim(ucwords(strtolower($_POST['nev']))));
    $tipus = htmlspecialchars(trim(ucwords(strtolower($_POST['nev']))));
    $gyartas = htmlspecialchars(trim($_POST['mobil']));
    $km = htmlspecialchars(trim($_POST['mobil']));
    $ara = htmlspecialchars(trim($_POST['mobil']));

    if(empty($fajta)) $hibak[] = "Nem adott meg gyártó nevet!";
    elseif(strlen($fajta) < 3)$hibak[] = "A gyártó neve gyanúsan rövid!";

    if(empty($tipus)) $hibak[] = "Nem adott meg típust!";

    if(empty($gyartas) && strlen($mobil) < 4) $hibak[] = "Helytelen az évszám formátum!";

    if(empty($km)) $hibak[] = "Helytelen a kilométer formátum!";

    if(empty($ara)) $hibak[] = "Helytelen az ár formátum!";

    if(isset($hibak)){
        $kimenet .= "<ul>";
        foreach($hibak as $hiba) $kimenet .= "<li>{$hiba}</li>";
        $kimenet .= "</ul>";
    }else{
        require("kapcsolat.php");
        $sql = "INSERT INTO autok
                (fajta, tipus, gyartas, km, ara)
                VALUES 
                ('{$fajta}', '{$tipus}', '{$gyartas}', '{$km}', '{$ara}')";
        mysqli_query($dbconn, $sql);
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stilus.css">
    <title>Autók</title>
</head>
<body>
    <div class="container">
        <h1>Új autó felvitele</h1>
        <form action="" method="post">
            <?php
            if(isset($kimenet)) print($kimenet);
            ?>
            <p>
                <label for="fajta">Fajta</label>
                <input type="text" name="fajta">
            </p>
            <p>
                <label for="tipus">Típus</label>
                <input type="text" name="tipus">
            </p>
            <p>
                <label for="gyartas">Gyártás</label>
                <input type="text" name="gyartas">
            </p>
            <p>
                <label for="km">KM</label>
                <input type="number" name="km">
            </p>
            <p>
                <label for="ara">Ára</label>
                <input type="number" name="ara">
            </p>

            <input type="submit" value="Felvitel" name="rednben">
        </form>
        <p><a href="lista.php">Vissza a listához</a></p>
    </div>
</body>
</html>