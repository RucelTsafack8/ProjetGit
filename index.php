<?php
session_start();
//on require le header pour l'entete de la page
require_once('header.php');
require_once('style.css');

//require once le fichier conect pour la connexion a la base de dennees
require_once('connect.php');

?>

<body>
    <div class="container mt-5 py-5">
        <div class="row">
            <h1 class="text-center text-info text-uppercase">systeme de gestion de 3IA <?php  echo $_SESSION['NOM_UTILISATEUR'];?></h1>
        </div>
    </div>
    <div class="mt-3 d-flex justify-content-center align-items-center w-100 py-4">
        <a href="connexion.php" class="btn btn-success w-50" name="envoi">Deconnexion</a>
    </div> 
    
</body>
</html>
<?php
    //on require le footer pour le pied de page
    require_once('footer.php');
?>