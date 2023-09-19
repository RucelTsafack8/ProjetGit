<?php

require_once('C:\xampp12\htdocs\ProjetGit\layout\connect.php');


if(!empty($_GET["ID_TRANCHE"])){

    $query4 ='SELECT * FROM prix_tranche WHERE ID_TRANCHE=:ID_TRANCHE';
    $stmt2= $db->prepare($query4);
    $stmt2->execute(["ID_TRANCHE"=>$_GET["ID_TRANCHE"]]);
    $row2=$stmt2->fetch();
   
    //var_dump($row);
    echo $row2['ID_TRANCHE'];
}

?>