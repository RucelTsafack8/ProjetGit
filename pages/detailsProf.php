<?php
session_start();
//on require le header pour l'entete de la page
$ID_TYPE_COMPTE = $_SESSION['ID_TYPE_COMPTE'];
$MOT = 'ADMIN';
$resultat = strstr($ID_TYPE_COMPTE,$MOT);
if($resultat===false){
    require_once('headerset.php');
}else{
    require_once('C:\xampp12\htdocs\ProjetGit\layout\headeradmin.php');
}

// On inclus le fichier de connection a la base de donnees.
require_once('C:\xampp12\htdocs\ProjetGit\layout\connect.php');

$message_erreur = "L'id inscript n'existe pas";
if(isset($_GET['ID_PROFESSEUR'])){
    $ID_PROFESSEUR =$_GET['ID_PROFESSEUR'];

    $requete = 'SELECT * FROM PROFESSEURS WHERE ID_PROFESSEUR = ?';
    //on prepare la requete
    $query = $db->prepare($requete);
    //on excecute la requete
    $query->execute(array($ID_PROFESSEUR));
    //on stock les donnees les donnes dans une variable
    $PROF = $query->fetch();
    if(!$PROF){   
        header('Location:admin.php');
        $message ="<h1 class='text-center text-danger border text-uppercase mt-5 py-5'> $message_erreur</h1>";
    }
 
} else{
    header('Location:admin.php');
}



?>





<div class="container mt-5 py-5">
        <div class="col-1 py-2 ms-5 mt-1  fixed-top mt-5 py-5">
            <a  class="text-warning float-start bg-success btn " href="donneeprof.php"><i class="bi bi-arrow-left-short icon-link-hover"></i></a>

        </div>
        <h2 class="text-center text-warning">Informations Profersseur <?php echo $PROF['NOM_PRENOMS']; ?></h2>

            <h4>ID_PROFESSEUR :<?= $PROF['ID_PROFESSEUR']?></h4>
            <h4>NUMERO TEL :<?= $PROF['NUMERO_TEL']?></h4>
            <h4>EMAIL :<?= $PROF['EMAIL']?></h4>
            <h4>ENSEIGNANT FORMATION :<?= $PROF['FONCTIONS']?></h4>
            <h4>NOM PRENOMS :<?= $PROF['NOM_PRENOMS']?></h4>
            <h4>DATE NAISSANCE :<?= $PROF['DATE_NAISSANCE']?></h4>
            <h4>SEXE :<?= $PROF['SEXE']?></h4>
            <h4>ADRESSE : <?= $PROF['ADRESSE']?></h4> 
            <h4>DATE DEBUT : <?= $PROF['DATE']?></h4> 

    </div>
   
     
<?php
    require_once('C:\xampp12\htdocs\ProjetGit\layout\footer.php');
?>