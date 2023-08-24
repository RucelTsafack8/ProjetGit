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
if(isset($_GET['ID_ETUDIANT'])){
    $ID_ETUDIANT =$_GET['ID_ETUDIANT'];

    $requete = 'SELECT * FROM ETUDIANTS WHERE ID_ETUDIANT = ?';
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
    header('Location:admin.php');
}



?>




<body>
    <div class="container mt-5 py-5">
        <h2 class="text-center text-warning">Informations Etudiant <?php echo $ETUDIANT['NOM_PRENOMS']; ?></h2>

            <h4>ID_COMPTE :<?= $ETUDIANT['ID_ETUDIANT']?></h4>
            <h4>NUMERO TEL :<?= $ETUDIANT['NUM_TEL']?></h4>
            <h4>EMAIL :<?= $ETUDIANT['EMAIL']?></h4>
            <h4>NOM PRENOMS :<?= $ETUDIANT['NOM_PRENOMS']?></h4>
            <h4>DATE NAISSANCE :<?= $ETUDIANT['DATE_NAISSANCE']?></h4>
            <h4>SEXE :<?= $ETUDIANT['SEXE']?></h4>
            <h4>ADRESSE : <?= $ETUDIANT['ADRESSE']?></h4> 
            <h4>DATE DEBUT : <?= $ETUDIANT['DATE_DEBUT']?></h4> 
            <h4>CHOIX FORMATION :<?= $ETUDIANT['CHOIX_FORMATION']?></h4>
            <h4>PRIX_FORMATION : <?= $ETUDIANT['PRIX_FORMATION']?>F</h4> 


    </div>
    
</body>
</html>
<?php
    require_once('footer.php');
?>