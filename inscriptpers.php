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


require_once('connect.php');

$ID_TYPE_COMPTE  = $_SESSION['ID_TYPE_COMPTE'];
$DATE_NAISSANCE = $_SESSION['DATE_NAISSANCE'];
$ERREUR = 0;
$message_erreur = '';
$nom = '';
$mot_passe = '';
$repete_mot_passe = '';
if(isset($_POST['envoi'])){
    $NOM_UTILISATEUR = $_POST['NOM_UTILISATEUR'];
    $MOT_DE_PASSE = $_POST['MOT_DE_PASSE'];
    $REPETE = $_POST['MOT_DE_PASSE2'];

    if(strlen($NOM_UTILISATEUR)<=8 || !preg_match('/^[A-Z][a-zA-Z\s]+$/',$NOM_UTILISATEUR)){
        $nom= "veillez remplir le champ d'au moins 9 caracteres";
        $ERREUR++;
    }else if(strlen($MOT_DE_PASSE)<=8 || !preg_match('/^[A-Z][a-zA-Z\s]+$/', $MOT_DE_PASSE)){
        $mot_passe = "le mot  de passe ne contient pas tout les caractere ou il est trop vulgaire";
        $ERREUR++;
    }else if ($REPETE!=$MOT_DE_PASSE) {
        $repete_mot_passe = "desole les deux mot de passe ne correspondent pas";
        $ERREUR++;
        
    }elseif ($ERREUR<=0) {
        $EMAIL = $_SESSION['EMAIL'];
        $NUMERO_TEL = $_SESSION['NUMERO_TEL'];
        $NOM_PRENOMS = $_SESSION['NOM_PRENOMS'];
        $SEXE = $_SESSION['SEXE'];
        $ADRESSE = $_SESSION['ADRESSE'];
        echo "$NOM_PRENOMS";
    
        $requete = 'INSERT INTO secretaire(ID_TYPE_COMPTE,ID_COMPTE,NUMERO_TEL,EMAIL,NOM_UTILISATEUR,MOT_DE_PASSE,NOM_PRENOMS,DATE_NAISSANCE,SEXE,ADRESSE) VALUES
        (:ID_TYPE_COMPTE,:ID_COMPTE,:NUMERO_TEL,:EMAIL,:NOM_UTILISATEUR,:MOT_DE_PASSE,:NOM_PRENOMS,:DATE_NAISSANCE,:SEXE,:ADRESSE)';

        $stmt = $db->prepare($requete);
        $stmt->bindParam(":ID_TYPE_COMPTE",$_SESSION['ID_TYPE_COMPTE'],PDO::PARAM_STR);
        $stmt->bindParam(":ID_COMPTE",$_SESSION['ID_COMPTE'],PDO::PARAM_STR);
        $stmt->bindParam(":NUMERO_TEL",$_SESSION['NUMERO_TEL'],PDO::PARAM_INT);
        
        $stmt->bindParam(":EMAIL",$_SESSION['EMAIL'],PDO::PARAM_STR);
        $stmt->bindParam(":NOM_UTILISATEUR",$_POST['NOM_UTILISATEUR'],PDO::PARAM_STR);
        $stmt->bindParam(":MOT_DE_PASSE",$_POST['MOT_DE_PASSE'],PDO::PARAM_STR);
        
        $stmt->bindParam(":NOM_PRENOMS",$_SESSION['NOM_PRENOMS'],PDO::PARAM_STR);
        $stmt->bindParam(":DATE_NAISSANCE",$_SESSION['DATE_NAISSANCE']);
        $stmt->bindParam(":SEXE",$_SESSION['SEXE'],PDO::PARAM_STR);
        $stmt->bindParam(":ADRESSE",$_SESSION['ADRESSE'],PDO::PARAM_STR);
        $stmt->execute();

        $_SESSION['NOM_UTILISATEUR'] = $NOM_UTILISATEUR;
        
        header('location:details.php');
    }
    
}

?>


<div class="container mt-5 py-5">
        <div class="col-1 py-2 ms-5 mt-1">
            <button type="button"  class="text-warning float-start bg-success btn " onclick="history.back()"><i class="bi bi-arrow-left-short icon-link-hover"></i></button>
        </div>
        <div class="row  justify-content-center align-items-center w-100 py-2 mt-2">
                <form action="" method="post" class =" w-50 bg-light">
                <h1 class ="text-center text-uppercase text-info mt-3 py-3">configuration compte  admin</h1>
                <h3 class ="text-center text-uppercase text-info mt-3 py-3"><?php echo $_SESSION['ID_TYPE_COMPTE'];echo $_SESSION['DATE_NAISSANCE'];?></h3>

                <div class="mt-3">
                    <label for="NOM_UTILISTEUR" class="form-label">NOM UTILISATEUR</label>
                    <input type="" name="NOM_UTILISATEUR" id="NOM_UTILISATEUR" class="form-control">
                    <h5 class ="text-center text-danger mt-2 text-uppercase"><?php echo $nom; ?></h5>

                </div>

                <div class="mt-3">
                    <label for="MOT_DE_PASSE" class="form-label">MOT DE PASSE</label>
                    <input type="password" name="MOT_DE_PASSE" id="MOT_DE_PASSE" class="form-control">
                    <h5 class ="text-center text-danger mt-2 text-uppercase"><?php echo $mot_passe; ?></h5>
                </div>

                <div class="mt-3">
                    <label for="MOT_DE_PASSE2" class="form-label">REPETE MOT DE PASSE</label>
                    <input type="password" name="MOT_DE_PASSE2" id="MOT_DE_PASSE2" class="form-control">
                    <h5 class ="text-center text-danger mt-2 text-uppercase"><?php echo $repete_mot_passe; ?></h5>
                </div>

                <div class="mt-3 d-flex justify-content-center align-items-center w-100 py-4">
                    <input type="submit" value="Envoyer" class="btn btn-success w-50" name="envoi">
                </div> 
                <h5 class ="text-center text-danger mt-2 text-uppercase"><?php echo $message_erreur; ?></h5>


            </form>
        </div>
    </div>
    
    

<?php
    //on require le footer pour le pied de page
    require_once('footer.php');
?>