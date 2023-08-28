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

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    
</body>
</html>