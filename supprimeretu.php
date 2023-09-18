<?php
session_start();
//on require le header pour l'entete de la page
$ID_TYPE_COMPTE = $_SESSION['ID_TYPE_COMPTE'];
$MOT = 'ADMIN';
$resultat = strstr($ID_TYPE_COMPTE,$MOT);
// if($resultat===false){
//     require_once('headerset.php');
// }else{
//     require_once('header.php');
// }
//on require le footer pour le pied de page
require_once('footer.php');
// On inclus le fichier de connection a la base de donnees.
require_once('connect.php');
$message_erreur = "L'id inscript n'existe pas";
if(isset($_GET['ID_ETUDIANT'])){
    $ID_ETUDIANT =$_GET['ID_ETUDIANT'];

    $requete = 'DELETE FROM ETUDIANTS WHERE ID_ETUDIANT = ?';
    //on prepare la requete
    $query = $db->prepare($requete);
    //on excecute la requete
    $query->execute(array($ID_ETUDIANT));
    //on stock les donnees les donnes dans une variable
    $ETUDIANT = $query->fetch();
    header('Location:donneeetu.php');
}
?>
