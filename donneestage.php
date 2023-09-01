<?php

    session_start();
    // On inclus le fichier de connection a la base de donnees.
    require_once('connect.php');

    require_once('header.php');
    $requete2 = 'SELECT * FROM STAGIAIRE';
    //on prepare la requete
    $stn = $db->prepare($requete2);
    //on excecute la requete
    $stn->execute();
    //on stock les donnees les donnes dans une variable
    $result_stage = $stn->fetchAll(PDO::FETCH_ASSOC);

?>  
<!-- tableau des stagiaires -->
<div class="col-12 container mt-5 py-5">
    <div class="col-1 py-2 ms-5 mt-1">
        <button type="button"  class="text-warning float-start bg-success btn " onclick="history.back()"><i class="bi bi-arrow-left-short icon-link-hover"></i></button>
    </div>
        <h1 class="text-center text-success">Table Stagiaire</h1>
        <table class="table border">
             
        <thead>
                <th>ID_STAGIAIRE</th>
                <th>NUMERO_TEL</th>
                <th>NOM_PRENOMS</th>
                <th>MONTANT VERSE</th>
                <th>INFORMATIONS</th>

            </thead>
            <tbody>
            <?php
            foreach($result_stage as $STAGE){  
                $_SESSION['ID_STAGIAIRE']=$STAGE['ID_STAGIAIRE'] ;
                $_SESSION['NOM_PRENOMS']=$STAGE['NOM_PRENOMS'] ;
            ?>
                <tr>
                    <td><?= $STAGE['ID_STAGIAIRE']?></td>
                    <td><?= $STAGE['NUMERO_TEL']?></td>
                    <td><?= $STAGE['NOM_PRENOMS']?></td>
                    <td><?= $STAGE['PRIX_FORMATION']?>F</td>
                    <td>
                        <a href="detailstage.php?ID_STAGIAIRE=<?= $STAGE['ID_STAGIAIRE'] ?>" class="btn btn-light">Voir Plus</a>
                        <a href="modifierstage.php?ID_STAGIAIRE=<?= $STAGE['ID_STAGIAIRE'] ?>" class="btn btn-success py-1 mt-1">Modifier</a>
                        <a href="supprimerstage.php?ID_STAGIAIRE=<?= $STAGE['ID_STAGIAIRE'] ?>" class="btn btn-danger py-1 mt-1">Supprimer</a>
                    </td>

                </tr>
            </tbody>
            <?php
            }
            ?>
        </table>
        <div class="row  justify-content-end align-items-end">
            <a href="inscriptionstage.php" class="btn btn-info w-25 float-end text-white text-uppercase text-center">Ajouter</a>
        </div>
    </div>
<?php
    require_once('footer.php');
?>