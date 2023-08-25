<?php
    require_once('connect.php');
   //on selectionne la colonne des montat e la table etudiant et on fait la somme
    $MONTANT=0;
   $ret_etude = 'SELECT PRIX_FORMATION FROM  etudiants';
   $selet = $db->prepare($ret_etude);
   $selet->execute();
    while($prix = $selet->fetch()){
        $MONTANT +=$prix['PRIX_FORMATION'] ;
    }
    //on fait la meme chose pour la table stagiaire et on fait la somme
    $MONTANT1=0;
   $ret_stage = 'SELECT PRIX_FORMATION FROM  STAGIAIRE';
   $selet = $db->prepare($ret_stage);
   $selet->execute();
    while($prix = $selet->fetch()){
        $MONTANT1 +=$prix['PRIX_FORMATION'] ;
    }
   ECHO $MONTANT1+$MONTANT;

?>