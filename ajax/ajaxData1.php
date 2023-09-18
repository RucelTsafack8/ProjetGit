<?php
require_once('connect.php');

if(!empty($_GET["ID_FORMATION"])){

    $query3 ='SELECT PRIX_FORMATION FROM formations WHERE ID_FORMATION=:ID_FORMATION';
    $stmt= $db->prepare($query3);
    $stmt->execute(["ID_FORMATION"=>$_GET["ID_FORMATION"]]);
    $row=$stmt->fetch();
   
    //var_dump($row);
    echo $row['PRIX_FORMATION'];
}

?>