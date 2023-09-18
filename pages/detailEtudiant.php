<?php
session_start();
//on require le header pour l'entete de la page
$ID_TYPE_COMPTE = $_SESSION['ID_TYPE_COMPTE'];
$MOT = 'ADMIN';
$resultat = strstr($ID_TYPE_COMPTE,$MOT);
// if($resultat===false){
//     require_once('headerset.php');
// }else{
//     require_once('C:\xampp12\htdocs\ProjetGit\layout\headeradmin.php');
// }

// On inclus le fichier de connection a la base de donnees.
require_once('C:\xampp12\htdocs\ProjetGit\layout\connect.php');

$message_erreur = "L'id inscript n'existe pas";
if(isset($_GET['ID_ETUDIANT'])){
    $ID_ETUDIANT =$_GET['ID_ETUDIANT'];

    $requete = 'SELECT * FROM ETUDIANTS etu JOIN FORMATIONS ft ON etu.CHOIX_FORMATION = ft.ID_FORMATION WHERE ID_ETUDIANT = ?';
    //on prepare la requete
    $query = $db->prepare($requete);
    //on excecute la requete
    $query->execute(array($ID_ETUDIANT));
    //on stock les donnees les donnes dans une variable
    $ETUDIANT = $query->fetch();
    if(!$ETUDIANT){   
        header('Location:admin.php');
        $message ="<h1 class='text-center text-danger border text-uppercase mt-5 py-5'> $message_erreur</h1>";
    }
 
} else{
    header('Location:pagesadmin\admin.php');
}



?>





<div class="container mt-5 py-5">
        <div class="col-1 py-2 ms-5 mt-1  fixed-top mt-5 py-5">
            <button type="button"  class="text-warning float-start bg-success btn " onclick="history.back()"><i class="bi bi-arrow-left-short icon-link-hover"></i></button>
        </div>
        
        <div class="card mb-3 justify-content-center align-items-center" style="max-width: 100%;">
            <div class="row g-0">
                <div class="col-md-4" style="max-width: 100%;">
                    <img src="images\<?= $ETUDIANT['PHOTO']?>" class="img-fluid rounded-start img-thumbnails" alt="image etudiant  <?= $ETUDIANT['NOM_PRENOMS'] ?>">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                    <h2 class="text-center text-warning">Informations Etudiant <?php echo $ETUDIANT['NOM_PRENOMS']; ?></h2>
                    
                    <h4 class="text-center">ID_COMPTE :<?= $ETUDIANT['ID_ETUDIANT']?></h4>
                    <h4 class="text-center">NUMERO TEL :<?= $ETUDIANT['NUM_TEL']?></h4>
                    <h4 class="text-center">EMAIL :<?= $ETUDIANT['EMAIL']?></h4>
                    <h4 class="text-center">NOM PRENOMS :<?= $ETUDIANT['NOM_PRENOMS']?></h4>
                    <h4 class="text-center">DATE NAISSANCE :<?= $ETUDIANT['DATE_NAISSANCE']?></h4>
                    <h4 class="text-center">SEXE :<?= $ETUDIANT['SEXE']?></h4>
                    <h4 class="text-center">ADRESSE : <?= $ETUDIANT['ADRESSE']?></h4> 
                    <h4 class="text-center">DATE DEBUT : <?= $ETUDIANT['DATE_DEBUT']?></h4> 
                    <h4 class="text-center">CHOIX FORMATION :<?= $ETUDIANT['NOM_FORMATION']?></h4>
                    <h4 class="text-center">PRIX_FORMATION : <?= $ETUDIANT['PRIX_FORMATION']?>F</h4> 
                    <h4 class="text-center">MONTANT DEJA PAYE : <?= $ETUDIANT['MONTANT_PAYE']?>F</h4> 
                </div>
                </div>
                <a href="modifierEtu.php?ID_ETUDIANT=<?= $ETUDIANT['ID_ETUDIANT'] ?>" class="btn btn-success py-1 float-end mt-1">Modifier</a>
            </div>
        </div>
            

    </div>
    

<?php
    require_once('C:\xampp12\htdocs\ProjetGit\layout\footer.php');
?>