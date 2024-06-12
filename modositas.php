<?php

if(!isset($_REQUEST['id'])){
    header("Location: lista.php");
    exit();
}

require("kapcsolat.php");

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
        //módosítás
        $id = (int)$_POST['id'];
        $sql = "UPDATE autok
                SET fajta = '{$fajta}', tipus = '{$tipus}', gyartas = '{$gyartas}', km = '{$km}', ara = '{ara}'
                WHERE id = {$id}";
        mysqli_query($dbconn, $sql);
        header("Location: lista.php");
        exit();
    }
}
//űrlap kitöltése
$id = (int)$_GET['id'];
$sql = "SELECT * FROM autok
        WHERE id = {$id}";
$eredmeny = mysqli_query($dbconn, $sql);
$sor = mysqli_fetch_assoc($eredmeny);
//var_dumb($sor);
$fajta = $sor['fajta'];
$tipus = $sor['tipus'];
$gyartas = $sor['gyartas'];
$km = $sor['km'];
$ara = $sor['ara'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stilus.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <h1>Autó adatainak módosítása</h1>
        <form action="" method="post">
            <?php
            if(isset($kimenet)) print($kimenet);
            ?>
            <input type="hidden" name="id" value="<?php print $id ?>">
            
            <p>
                <label for="fajta">Fajta</label>
                <input type="text" name="fajta" value="<?php print $fajta ?>">
            </p>
            <p>
                <label for="tipus">Típus</label>
                <input type="text" name="tipus" value="<?php print $tipus ?>">
            </p>
            <p>
                <label for="gyartas">Email</label>
                <input type="text" name="gyartas" value="<?php print $gyartas ?>">
            </p>
            <p>
                <label for="km">KM</label>
                <input type="number" name="km" value="<?php print $km ?>">
            </p>
            <p>
                <label for="ara">Ára</label>
                <input type="number" name="ara" value="<?php print $ara ?>">
            </p>
            <input type="submit" value="Módosítás" name="rednben">
        </form>
        <p><a href="lista.php">Vissza a listához</a></p>
    </div>
</body>
</html>