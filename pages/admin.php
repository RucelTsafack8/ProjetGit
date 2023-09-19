<?php
session_start();
//on require le header pour l'entete de la page

$ID_TYPE_COMPTE = $_SESSION['ID_TYPE_COMPTE'];

require_once('C:\xampp12\htdocs\ProjetGit\layout\headeradmin.php');

$NOM_UTILISATEUR = $_SESSION['NOM_UTILISATEUR'];
//require once le fichier conect pour la connexion a la base de dennees
require_once('C:\xampp12\htdocs\ProjetGit\layout\connect.php');


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

//requete de calcul des depenses effectuer
$ret_depense = 'SELECT PRIX_DEPENSE FROM  DEPENSES';
$seletdep = $db->prepare($ret_depense);
$seletdep->execute();
$MONTANTDEP=0;
while($prixdep = $seletdep->fetch()){
    $MONTANTDEP +=$prixdep['PRIX_DEPENSE'] ;
}
$totaldepenses=$MONTANTDEP;
//requete pour selectionner et calculer le montant des etudiants
$MONTANT=0;
$ret_etude = 'SELECT MONTANT_PAYE FROM  etudiants WHERE RECU_ACTION =1';
   $selet = $db->prepare($ret_etude);
   $selet->execute();
    while($prix = $selet->fetch()){
        $MONTANT +=$prix['MONTANT_PAYE'] ;
    }
    //on fait la meme chose pour la table stagiaire et on fait la somme
    $MONTANT1=0;
    //requete pour selectionner et calculer le montant des stagiaires
$ret_stage = 'SELECT PRIX_FORMATION FROM  STAGIAIRE WHERE RECU_ACTION =1';
   $selet = $db->prepare($ret_stage);
   $selet->execute();
    while($prix = $selet->fetch()){
        $MONTANT1 +=$prix['PRIX_FORMATION'] ;
    }
   $totalrecu= $MONTANT1+$MONTANT;

   $totalreste = $totalrecu-$totaldepenses



?>
<script>
    
</script>

<div class="container mt-5 py-5">
        <div class="col-1  py-1 ms-5 mt-1">
            <a  class="text-warning float-start bg-success btn " href="admin.php"><i class="bi bi-arrow-left-short icon-link-hover"></i></a>
        </div>
        <div class="row">
            <h1 class="text-center text-info text-uppercase">DASHBORD DE LA GESTION DE 3IA , <?= $ID_TYPE_COMPTE ?></h1>
            
        </div>
    
        <div class="row">
            <div class="col-6 col-md-6 col-lg-3">
                <div class="card bg-info mt-1 py-1"  id ="secretaire">
                    <div class="card-body">
                        <h5 class="card-title">Secretaires</h5>
                        <h5 class="card-text"> <?= $totalset ?></h5>
                        <a href="donneeset.php" class="btn btn-primary float-end"><i class="bi bi-plus-lg"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-6 col-lg-3" >
                
                <div class="card bg-light mt-1 py-1" id="etudiant">
                    <div class="card-body ">
                        <h5 class="card-title">Etudiants</h5>
                        <h5 class="card-text"> <?= $totaletu ?></h5>
                        <a href="donneeetu.php" class="btn btn-primary float-end"><i class="bi bi-plus-lg"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-2">
                
            </div>
            <div class="col-6 col-md-6 col-lg-3" >
                
                <div class="card bg-success mt-1 py-1 " id="montant_enter">
                    <div class="card-body ">
                        <h5 class="card-title">MONTANT TOTAL ENTRE</h5>
                        <h5 class="card-text text-white"> <?= $totalrecu ?> Francs CFA</h5>
                        <a href="detailargent.php" class="btn btn-secondary float-end"><i class="bi bi-plus-lg"></i></a>
                        
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-6 col-md-6 col-lg-3 " >
                <div class="card mt-1 py-1 " id="professeur">
                    <div class="card-body">
                        <h5 class="card-title">Professeurs</h5>
                        <h5 class="card-text"> <?= $totalprof ?> </h5>
                        <a href="donneeprof.php" class="btn btn-primary float-end"><i class="bi bi-plus-lg"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-6 col-lg-3" >
            
                <div class="card bg-warning mt-1 py-1" id="stagiare">
                    <div class="card-body ">
                        <h5 class="card-title">STAGIAIRES</h5>
                        <h5 class="card-text"> <?= $totalstage ?></h5>
                        <a href="donneestage.php" class="btn btn-primary float-end"><i class="bi bi-plus-lg"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-2">

            </div>
            <div class="col-6 col-md-6 col-lg-3" >
            
                <div class="card bg-danger mt-1 py-1" id="montant_sortie">
                    <div class="card-body ">
                        <h5 class="card-title">MONTANT TOTAL SORTIE</h5>
                        <h5 class="card-text text-white"> <?= $totaldepenses ?> Francs CFA</h5>
                        <a href="detailsdepense.php" class="btn btn-primary float-end"><i class="bi bi-plus-lg"></i></a>
                    </div>
                </div>
            </div>
        </div>

            <div class="row">
                <div class="col-6 col-md-6 col-lg-3">

                </div>
                <div class="col-6 col-md-6 col-lg-3">
                
                </div>
                <div class="col-2">

                </div>
                <div class="col-6 col-md-6 col-lg-3">
            
                <div class="card bg-warning mt-1 py-1">
                    <div class="card-body ">
                        <h5 class="card-title">MONTANT TOTAL RESTANT</h5>
                        <h5 class="card-text text-white"> <?= $totalreste ?> Francs CFA</h5>
                        <h2></h2> <br>
                        <h2></h2>
                    </div>
                </div>
            </div>
            </div>
        
        
    </div>  
</body>
</html>
<?php
    //on require le footer pour le pied de page
    require_once('C:\xampp12\htdocs\ProjetGit\layout\footer.php');
?>