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

if(isset($_GET['ID_TYPE_COMPTE'])){
    $ID_TYPE_COMPTE =$_GET['ID_TYPE_COMPTE'];

    $requete = 'SELECT * FROM ADMINISTRATEUR WHERE ID_TYPE_COMPTE = ?';
    //on prepare la requete
    $query = $db->prepare($requete);
    //on excecute la requete
    $query->execute(array($ID_TYPE_COMPTE));
    //on stock les donnees les donnes dans une variable
    $ADMIN = $query->fetch();
} 
else{
    header('Location:index.php');
}



?>





<div class="col-1 py-4 ms-5">
    <button type="button"  class="text-warning float-start bg-success btn " onclick="history.back()"><i class="bi bi-arrow-left-short icon-link-hover"></i></button>
</div>
    <div class="container mt-5 py-5">

        <h2 class="text-center text-warning">Informations Administrateur  <?php echo $ADMIN['NOM_UTILISATEUR']; ?></h2>
      

            <h4>ID_TYPE_COMPTE :<?= $ADMIN['ID_TYPE_COMPTE']?></h4>
            <h4>ID_COMPTE :<?= $ADMIN['ID_COMPTE']?></h4>
            <h4>NUMERO_TEL :<?= $ADMIN['NUMERO_TEL']?></h4>
            <h4>EMAIL :<?= $ADMIN['EMAIL']?></h4>
            <h4>NOM_UTILISATEUR :<?= $ADMIN['NOM_UTILISATEUR']?></h4>
            <h4>NOM_PRENOMS :<?= $ADMIN['NOM_PRENOMS']?></h4>
            <h4>DATE_NAISSANCE :<?= $ADMIN['DATE_NAISSANCE']?></h4>
            <h4>SEXE :<?= $ADMIN['SEXE']?></h4>
            <h4>ADRESSE : <?= $ADMIN['ADRESSE']?></h4> 
      
      
    </div>
    <div class="row  justify-content-end align-items-end">
            <a href="modifier.php?ID_TYPE_COMPTE=<?= $ADMIN['ID_TYPE_COMPTE']?>" class="btn btn-info w-25 float-end text-white text-uppercase text-center">Modifier Profile</a>
    </div>
    
    
<?php
    require_once('footer.php');
?>