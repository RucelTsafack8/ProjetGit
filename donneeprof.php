<?php

    session_start();
    // On inclus le fichier de connection a la base de donnees.
    require_once('connect.php');

    require_once('header.php');
    //requetes pour les professeurs
    $requete3 = 'SELECT * FROM professeurs';
    //on prepare la requete
    $stm = $db->prepare($requete3);
    //on excecute la requete
    $stm->execute();
    //on stock les donnees les donnes dans une variable
    $result_prof = $stm->fetchAll(PDO::FETCH_ASSOC);

?>  
 <div class="col-12 container  mt-5 py-5">
        <h1 class="text-center text-success">Table Professeurs</h1>
        <table class="table border">
             
        <thead>
                <th>$ID_PROFESSEUR</th>
                <th>NUMERO_TEL</th>
                <th>NOM_PRENOMS</th>
                <th>INFORMATIONS</th>

            </thead>
            <tbody>
            <?php
            foreach($result_prof as $PROF){  
                $_SESSION['ID_PROFESSEUR']=$PROF['ID_PROFESSEUR'] ;
                $_SESSION['NOM_PRENOMS']=$PROF['NOM_PRENOMS'] ;
            ?>
                <tr>
                    <td><?= $PROF['ID_PROFESSEUR']?></td>
                    <td><?= $PROF['NUMERO_TEL']?></td>
                    <td><?= $PROF['NOM_PRENOMS']?></td>
                    <td>
                        <a href="detailsProf.php?ID_PROFESSEUR=<?= $PROF['ID_PROFESSEUR'] ?>" class="btn btn-light">Voir Plus</a>
                        <a href="modifierProf.php?ID_PROFESSEUR=<?= $PROF['ID_PROFESSEUR'] ?>" class="btn btn-success py-1 mt-1">Modifier</a>
                        <a href="supprimerprof.php?ID_PROFESSEUR=<?= $PROF['ID_PROFESSEUR'] ?>" class="btn btn-danger py-1 mt-1">Supprimer</a>
                    </td>

                </tr>
            </tbody>
            <?php
            }
            ?>
        </table>
        <div class="row  justify-content-end align-items-end">
            <a href="inscriptionprof.php" class="btn btn-info w-25 float-end text-white text-uppercase text-center">Ajouter</a>
        </div>
    </div>