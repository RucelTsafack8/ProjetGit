<?php
session_start();
//on require le header pour l'entete de la page
$ID_TYPE_COMPTE = $_SESSION['ID_TYPE_COMPTE'];
$MOT = 'ADMIN';
$resultat = strstr($ID_TYPE_COMPTE,$MOT);
if($resultat===false){
    require_once('headerset.php');
}else{
    require_once('header.php');
}
//on require le footer pour le pied de page
require_once('footer.php');
// On inclus le fichier de connection a la base de donnees.
require_once('connect.php');
$message_erreur = "L'id inscript n'existe pas";
if(isset($_GET['ID_STAGIAIRE'])){
    $ID_STAGIAIRE =$_GET['ID_STAGIAIRE'];

    $requete = 'DELETE FROM STAGIAIRE WHERE ID_STAGIAIRE = ?';
    //on prepare la requete
    $query = $db->prepare($requete);
    //on excecute la requete
    $query->execute(array($ID_STAGIAIRE));
    //on stock les donnees les donnes dans une variable
    $STAGE = $query->fetch();
    header('Location:donneestage.php');
}

?>
