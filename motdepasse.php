<?php
    session_start();
    require_once('connect.php');

    $messageErreur = "";
    $NOM_UTILISATEUR = '';
    $erreur_nom_utilisateur = '';
    $erreur_mot_de_passe='';
    $erreur_mot_de_passe1='';

    if(isset($_POST['envoi'])){
        $CHOIX_TYPE_COMPTE = $_POST['CHOIX_TYPE_COMPTE'];
        $NOM_UTILISATEUR = $_POST['NOM_UTILISATEUR'];
        $MOT_DE_PASSE = $_POST['MOT_DE_PASSE'];
        $MOT_DE_PASSE2 = $_POST['MOT_DE_PASSE2'];

        if(empty($NOM_UTILISATEUR)){
            $erreur_nom_utilisateur = "Veuiller renseigner le nom Correcte de l'utilisateur";
        }
        if(empty($MOT_DE_PASSE)){
            $erreur_mot_de_passe = 'Veuiller renseigner le mot de passe';
        }
        if ($MOT_DE_PASSE2!=$MOT_DE_PASSE) {
            $repete_mot_passe1 = "desole les deux mot de passe ne correspondent pas";
        }else{
            
            if($CHOIX_TYPE_COMPTE=='SECRET'){
                $requete = 'UPDATE SECRETAIRE SET MOT_DE_PASSE=:MOT_DE_PASSE,NOM_UTILISATEUR=:NOM_UTILISATEUR WHERE NOM_UTILISATEUR =:NOM_UTILISATEUR';
                $stmt = $db->prepare($requete);
                $stmt->bindParam(":NOM_UTILISATEUR",$NOM_UTILISATEUR,PDO::PARAM_STR);
                $stmt->bindParam(":MOT_DE_PASSE",$MOT_DE_PASSE,PDO::PARAM_STR);
                $stmt->execute(); 
                header('Location:connexion.php')  ;
            }else{
                $requete = 'UPDATE ADMINISTRATEUR SET MOT_DE_PASSE=:MOT_DE_PASSE,NOM_UTILISATEUR=:NOM_UTILISATEUR WHERE NOM_UTILISATEUR =:NOM_UTILISATEUR';
            
            $stmt = $db->prepare($requete);
            $stmt->bindParam(":NOM_UTILISATEUR",$NOM_UTILISATEUR,PDO::PARAM_STR);
            $stmt->bindParam(":MOT_DE_PASSE",$MOT_DE_PASSE,PDO::PARAM_STR);
            $stmt->execute();
            header('Location:connexion.php');
            }

        }
    }

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>modifier mot de passe</title>
    <link rel="stylesheet" href="css\bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
     crossorigin="anonymous">

</head>
<body>
    <div class="container">
       <div class="row mt-5 py-5  justify-content-center align-items-center w-100">
            <form action="" method="post" class="w-75 bg-light mt-3 py-4">
                <h1 class="text-center text-info text-uppercase">renitialiser le mot de passe</h1>
                <h5 class="text-center text-danger mt-4"><?php echo $messageErreur ?></h5>
                <div class="mt-3">
                    <label for="CHOIX_TYPE_COMPTE" class="form-label" aria-label="Default select">TYPE DE COMPTE</label>
                    <select name="CHOIX_TYPE_COMPTE" id="CHOIX_TYPE_COMPTE" class="form-select" value="<?= $CHOIX_TYPE_COMPTE ?>">
                        <option value="ADMIN">ADMINISTRATEUR</option>
                        <option value="SECRET">SECRETAIRE</option>
                    </select>
                </div>
                <div class="mt-3">
                    <label for="NOM_UTILISATEUR" class="form-label">NOM UTILISATEUR</label>
                    <input type="text" name="NOM_UTILISATEUR" id="NOM_UTILISTEUR" class="form-control" value = "<?= $NOM_UTILISATEUR ?>">
                    <input type="hidden" name="ID_TYPE_COMPTE" id="ID_TYPE_COMPTE" class="form-control" value ="<?= $ID_TYPE_COMPTE ?>">
                    <p class="text-center text-danger"><?=  $erreur_nom_utilisateur ?></p>
                </div>
        
                <div class="mt-3">
                    <label for="MOT_DE_PASSE" class="form-label">MOT DE PASSE</label>
                    <input type="password" name="MOT_DE_PASSE" id="MOT_DE_PASSE" class="form-control">
                    <p class="text-center text-danger"><?=  $erreur_mot_de_passe ?></p>
                </div>
                <div class="mt-3">
                    <label for="MOT_DE_PASSE2" class="form-label"> REPETE MOT DE PASSE</label>
                    <input type="password" name="MOT_DE_PASSE2" id="MOT_DE_PASSE2" class="form-control">
                    <p class="text-center text-danger"><?=  $erreur_mot_de_passe1 ?></p>
                    
                </div>
                <div class="mt-3 d-flex justify-content-center  justify-content-center align-items-center w-100">
                    <input type="submit" value="valider" class="btn btn-success w-50" name="envoi">
                </div>
            </form>
       </div>
    </div>   
</body>
</html>
