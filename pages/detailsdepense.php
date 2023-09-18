<?php

session_start();
require_once('C:\xampp12\htdocs\ProjetGit\layout\connect.php');
//on require le header pour l'entete de la page
$ID_TYPE_COMPTE = $_SESSION['ID_TYPE_COMPTE'];
$MOT = 'ADMIN';
$resultat = strstr($ID_TYPE_COMPTE,$MOT);
if($resultat===false){
    require_once('headerset.php');
}else{
    require_once('C:\xampp12\htdocs\ProjetGit\layout\headeradmin.php');
}

$requete5 = 'SELECT * FROM depenses';
//on prepare la requete
$stn = $db->prepare($requete5);
//on excecute la requete
$stn->execute();
//on stock les donnees les donnes dans une variable
$result_depense = $stn->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="col-12 container mt-4 py-5">
    <div class="col-1 py-2 ms-5 mt-1  fixed-top mt-5 py-5">
        <button type="button"  class="text-warning float-start bg-success btn " onclick="history.back()"><i class="bi bi-arrow-left-short icon-link-hover"></i></button>
    </div>

        <h2 class="text-center text-warning">Details Argent Sortie</h2>
        <table class="table border">
           
            <thead>
                <th>ID VALIDATEUR RETRAIT</th>
                <th>NOMS RECEVEUR</th>
                <th>MONTANT RETIRE</th>
                <th>MOTIF DE RETRAIT</th>

            </thead>
            <tbody>
            <?php
            foreach($result_depense as $DEPENSE){  

            ?>
                <tr>
                    <td><?= $DEPENSE['ID_COMPTE']?></td>
                    <td><?= $DEPENSE['NOM_PRENOMS']?></td>
                    <td><?= $DEPENSE['PRIX_DEPENSE']?></td>
                    <td><?= $DEPENSE['MOTIF']?></td>
                </tr>
            <?php
            }
            ?>
        </table>
</div>
        <div class="row  justify-content-end align-items-end">
            <a href="depenses.php" class="btn btn-info w-25 float-end text-white text-uppercase text-center">Effectuer</a>
        </div>
<!-- require le footer -->
<?php
    require_once('C:\xampp12\htdocs\ProjetGit\layout\footer.php');
?>