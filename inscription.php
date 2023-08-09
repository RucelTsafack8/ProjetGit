<?php
//require once le fichier conect pour la connexion a la base de dennees
require_once('connect.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css\bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
     crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <form action="" method="post">
            <div class="mt-3">
                <label for="NUMERO_TEL" class="form-label">NUMERO TELEPHONE</label>
                <input type="number" name="NUMERO_TEL" id="NUMERO_TEL">
            </div>
            <div class="mt-3">
                <label for="EMAIL" class="form-label">EMAIL</label>
                <input type="email" name="EMAIL" id="EMAIL">
            </div>
            <div class="mt-3">
                <label for="NOM_PRENOMS" class="form-label">NOM ET PRENOM</label>
                <input type="text" name="NOM_PRENOMS" id="NOM_PRENOMS">
            </div>
            <div class="mt-3">
                <label for="DATE_NAISSANCE" class="form-label">DATE DE NAISSANCE</label>
                <input type="date" name="DATE_NAISSANCE" id="DATE_NAISSANCE">
            </div>
            <div class="mt-3">
                <label for="SEXE" class="form-label">SEXE</label>
                <div class="form-check">
                    <input type="radio" name="SEXE" id="SEXEh" class="form-check-input">
                    <label for="SEXEh" class="form-check-label">HOMME</label>
                </div>
                <div class="form-check">
                    <input type="radio" name="SEXE" id="SEXEf" class="form-check-input">
                    <label for="SEXEf" class="form-check-label">FEMME</label>
                </div>
            </div>
            <div class="mt-3">
                <label for="ADRESSE" class="form-label">ADRESSE</label>
                <input type="text" name="ADRESSE" id="ADRESSE">
            </div>
            <div class="mt-3 d-flex justify-content-center align-items-center w-100">
                <input type="submit" value="envoyer" class="btn btn-success w-50">
            </div>
            
            
        </form>
    </div>
</body>
</html>