<?php

if(!isset($_REQUEST['id'])){
    header("Location: lista.php");
    exit();
}

require("kapcsolat.php");

if(isset($_POST['rendben'])){
    $nev = htmlspecialchars(trim(ucwords(strtolower($_POST['nev']))));
    $mobil = htmlspecialchars(trim($_POST['mobil']));
    $email = htmlspecialchars(trim(strtolower($_POST['email'])));

    if(empty($nev)) $hibak[] = "Nem adott meg nevet!";
    elseif(strlen($nev) < 3)$hibak[] = "Az ön neve gyanúsan rövid!";

    if(empty($mobil) && strlen($mobil) < 9) $hibak[] = "Helytelen a mobil szám formátum!";

    if(!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) $hibak[] = "Helytelen e-mail!";

    if(isset($hibak)){
        $kimenet .= "<ul>";
        foreach($hibak as $hiba) $kimenet .= "<li>{$hiba}</li>";
        $kimenet .= "</ul>";
    }else{ 
        //módosítás
        $id = (int)$_POST['id'];
        $sql = "UPDATE dolgozok
                SET
                ";
        mysqli_query($dbconn, $sql);
    }
}
//űrlap kitöltése
$id = (int)$_GET['id'];
$sql = "SELECT * FROM dolgozok
        WHERE id = {$id}";
$eredmeny = mysqli_query($dbconn, $sql);
$sor = mysqli_fetch_assoc($eredmeny);
//var_dumb($sor);
$nev = $sor['nev'];
$mobil = $sor['mobil'];
$email = $sor['email'];

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
        <h1>Dolgozó adatainak módosítása</h1>
        <form action="" method="post">
            <?php
            if(isset($kimenet)) print($kimenet);
            ?>
            <input type="hidden" name="id" value="<?php print $id ?>">
            
            <p>
                <label for="nev">Név</label>
                <input type="text" name="nev" value="<?php print $nev ?>">
            </p>
            <p>
                <label for="mobil">Mobil</label>
                <input type="tel" name="mobil" value="<?php print $mobil ?>">
            </p>
            <p>
                <label for="email">Email</label>
                <input type="email" name="email" value="<?php print $email ?>">
            </p>

            <input type="submit" value="Módosítás" name="rednben">
        </form>
        <p><a href="lista.php"></a>Vissza a listához</p>
    </div>
</body>
</html>