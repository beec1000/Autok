<?php
require_once 'kapcsolat.php';

if($_SERVER['REQUEST_METHOD'] === 'GET'){
    try{
        $sql = "SELECT * FROM autok";
        $eredmeny = mysqli_query($dbconn, $sql);
        if(!$eredmeny){
            http_response_code(500); //belső szerver hiba
            die("HIBA a kiválasztásnál:" . mysqli_error($dbconn));
        }
        $autok = array();
        while($sor = mysqli_fetch_assoc($eredmeny)){
            $autok[]= $sor;
        }

        mysqli_close($dbconn);
        header('Content-Type:application/json; charset=utf-8');
        echo json_encode($autok, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        file_put_contents('auto.json', json_encode($autok, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }catch(Exception $e){
        http_response_code(500);
        echo "HIBA " . $e->getMessage();
    };
}else{
    //nem megengedett kérés
    http_response_code(405);
};
?>