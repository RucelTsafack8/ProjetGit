<?php
    require_once('connect.php');


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SYSTEME DE 3IA</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css\bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome-free-6.4.0-web\css\all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
     crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row mt-4 py-5 d-flex w-100 justify-content-center align-items-center">
            <h1 class="text-center text-white text-uppercase mt-4 py-4">
                bienvenue dans le systeme de gestion de gestion de 3IA !
            </h1>
            <p class="text-center text-light text-uppercase py-3">veuillez vous connectez</p>
            <a href="connexion.php " class="text-center btn btn-success py-2 w-25 float-center">connexion</a>
        </div>
    </div>
</body>


<?php
    require_once('footer.php');
?>