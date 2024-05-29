<?php
require_once 'kapcsolat.php';

if($_SERVER['REQUEST_METHOD'] === 'GET'){
    try{
        $sql = "SELECT * FROM dolgozok";
        $eredmeny = mysqli_query($dbconn, $sql);
        if(!$eredmeny){
            http_response_code(500); //belső szerver hiba
            die("HIBA a kiválasztásnál:" . mysqli_error($dbconn));
        }
        $dolgozok = array();
        while($sor = mysqli_fetch_assoc($eredmeny)){
            $dolgozok[]= $sor;
        }

        mysqli_close($dbconn);
        header('Content-Type:application/json; charset=utf-8');
        echo json_encode($dolgozok, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }catch{};
}