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
    //requetes de selection des etudiant des dont le montant est superieur a 0 franc
    $requete4 = 'SELECT * FROM ETUDIANTS WHERE PRIX_FORMATION>0';
    //on prepare la requete
    $stn = $db->prepare($requete4);
    //on excecute la requete
    $stn->execute();
    //on stock les donnees les donnes dans une variable
    $result_etudiant = $stn->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="col-12 container mt-4 py-5">
        <h2 class="text-center text-warning">Details Argent</h2>
        <table class="table border">
           
            <thead>
                <th>ID PERSONNE</th>
                <th>NUMERO_TEL</th>
                <th>NOM_UTILISATEUR</th>
                <th>MONTANT VERSE</th>

            </thead>
            <tbody>
            <?php
            foreach($result_etudiant as $ETUDE){  

            ?>
                <tr>
                    <td><?= $ETUDE['ID_ETUDIANT']?></td>
                    <td><?= $ETUDE['NUMERO_TEL']?></td>
                    <td><?= $ETUDE['NOM_PRENOMS']?></td>
                    <td><?= $ETUDE['PRIX_FORMATION']?></td>
                </tr>
            </tbody>
            <?php
            }
            ?>
        </table>
    
</body>
</html>