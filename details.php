<?php
session_start();
//on require le header pour l'entete de la page
require_once('header.php');

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>page d'acceuil admin</title>
    <link rel="stylesheet" href="css\bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
     crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5 py-5">
        <div class="row">
            <div class="text-info"> BIENVENUE SUR VOTRE PAGE D'acceuil<?php echo $_SESSION['NOM_UTILISATEUR']?></div>
        </div>
    </div>
    
</body>
</html>