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

$reqs='SELECT COUNT(*) as totalset FROM secretaire';
$set = $db->prepare($reqs);
$set ->execute();
$totalset = $set->fetch()['totalset'];

$reqe='SELECT COUNT(*) as totaletu FROM etudiants';
$etu = $db->prepare($reqe);
$etu ->execute();
$totaletu = $etu->fetch()['totaletu'];

$reqstage='SELECT COUNT(*) as totalstage FROM stagiaire';
$stage = $db->prepare($reqstage);
$stage ->execute();
$totalstage = $stage->fetch()['totalstage'];

$reqprof='SELECT COUNT(*) as totalprof FROM professeurs';
$prof = $db->prepare($reqprof);
$prof ->execute();
$totalprof = $prof->fetch()['totalprof'];
    $MONTANT=0;
   $ret_etude = 'SELECT PRIX_FORMATION FROM  etudiants';
   $selet = $db->prepare($ret_etude);
   $selet->execute();
    while($prix = $selet->fetch()){
        $MONTANT +=$prix['PRIX_FORMATION'] ;
    }
    //on fait la meme chose pour la table stagiaire et on fait la somme
    $MONTANT1=0;
   $ret_stage = 'SELECT PRIX_FORMATION FROM  STAGIAIRE';
   $selet = $db->prepare($ret_stage);
   $selet->execute();
    while($prix = $selet->fetch()){
        $MONTANT1 +=$prix['PRIX_FORMATION'] ;
    }
   $MONTANTS= $MONTANT1+$MONTANT;



?>

<body>
    <div class="container mt-5 py-5">
        <div class="row">
            <h1 class="text-center text-info text-uppercase">systeme de gestion de 3IA </h1>
            <h1 class="text-center text-info text-uppercase">bonjour  <?php  echo $_SESSION['NOM_UTILISATEUR']; ?> </h1>
        </div>
    
        <div class="row">
            <div class="col-2">
                <div class="card bg-info mt-1 py-1">
                    <div class="card-body">
                        <h5 class="card-title">Secretaires</h5>
                        <h5 class="card-text"> <?= $totalset ?></h5>
                        <a href="donneeset.php" class="btn btn-primary">Details</a>
                    </div>
                </div>
            </div>
            <div class="col-2">
                
                <div class="card bg-success mt-1 py-1">
                    <div class="card-body ">
                        <h5 class="card-title">Etudiants</h5>
                        <h5 class="card-text"> <?= $totaletu ?></h5>
                        <a href="donneeetu.php" class="btn btn-primary">Details</a>
                    </div>
                </div>
            </div>
            <div class="col-2">
                
            </div>
            <div class="col-2">
                
                <div class="card bg-light mt-1 py-1">
                    <div class="card-body ">
                        <h5 class="card-title">MONTANT TOTAL</h5>
                        <h5 class="card-text text-danger"> <?= $MONTANTS ?> Franc CFA</h5>
                        <a href="detailargent.php" class="btn btn-secondary">Details</a>
                        
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-2">
                <div class="card mt-1 py-1">
                    <div class="card-body">
                        <h5 class="card-title">Professeurs</h5>
                        <h5 class="card-text"> <?= $totalprof ?> </h5>
                        <a href="donneeprof.php" class="btn btn-primary">Details</a>
                    </div>
                </div>
            </div>
            <div class="col-2">
            
                <div class="card bg-warning mt-1 py-1">
                    <div class="card-body ">
                        <h5 class="card-title">STAGIAIRES</h5>
                        <h5 class="card-text"> <?= $totalstage ?></h5>
                        <a href="donneestage.php" class="btn btn-primary">Details</a>
                    </div>
                </div>
            </div>
        </div>
        
        
    </div>  
</body>
</html>
<?php
    //on require le footer pour le pied de page
    require_once('footer.php');
?>