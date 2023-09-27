<?php
session_start();
//on require le header pour l'entete de la page
$ID_TYPE_COMPTE = $_SESSION['ID_TYPE_COMPTE'];
$MOT = 'ADMIN';
$resultat = strstr($ID_TYPE_COMPTE,$MOT);
if($resultat===false){
    require_once('C:\xampp12\htdocs\ProjetGit\layout\headerset.php');
}else{
    require_once('C:\xampp12\htdocs\ProjetGit\layout\headeradmin.php');

}

//require once le fichier conect pour la connexion a la base de dennees
require_once('C:\xampp12\htdocs\ProjetGit\layout\connect.php');

$ID_COMPTE=$_SESSION['ID_COMPTE'];

?>

<body>
    <div class="container mt-5 py-5">
        <div class="col-1 py-2 ms-5 mt-1  fixed-top mt-5 py-5">
            <button type="button"  class="text-warning float-start bg-success btn " onclick="history.back()"><i class="bi bi-arrow-left-short icon-link-hover"></i></button>
        </div>
        <div class="row">
            <h1 class="text-center text-info text-uppercase">systeme de gestion de 3IA </h1>
        </div>
    
        <div class="row">
            <div class="col-4">
                <div class="mt-3 d-flex justify-content-center align-items-center w-100 py-4">
                    <a href="inscriptionetude.php" class="btn btn-light w-50" name="envoi">Inscription Etudiant</a>
                </div>
            </div>
            <div class="col-4">
                <div class="mt-3 d-flex justify-content-center align-items-center w-100 py-4">
                    <a href="inscriptionstage.php" class="btn btn-info w-50 text-white" name="envoi">Inscription Stagiare</a>
                </div>
            </div>
            <div class="col-4">
                <div class="mt-3 d-flex justify-content-center align-items-center w-100 py-4">
                    <a href="depenseset.php" class="btn btn-success w-50" name="envoi">Depense argent</a>
                </div>
            </div>

        </div>
        <div class="row">
            
        </div>
<?php
    //on require le footer pour le pied de page
    require_once('C:\xampp12\htdocs\ProjetGit\layout\footer.php');
?>