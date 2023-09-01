<?php

    session_start();
    // On inclus le fichier de connection a la base de donnees.
    require_once('connect.php');

    require_once('header.php');

    $requete = 'SELECT * FROM SECRETAIRE';
    //on prepare la requete
    $query = $db->prepare($requete);
    //on excecute la requete
    $query->execute();
    //on stock les donnees les donnes dans une variable
    $resultat = $query->fetchAll(PDO::FETCH_ASSOC);
    //requete pour les etudiants



?>  
<div class="col-12 container mt-4 py-5">
        <h2 class="text-center text-warning">Table Secretaire</h2>
        <table class="table border">
           
            <thead>
                <th>ID_TYPE_COMPTE</th>
                <th>NUMERO_TEL</th>
                <th>NOM_UTILISATEUR</th>
                <th>INFORMATIONS</th>

            </thead>
            <tbody>
            <?php
            foreach($resultat as $SECRET){  
                $_SESSION['ID']=$SECRET['ID_TYPE_COMPTE'] ;
                $_SESSION['NOM']=$SECRET['NOM_UTILISATEUR'] ;

            ?>
                <tr>
                    <td><?= $SECRET['ID_TYPE_COMPTE']?></td>
                    <td><?= $SECRET['NUMERO_TEL']?></td>
                    <td><?= $SECRET['NOM_UTILISATEUR']?></td>
                    <td>
                        <a href="details.php?ID_TYPE_COMPTE=<?= $SECRET['ID_TYPE_COMPTE'] ?>" class="btn btn-light">Voir Plus</a>
                        <a href="modifier.php?ID_TYPE_COMPTE=<?= $SECRET['ID_TYPE_COMPTE'] ?>" class="btn btn-success py-1 mt-1">Modifier</a>
                        <a href="supprimerset.php?ID_TYPE_COMPTE=<?= $SECRET['ID_TYPE_COMPTE'] ?>" class="btn btn-danger py-1 mt-1">Supprimer</a>
                    </td>

                </tr>
            </tbody>
            <?php
            }
            ?>
        </table>
        <div class="row  justify-content-end align-items-end">
            <a href="inscriptionpers.php" class="btn btn-info w-25 float-end text-white text-uppercase text-center">Ajouter</a>
        </div>
    </div>
    <div class="row py-4 ms-5">
        <input type="button" value="Retour" class="text-light float-start w-25 btn btn-success" onclick="history.back()">
    </div>
<?php
    require_once('footer.php');
?>
    