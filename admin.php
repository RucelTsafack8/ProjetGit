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
$requete2 = 'SELECT * FROM ETUDIANTS';
//on prepare la requete
$stn = $db->prepare($requete2);
//on excecute la requete
$stn->execute();
//on stock les donnees les donnes dans une variable
$result_etudiant = $stn->fetchAll(PDO::FETCH_ASSOC);
//requetes pour les professeurs
$requete3 = 'SELECT * FROM professeurs';
//on prepare la requete
$stm = $db->prepare($requete3);
//on excecute la requete
$stm->execute();
//on stock les donnees les donnes dans une variable
$result_prof = $stm->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SYSTEME 3IA / DASHBORD</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css\bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
     crossorigin="anonymous">
</head>
<body>
    <h1 class="text-center text-info mt-2 py2 text-uppercase">Dashbord</h1>
    <!-- premier tableau pour la secretaire -->
    <div class="col-12 container">
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
                        <a href="modifier.php?ID_TYPE_COMPTE=<?= $SECRET['ID_TYPE_COMPTE'] ?>" class="btn btn-light py-1 mt-1">Modifier</a>
                    </td>

                </tr>
            </tbody>
            <?php
            }
            ?>
        </table>
    </div>
    <!-- tableau des etudiants -->
    <div class="col-12 container">
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
                        <a href="modifierEtu.php?ID_ETUDIANT=<?= $ETUDIANT['ID_ETUDIANT'] ?>" class="btn btn-light py-1 mt-1">Modifier</a>
                    </td>

                </tr>
            </tbody>
            <?php
            }
            ?>
        </table>
    </div>
    <div class="col-12 container">
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
                        <a href="modifierProf.php?ID_PROFESSEUR=<?= $PROF['ID_PROFESSEUR'] ?>" class="btn btn-light py-1 mt-1">Modifier</a>
                    </td>

                </tr>
            </tbody>
            <?php
            }
            ?>
        </table>
    </div>
    <div class="mt-3 d-flex justify-content-center align-items-center w-100 py-4">
        <a href="deconnexion.php" class="btn btn-success w-50" name="envoi">Deconnexion</a>
    </div>
</body>
</html>
<?php
    require_once('footer.php');
?>