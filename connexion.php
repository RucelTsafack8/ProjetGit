<?php 
session_start();
//on require le header pour l'entete de la page
require_once('header.php');
//la connection a la base de donnes
require_once('connect.php');
//variables d'erreur
$NomErreur ='';
$PasswordErreur = '';
$messageErreur = '';
$Password1 = '';
$Nom1 = '';
$requete = '';
// condition du bouton d'envoi
if(isset($_POST['envoi'])){
    // try{ 
    $Nom = $_POST['Nom'];
    $Password = $_POST['Password'];
    
    //requete d'insertion a la base de donnnes 
    // $requete ='INSERT INTO UTILISATEUR(Nom,Password) VALUES(:Nom,:Password)';
    //$requete1 = 'SELECT * FROM UTILISATEUR WHERE Nom=$Nom';
    if(($Nom !== "" && $Password !== "") )
    {
        //requete de selection dans la base de donnees 
        $requete = 'SELECT * FROM utilisateur WHERE Nom =? AND Password = ?';
        //initiation de l'execution de la requete
     $stmt = $pdo_dbconnect->prepare($requete);
     $stmt->execute(array($Nom,$Password));
     $reponse = $stmt->fetch(PDO::FETCH_OBJ);
            if($reponse>0){  
                // nom d'utilisateur et mot de passe correctes 
                $_SESSION['Nom'] = $Nom;
                header("location:admin.php");
            }else{
                $messageErreur = "Nom ou mot de passe incorrecte!!! si vous n'avez pas encore de compte veuillez vous conecter!!!";
            }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>connexion</title>
    <link rel="stylesheet" href="css\bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
     crossorigin="anonymous">

</head>
<body>
    <main>
       <div class="container mt-5 py-5">
        <form action="" method="post">
            <h1 class="text-center text-info text-uppercase">connexion</h1>
            <h5 class="text-center text-danger mt-4"><?php echo $messageErreur ?></h5>
            <div class="mt-3">
                <label for="Nom" class="form-label">NOM UTILISATEUR</label>
                <input type="text" name="Nom" id="Nom" class="form-control">
            </div>
    
            <div class="mt-3">
                <label for="Password" class="form-label">MOT DE PASSE</label>
                <input type="password" name="Password" id="password" class="form-control">
            </div>
            <div class="mt-3 d-flex justify-content-center ">
                <input type="submit" value="valider" class="btn btn-success" name="envoi">
            </div>
        </form>
       </div>
    </main>
    

</body>
</html>
