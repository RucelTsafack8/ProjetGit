<?php
    session_start();
    $messageErreur = "";
    

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
                <h1 class="text-center text-info text-uppercase">connexion</h1>
                <h5 class="text-center text-danger mt-4"><?php echo $messageErreur ?></h5>
                <div class="mt-3">
                    <label for="NOM_UTILISATEUR" class="form-label">NOM UTILISATEUR</label>
                    <input type="text" name="NOM_UTILISATEUR" id="NOM_UTILISTEUR" class="form-control">
                </div>
        
                <div class="mt-3">
                    <label for="MOT_DE_PASSE" class="form-label">MOT DE PASSE</label>
                    <input type="password" name="MOT_DE_PASSE" id="MOT_DE_PASSE" class="form-control">
                </div>
                <div class="mt-3 d-flex justify-content-center  justify-content-center align-items-center w-100">
                    <input type="submit" value="valider" class="btn btn-success w-50" name="envoi">
                </div>
            </form>
       </div>
    </div>   
</body>
</html>
