<?php
session_start();
//on require le header pour l'entete de la page
require_once('header.php');

require_once('connect.php');

$NOM_PRENOMS=$_SESSION['NOM_PRENOMS'];
$ID_TYPE_COMPTE  = $_SESSION['ID_TYPE_COMPTE'];
$ERREUR = 0;
$message_erreur = '';
$nom = '';
$mot_passe = '';
$repete_mot_passe = '';
if(isset($_POST['envoi'])){
    $NOM_UTILISATEUR = $_POST['NOM_UTILISATEUR'];
    $MOT_DE_PASSE = $_POST['MOT_DE_PASSE'];
    $REPETE =$MOT_DE_PASSE;


    if(strlen($NOM_UTILISATEUR)<=8 || !preg_match('/^[A-Z][a-zA-Z\s]+$/',$NOM_UTILISATEUR)){
        $nom= "veillez remplir le champ d'au moins 9 caracteres";
        $ERREUR++;
    }else if(strlen($MOT_DE_PASSE)<=8 || !preg_match('/^[A-Z][a-zA-Z\s]+$/', $MOT_DE_PASSE)){
        $mot_passe = "le mot  de passe ne contient pas tout les caractere ou il est trop vulgaire";
        $ERREUR++;
    }else if ($MOT_DE_PASSE!=$REPETE) {
        $repete_mot_passe = "desole les deux mot de passe ne correspondent pas";
        $ERREUR++;
        
    }elseif ($ERREUR<0) {
        $requete = 'INSERT INTO ADMINISTRATEUR(ID_TYPE_COMPTE,NOM_UTILISATEUR,MOT_DE_PASSE) VALUES 
        (:ID_TYPE_COMPTE,:NOM_UTILISATEUR,:MOT_DE_PASSE)';

        $stmt = $db->prepare($requete);
        $stmt->bindParam(":ID_TYPE_COMPTE",$_SESSION['ID_TYPE_COMPTE'],PDO::PARAM_STR);
        $stmt->bindParam(":NOM_UTILISATEUR",$_POST['NOM_UTILISATEUR'],PDO::PARAM_STR);
        $stmt->bindParam(":MOT_DE_PASSE",$_POST['MOT_DE_PASSE'],PDO::PARAM_STR);

        $stmt->execute();

        $_SESSION['NOM_UTILISATEUR'] = $NOM_UTILISATEUR;
        header('Location:details.php');
    }
    
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>inscrption personnels</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css\bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
     crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5 py-5">
        <div class="row  justify-content-center align-items-center w-100 py-2 mt-2">
            <form action="" method="post" class =" w-75 bg-light">
            <h1 class ="text-center text-uppercase text-info mt-3 py-3">configuartion compte  admin</h1>
            <h3 class ="text-center text-uppercase text-info mt-3 py-3"><?php echo $_SESSION['ID_TYPE_COMPTE']?></h3>

            <div class="mt-3">
                    <label for="NOM_UTILISTEUR" class="form-label">NOM UTILISATEUR</label>
                    <input type="" name="NOM_UTILISATEUR" id="TYPE_COMPTE" class="form-control">
                    <h5 class ="text-center text-danger mt-2 text-uppercase"><?php echo $nom; ?></h5>

                </div>

                <div class="mt-3">
                    <label for="MOT_DE_PASSE" class="form-label">MOT DE PASSE</label>
                    <input type="password" name="MOT_DE_PASSE" id="MOT_DE_PASSE" class="form-control">
                    <h5 class ="text-center text-danger mt-2 text-uppercase"><?php echo $mot_passe; ?></h5>
                </div>

                <div class="mt-3">
                    <label for="MOT_DE_PASSE" class="form-label">REPETE MOT DE PASSE</label>
                    <input type="password" name="MOT_DE_PASSE" id="MOT_DE_PASSE" class="form-control">
                    <h5 class ="text-center text-danger mt-2 text-uppercase"><?php echo $repete_mot_passe; ?></h5>
                </div>

                <div class="mt-3 d-flex justify-content-center align-items-center w-100 py-4">
                    <input type="submit" value="Envoyer" class="btn btn-success w-50" name="envoi">
                    
                    <h5 class ="text-center text-danger mt-2 text-uppercase"><?php echo $message_erreur; ?></h5>
                </div> 

            </form>
        </div>
    </div>
    
</body>
</html>