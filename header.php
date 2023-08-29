<?php
// session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SYSTEME DE 3IA</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="fontawesome-free-6.4.0-web\css\all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="css\bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
     crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" 
     integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" 
     integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</head>
<body>
    <header class= "fixed-top">
        <div class="">
            <nav class="navbar navbar-expand-lg bg-primary">
                <div class="container-fluid">
                    <a class="navbar-brand" href="admin.php">SIR_TECH-3IA</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                            <a class="nav-link active fs-3" aria-current="page" href="index.php">Accueil</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link  fs-3" href="index.php">Dashbord</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fs-3 "  href="detailadmin.php?ID_TYPE_COMPTE=<?= $_SESSION['ID_TYPE_COMPTE'] ?>"><i class="fa-solid fa-circle-user"></i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link  fs-3" href="deconnexion.php">Deconnexion</a>
                            </li>
                        </ul>
                        
                    </div>
                </div>
            </nav>
        </div>
    </header>
