<?php

    session_start();
    // On inclus le fichier de connection a la base de donnees.
    require_once('connect.php');

    require_once('header.php');
    $requete2 = 'SELECT * FROM ETUDIANTS';
    //on prepare la requete
    $stn = $db->prepare($requete2);
    //on excecute la requete
    $stn->execute();
    //on stock les donnees les donnes dans une variable
    $result_etudiant = $stn->fetchAll(PDO::FETCH_ASSOC);

?>  
<!-- tableau des etudiants -->
<div class="col-12 container mt-5 py-5">
        <h1 class="text-center text-success">Table Etudiants</h1>
        <table class="table border">
             
        <thead>
                <th>ID_ETUDIANT</th>
                <th>NUMERO_TEL</th>
                <th>NOM_PRENOMS</th>
                <th>MONTANT VERSE</th>
                <th>INFORMATIONS</th>

            </thead>
            <tbody>
            <?php
            foreach($result_etudiant as $ETUDIANT){  
                $_SESSION['ID_ETUDIANT']=$ETUDIANT['ID_ETUDIANT'] ;
                $_SESSION['NOM_PRENOMS']=$ETUDIANT['NOM_PRENOMS'] ;
            ?>
                <tr>
                    <td><?= $ETUDIANT['ID_ETUDIANT']?></td>
                    <td><?= $ETUDIANT['NUM_TEL']?></td>
                    <td><?= $ETUDIANT['NOM_PRENOMS']?></td>
                    <td><?= $ETUDIANT['PRIX_FORMATION']?>F</td>
                    <td>
                        <a href="detailEtudiant.php?ID_ETUDIANT=<?= $ETUDIANT['ID_ETUDIANT'] ?>" class="btn btn-light">Voir Plus</a>
                        <a href="modifierEtu.php?ID_ETUDIANT=<?= $ETUDIANT['ID_ETUDIANT'] ?>" class="btn btn-success py-1 mt-1">Modifier</a>
                        <a href="supprimeretu.php?ID_ETUDIANT=<?= $ETUDIANT['ID_ETUDIANT'] ?>" class="btn btn-danger py-1 mt-1">Supprimer</a>
                    </td>

                </tr>
            </tbody>
            <?php
            }
            ?>
        </table>
        <div class="row  justify-content-end align-items-end">
            <a href="inscriptionetuds.php" class="btn btn-info w-25 float-end text-white text-uppercase text-center">Ajouter</a>
        </div>
    </div>