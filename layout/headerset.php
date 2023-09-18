<?php
    session_start();
    require_once('connect.php');
    $NOM_UTILISATEUR=$_SESSION['NOM_UTILISATEUR'];
    $ID_COMPTE=$_SESSION['ID_COMPTE'];

    $req = 'SELECT * FROM SECRETAIRE se  join PERSONNELS  per ON per.ID_COMPTE=se.ID_COMPTE WHERE se.NOM_UTILISATEUR = ?';
    $stmt= $db->prepare($req);
    $stmt ->execute(array($NOM_UTILISATEUR));
    $SECRET = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SYSTEME DE 3IA</title>
    <link rel="stylesheet" href="ajax\style.css">
    <link rel="stylesheet" href="css\bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome-free-6.4.0-web\css\all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
     crossorigin="anonymous">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>
    <header class= "fixed-top">
    <div class="">
            <nav class="navbar navbar-expand-lg bg-primary">
                <div class="container-fluid">
                    <a class="navbar-brand" href="indexset.php"></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse d-flex justify-content-end me-3" id="navbarNavAltMarkup">
                        <div class="navbar-nav">
                            <a class="nav-link active fs-3" aria-current="page" href="indexset.php">Acceuil</a>
                            <a class="nav-link active fs-3" aria-current="page" href="details.php?ID_TYPE_COMPTE=<?= $_SESSION['ID_TYPE_COMPTE'] ?>"><img src="images\<?= $SECRET['PHOTO']?>" style="width:40px;height:35px;" class="img-fluid rounded-circle img-thumbnails" alt="image secretaire <?= $SECRET['NOM_PRENOMS'] ?>"></a>
                           
                            <a class="nav-link  fs-3" href="deconnexion.php">Deconnexion</a>
                            
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </header>