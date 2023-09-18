<?php
    require_once('connect.php');
   $ID_ETUDIANT ='3IA-ETU2023Tsa-2';
   $requete = 'SELECT * FROM ETUDIANTS WHERE ID_ETUDIANT = ?';
   //on prepare la requete
   $query = $db->prepare($requete);
   //on excecute la requete
   $query->execute(array($ID_ETUDIANT));
   //on stock les donnees les donnes dans une variable
   $ETUDIANT = $query->fetch();
   var_dump($ETUDIANT);


   $req = ' SELECT NOM_PRENOMS  FROM personnels  WHERE ID_COMPTE = ?';
    $query4= $db->prepare($req);
    //on excecute la requete
    $query4->execute(array($ID_ETUDIANT));
    //on stock les donnees les donnes dans une variable
    $PERSON = $query4->fetch();
    var_dump($PERSON);

?>