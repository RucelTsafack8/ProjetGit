<?php
session_start();

require_once('connect.php');
require_once('header.php');
$message_email = '';
$message_nom = '';
if(isset($_POST['envoi'])){
    $NOM_PRENOMS = $_POST['NOM_PRENOMS'];
    $EMAIL = $_POST['EMAIL'];
    $SALAIRE = $_POST['SALAIRE'];
    $ID_COMPTE = '3IA-2023Tsa-817';
    $req= 'SELECT * FROM PERSONNELS WHERE ID_COMPTE =?';
    $pdostmt= $db->prepare($req);
    $pdostmt->execute(array($ID_COMPTE));
    $salaire = $pdostmt->fetch(PDO::FETCH_ASSOC);
}

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {
      $("#NOM_PRENOMS").on("change", function() {
        var NOM = $('#NOM_PRENOMS').val();
        if(NOM){

        }else{
            $("#EMAIL").val("l'email is required")
        }

        // $.ajax({
        //   url: "salaire_personnel.php",
        //   type: "POST",
        //   data: {
        //     searchTerm: searchEmail
        //   },
        //   success: function(data) {
        //     $("#EMAIL").html(data);
        //   }
        // })
        }
    )})
  </script>



    <div class="container">
        <div class="col-1 py-5 ms-5 mt-5">
            <button type="button"  class="text-warning float-start bg-success btn " onclick="history.back()"><i class="bi bi-arrow-left-short icon-link-hover"></i></button>
        </div>
        <div class="row justify-content-center align-items-center w-100 py-2 mt-2">
            <form action="" method="post" class="bg-light w-50 py-5 mt-5">
                <div class="col-12">
                    <h1 class="text-center text-uppercase text-info">Payer un personnel</h1>
                </div>
                <div class="col-12">
                    <div class="mt-3 py-2">
                        <label for="NOM_PRENOMS" class="form-label ">NOM PRENOMS </label>
                        <input type="text" name="NOM_PRENOMS" id="NOM_PRENOMS" class="form-control"  >
                        <p class="text-center text-danger"><?=  $message_nom ?></p>
                    </div>
                    <div class="mt-3 py-2">
                        <label for="EMAIL" class="form-label ">EMAIL PERSONNEL</label>
                        <input type="email" name="EMAIL" id="EMAIL" class="form-control" value="">
                        <p class="text-center text-danger"><?=  $message_email ?></p>
                    </div>

                    <div class="mt-3 py-2">
                        <label for="SALAIRE" class="form-label ">SALAIRE PERSONNELS </label>
                        <input type="number" name="SALAIRE" id="SALAIRE" class="form-control"  >
                    </div>
                    <div class="mt-3 py-2">
                        <label for="MOTIF" class="form-label ">MOTIF ENVOI ARGENT</label>
                        <input type="text-area" name="MOTIF" id="MOTIF" class="form-control" placeholder="entrer le motif du virement" >
                    </div>
                    <div class="mt-3 py-3 d-flex justify-content-center  justify-content-center align-items-center w-100">
                        <input type="submit" value="valider" class="btn btn-success w-25" name="envoi">
                    </div>
                </div>
            </form>
        </div>
    </div>
    
<?php
require_once('footer.php');
?>