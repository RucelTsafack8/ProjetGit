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
//on require le footer pour le pied de page
require_once('footer.php');
// On inclus le fichier de connection a la base de donnees.
require_once('connect.php');
$message_erreur = "L'id inscript n'existe pas";
if(isset($_GET['ID_STAGIAIRE'])){
    $ID_STAGIAIRE =$_GET['ID_STAGIAIRE'];

    $requete = 'SELECT * FROM stagiaire WHERE ID_STAGIAIRE = ?';
    //on prepare la requete
    $query = $db->prepare($requete);
    //on excecute la requete
    $query->execute(array($ID_STAGIAIRE));
    //on stock les donnees les donnes dans une variable
    $STAGE = $query->fetch();
    if(!$STAGE){   
        header('Location:admin.php');
        $message ="<h1 class='text-center text-danger border text-uppercase mt-5 py-5'> $message_erreur</h1>";
    }
 
} else{
    header('Location:admin.php');
}



?>





<div class="container mt-5 py-5">
        <div class="col-1 py-2 ms-5 mt-1">
            <button type="button"  class="text-warning float-start bg-success btn " onclick="history.back()"><i class="bi bi-arrow-left-short icon-link-hover"></i></button>
        </div>
        <h2 class="text-center text-warning">Informations Stagiaire <?php echo $STAGE['NOM_PRENOMS']; ?></h2>

            <h4>ID_COMPTE :<?= $STAGE['ID_STAGIAIRE']?></h4>
            <h4>NUMERO TEL :<?= $STAGE['NUMERO_TEL']?></h4>
            <h4>EMAIL :<?= $STAGE['EMAIL']?></h4>
            <h4>NOM PRENOMS :<?= $STAGE['NOM_PRENOMS']?></h4>
            <h4>DATE NAISSANCE :<?= $STAGE['DATE_NAISSANCE']?></h4>
            <h4>SEXE :<?= $STAGE['SEXE']?></h4>
            <h4>ADRESSE : <?= $STAGE['ADRESSE']?></h4> 
            <h4>DATE DEBUT : <?= $STAGE['DATE_DEBUT']?></h4> 
            <h4>ECOLE DE FORMATION:<?= $STAGE['CAMPUS']?></h4>
            <h4>FILIERE D'ETUDE :<?= $STAGE['FILIERE']?></h4>
            <h4>NIVEAU D'ETUDE :<?= $STAGE['NIVEAU']?></h4>
            <h4>PRIX_STAGE : <?= $STAGE['PRIX_FORMATION']?>F</h4> 


    </div>
    
    

<?php
    require_once('footer.php');
?>