<?php

if(isset($_GET['id'])){
    //echo $_GET['id'];
    require("kapcsolat.php");
    $id = (int)$_GET['id'];
    $sql = "DELETE FROM dolgozok
            WHERE id = {$id}";

    if($myslqi_query($dbconn, $sql)){
        echo "Sikeres törlés!";
        exit();
    }else{
        echo "HIBA a törlés során!" . mysqli_error($dbconn);
    }
}else{
    header("Location: lista.php");
    exit();
}