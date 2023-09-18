<?php
session_start();

require_once('C:\xampp12\htdocs\ProjetGit\layout\connect.php');
require_once('C:\xampp12\htdocs\ProjetGit\layout\headeradmin.php');
////////////////////////////////
    $ret = 'SELECT COUNT(*) as total FROM DEPENSES';
    $stn=$db->prepare($ret);
    $stn->execute();
    $total = $stn->fetch()['total'];
    echo $total  ;
////////////////////////////
$message_email = '';
$message_nom = '';
$success='';
$ID_COMPTE = $_SESSION['ID_COMPTE'];
if(isset($_POST['envoi'])){
    $ID_DEPENSE = $_POST['ID_DEPENSE'];
    $NOM_PRENOMS = $_POST['NOM_PRENOMS'];
    $EMAIL_RECEVEUR = $_POST['EMAIL_RECEVEUR'];
    $PRIX_DEPENSE = $_POST['PRIX_DEPENSE'];
    $MOTIF = $_POST['MOTIF'];
   echo $ID_COMPTE;
   

   $requete = 'INSERT INTO DEPENSES (ID_DEPENSE,ID_COMPTE,NOM_PRENOMS,EMAIL_RECEVEUR,PRIX_DEPENSE,MOTIF) VALUES (:ID_DEPENSE,:ID_COMPTE,:NOM_PRENOMS,:EMAIL_RECEVEUR,:PRIX_DEPENSE,:MOTIF)';
   $pdostmt=$db->prepare($requete);
   $pdostmt->bindParam(":ID_DEPENSE",$_POST['ID_DEPENSE'],PDO::PARAM_INT);
   $pdostmt->bindParam(":ID_COMPTE",$_SESSION['ID_COMPTE'],PDO::PARAM_STR);
   $pdostmt->bindParam(":NOM_PRENOMS",$_POST['NOM_PRENOMS'],PDO::PARAM_STR);
   $pdostmt->bindParam(":EMAIL_RECEVEUR",$_POST['EMAIL_RECEVEUR'],PDO::PARAM_STR);
   $pdostmt->bindParam(":PRIX_DEPENSE",$_POST['PRIX_DEPENSE'],PDO::PARAM_INT);
   $pdostmt->bindParam(":MOTIF",$_POST['MOTIF'],PDO::PARAM_STR);
   $pdostmt->execute();
   $success="le retrait pour la depense a ete effectue avec success";
   header('Location:admin.php');
   

    
}

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    // $(document).ready(function() {
     
    // )})
  </script>



    <div class="container ms-5 mt-5">
        <div class="col-1 py-5   fixed-top mt-5 py-5">
            <button type="button"  class="text-warning float-start bg-success btn " onclick="history.back()"><i class="bi bi-arrow-left-short icon-link-hover"></i></button>
        </div>
        <div class="row justify-content-center align-items-center w-100 py-2 mt-2">
            <form action="" method="post" class="bg-light w-50 py-5 mt-5">
                <div class="col-12">
                    <h1 class="text-center text-uppercase text-info">depense de 3ia</h1>
                </div>
                <div class="col-12">
                    <div class="mt-3 py-2">
                        <label for="NOM_PRENOMS" class="form-label ">NOM PRENOMS RECEVEUR </label>
                        <input type="hidden" name="ID_DEPENSE" id="ID_DEPENSE" class="form-control" value="<?= ($total +1)?>" >
                        <input type="text" name="NOM_PRENOMS" id="NOM_PRENOMS" class="form-control"  >
                        <p class="text-center text-danger"><?=  $message_nom ?></p>
                    </div>
                    <div class="mt-3 py-2">
                        <label for="EMAIL_RECEVEUR" class="form-label ">EMAIL RECEVEUR</label>
                        <input type="email" name="EMAIL_RECEVEUR" id="EMAIL_RECEVEUR" class="form-control" value="">
                        <p class="text-center text-danger"><?=  $message_email ?></p>
                    </div>

                    <div class="mt-3 py-2">
                        <label for="PRIX_DEPENSE" class="form-label ">MONTANT DECAISSE</label>
                        <input type="number" name="PRIX_DEPENSE" id="PRIX_DEPENSE" class="form-control"  >
                    </div>
                    <div class="mt-3 py-2">
                        <label for="MOTIF" class="form-label ">MOTIF DECAISSE</label>
                        <input type="text-area" name="MOTIF" id="MOTIF" class="form-control" placeholder="entrer le motif du virement" >

                    </div>
                    <p class="text-success text-center text-capitalize"><?= $success?></p>
                    <div class="mt-3 py-3 d-flex justify-content-center  justify-content-center align-items-center w-100">
                        <input type="submit" value="valider" class="btn btn-success w-25" name="envoi">
                    </div>
                </div>
            </form>
        </div>
    </div>
    
<?php
require_once('C:\xampp12\htdocs\ProjetGit\layout\footer.php');
?>