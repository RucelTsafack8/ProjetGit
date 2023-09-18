<?php
    session_start();
    require_once('connect.php');
    //on require le header pour l'entete de la page
    $ID_TYPE_COMPTE = $_SESSION['ID_TYPE_COMPTE'];
    $MOT = 'ADMIN';
    $resultat = strstr($ID_TYPE_COMPTE,$MOT);
    if($resultat===false){
        require_once('headerset.php');
    }else{
        require_once('headeradmin.php');
    }
    //requetes de selection des etudiant des dont le montant est superieur a 0 franc
    $requete4 = 'SELECT * FROM etudiants WHERE RECU_ACTION =1';
    //on prepare la requete
    $stm = $db->prepare($requete4);
    //on excecute la requete
    $stm->execute();
    //on stock les donnees les donnes dans une variable
    $result_etudiant = $stm->fetchAll(PDO::FETCH_ASSOC);

    $requete5 = 'SELECT * FROM stagiaire WHERE PRIX_FORMATION>0';
    //on prepare la requete
    $stn = $db->prepare($requete5);
    //on excecute la requete
    $stn->execute();
    //on stock les donnees les donnes dans une variable
    $result_stage = $stn->fetchAll(PDO::FETCH_ASSOC);

    $ret_etude = 'SELECT MONTANT_PAYE FROM  etudiants WHERE RECU_ACTION =1';
   $selet = $db->prepare($ret_etude);
   $selet->execute();
    while($prix = $selet->fetch()){
        $MONTANT +=$prix['MONTANT_PAYE'] ;
    }
    //on fait la meme chose pour la table stagiaire et on fait la somme
    $MONTANT1=0;
    //requete pour selectionner et calculer le montant des stagiaires
$ret_stage = 'SELECT PRIX_FORMATION FROM  STAGIAIRE WHERE RECU_ACTION =1';
   $selet = $db->prepare($ret_stage);
   $selet->execute();
    while($prix = $selet->fetch()){
        $MONTANT1 +=$prix['PRIX_FORMATION'] ;
    }
   $MONTANTS= $MONTANT1+$MONTANT;



?>
<div class="col-12 container mt-4 py-5">
    <div class="col-1 py-2 ms-5 mt-1  fixed-top mt-5 py-5">
        <button type="button"  class="text-warning float-start bg-success btn " onclick="history.back()"><i class="bi bi-arrow-left-short icon-link-hover"></i></button>
    </div>

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
                    <td><?= $ETUDE['NUM_TEL']?></td>
                    <td><?= $ETUDE['NOM_PRENOMS']?></td>
                    <td><?= $ETUDE['MONTANT_PAYE']?></td>
                </tr>
            <?php
            }
            ?>
            <?php
            foreach($result_stage as $STAGE){  

            ?>
                <tr>
                    <td><?= $STAGE['ID_STAGIAIRE']?></td>
                    <td><?= $STAGE['NUMERO_TEL']?></td>
                    <td><?= $STAGE['NOM_PRENOMS']?></td>
                    <td><?= $STAGE['PRIX_FORMATION']?></td>
                </tr>
            </tbody>
            <?php
            }
            ?>
        </table>
        <div class="row  justify-content-end align-items-end">
            <p  class="btn btn-light w-25 float-end text-info text-uppercase text-center">MONTANT TOTAL <?= $MONTANTS ?> FRANC CFA</p>
        </div>

    
</body>
</html>
<?php
    require_once('footer.php');
?>