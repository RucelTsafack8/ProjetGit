<?php
session_start();
// On inclus le fichier de connection a la base de donnees.
require_once('connect.php');

require_once('header.php');





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
    
   
    <div class="mt-3 d-flex justify-content-center align-items-center w-100 py-4">
        <a href="deconnexion.php" class="btn btn-success w-50" name="envoi">Deconnexion</a>
    </div>
</body>
</html>
<?php
    require_once('footer.php');
?>