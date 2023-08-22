<?php
session_start();
//on require le header pour l'entete de la page
require_once('header.php');
//on require le footer pour le pied de page
require_once('footer.php');

?>




<body>
    <div class="container mt-5 py-5">
        <div class="row">
            <div class="text-info"> BIENVENUE SUR VOTRE PAGE D'acceuil <?php echo $_SESSION['NOM_UTILISATEUR']?></div>
        </div>
    </div>
    
</body>
</html>