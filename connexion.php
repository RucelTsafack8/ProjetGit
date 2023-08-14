<?php
//demarrage de la session4
session_start();
$date_actuel = date('Y');
//require once le fichier conect pour la connexion a la base de dennees
require_once('connect.php');
if(!isset($_SESION['NOM_PRENOMS'])){
    header('location:inscription.php');
}
else{
    echo "Bienvenue $_SESION['NOM_PRENOMS'], sur votre page a $date_actuel";
 }
?>
