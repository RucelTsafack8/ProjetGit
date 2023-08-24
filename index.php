<?php
session_start();
//on require le header pour l'entete de la page
$ID_TYPE_COMPTE = $_SESSION['ID_TYPE_COMPTE'];
$MOT = 'ADMIN';
$resultat = strstr($ID_TYPE_COMPTE,$MOT);
if($resultat===false){
    require_once('headerset.php');
}else{
    require_once('header.php');
}

//require once le fichier conect pour la connexion a la base de dennees
require_once('connect.php');

?>

<body>
    <div class="container mt-5 py-5">
        <div class="row">
            <h1 class="text-center text-info text-uppercase">systeme de gestion de 3IA </h1>
            <h1 class="text-center text-info text-uppercase">bonjour  <?php  echo $_SESSION['NOM_UTILISATEUR']; ?> </h1>
        </div>
    </div>
    <div class="mt-3 d-flex justify-content-center align-items-center w-100 py-4">
        <a href="deconnexion.php" class="btn btn-success w-50" name="envoi">Deconnexion</a>
    </div> 
    
</body>
</html>
<?php
    //on require le footer pour le pied de page
    require_once('footer.php');
?>