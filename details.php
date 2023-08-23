<?php
session_start();
//on require le header pour l'entete de la page
require_once('header.php');
//on require le footer pour le pied de page
require_once('footer.php');
// On inclus le fichier de connection a la base de donnees.
require_once('connect.php');

if(isset($_GET['ID_TYPE_COMPTE'])){
    $ID_TYPE_COMPTE =$_GET['ID_TYPE_COMPTE'];
    $NOM_UTILISATEUR =$_GET['NOM_UTILISATEUR'];

    $requete = 'SELECT * FROM SECRETAIRE WHERE ID_TYPE_COMPTE = ?';
    //on prepare la requete
    $query = $db->prepare($requete);
    //on excecute la requete
    $query->execute(array($ID_TYPE_COMPTE));
    //on stock les donnees les donnes dans une variable
    $SECRET = $query->fetch();
    if(!$SECRET){   
        header('Location:admin.php');
    }
 
} else{
    header('Location:admin.php');
}



?>




<body>
    <div class="container mt-5 py-5">

        <h2 class="text-center text-warning">Informations Secretaire  <?php echo $SECRET['NOM_UTILISATEUR']; ?></h2>
        <table class="table  border-success">

            <h4>ID_TYPE_COMPTE :<?= $SECRET['ID_TYPE_COMPTE']?></h4>
            <h4>ID_COMPTE :<?= $SECRET['ID_COMPTE']?></h4>
            <h4>NUMERO_TEL :<?= $SECRET['NUMERO_TEL']?></h4>
            <h4>EMAIL :<?= $SECRET['EMAIL']?></h4>
            <h4>NOM_UTILISATEUR :<?= $SECRET['NOM_UTILISATEUR']?></h4>
            <h4>NOM_PRENOMS :<?= $SECRET['NOM_PRENOMS']?></h4>
            <h4>DATE_NAISSANCE :<?= $SECRET['DATE_NAISSANCE']?></h4>
            <h4>SEXE :<?= $SECRET['SEXE']?></h4>
            <h4>ADRESSE : <?= $SECRET['ADRESSE']?></h4> 
      
        </table>
    </div>
    
</body>
</html>
<?php
    require_once('footer.php');
?>