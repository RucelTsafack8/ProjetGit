<?php
session_start();
//on require le header pour l'entete de la page
// $ID_TYPE_COMPTE = $_SESSION['ID_TYPE_COMPTE'];
// $MOT = 'ADMIN';
// $resultat = strstr($ID_TYPE_COMPTE,$MOT);
// if($resultat===false){
//     require_once('headerset.php');
// }else{
//     require_once('header.php');
// }

// On inclus le fichier de connection a la base de donnees.
require_once('C:\xampp12\htdocs\ProjetGit\layout\connect.php');
$message_erreur = "L'id inscript n'existe pas";
if(isset($_GET['ID_PROFESSEUR'])){
    $ID_PROFESSEUR =$_GET['ID_PROFESSEUR'];

    $requete = 'DELETE FROM PROFESSEURS WHERE ID_PROFESSEUR = ?';
    //on prepare la requete
    $query = $db->prepare($requete);
    //on excecute la requete
    $query->execute(array($ID_PROFESSEUR));
    //on stock les donnees les donnes dans une variable
    $PROF = $query->fetch();
    header('Location:donneeprof.php');
}



?>