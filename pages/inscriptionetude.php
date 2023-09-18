<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script>
    
    $(document).ready(function(){
        let total = 0;
        //selection des prix de formation
        $("#CHOIX_FORMATION").on("change",function(){
            let choix_formation = ($("#CHOIX_FORMATION" ).val());
            if(choix_formation){
                $.ajax({
                    type: 'GET' ,
                    url:  'ajax\ajaxData1.php?ID_FORMATION='+ choix_formation ,
                    data: 'ID_FORMATION ='+choix_formation ,
                    success:  function(response){
                        //alert(response);
                        let PRIX = document.getElementById("PRIX_FORMATION");
                        PRIX.value = response;
                        total=response;

                    }  

                });
                
            }else{
                alert('cette formation n\'existe pas !!!');
            }
        })
        //selection des tranche de payements
        $("#TRANCHE_PAYEMENT").on("change",function(){
            let choix_tranche = ($("#TRANCHE_PAYEMENT" ).val());
            if(choix_tranche){
                $.ajax({
                    type: 'GET' ,
                    url:  'ajax\ajaxData2.php?ID_TRANCHE='+ choix_tranche ,
                    data: 'ID_TRANCHE ='+choix_tranche ,
                    success:  function(response1){
                        //alert(total);
                        let PRIX2 = document.getElementById("MONTANT_PAYE");
                        let T1=0;
                        let T2=0;
                        if(response1==='TOTAL'){
                            PRIX2.value=total;
                        }else if((response1==='TRANCHE1')){
                            while (total<100000) {
                                PRIX2.value=total;
                            }
                            T1=(total-100000)
                            PRIX2.value= T1;
                            total = total-T1;
                        }else if((response1==='TRANCHE2')){
                            while (total<100000) {
                                PRIX2.value=total;
                            }
                            T2 = (total-50000);
                            PRIX2.value= T2;
                            total =total-T2;
                        }
                        else if((response1==='TRANCHE3')){
                            PRIX2.value= total;
                        }
                        
                    }
                   
                });

            }else{
                alert('cette tranche n\'existe pas !!!');
            }
        })



    })
</script>
<?php
//on demarre la session
session_start();
//on require le header pour l'entete de la page
$ID_TYPE_COMPTE = $_SESSION['ID_TYPE_COMPTE'];
// require_once('headerset.php');




//require once le fichier conect pour la connexion a la base de dennees
require_once('C:\xampp12\htdocs\ProjetGit\layout\connect.php');

$erreur_nom = '';
$erreur_email = '';
$erreur_photo = '';
$erreur_photo1 = '';
$erreur_numero = '';
$erreur_cni = '';
$erreur_adresse = '';
$erreur_date = '';
$MESSAGE_SUCCESS='';
$ERREUR = 0;
$ID_ETUDIANT= '';
$ID_COMPTE=$_SESSION['ID_COMPTE'];
$CHOIX_FORMATION = '';

$date_actuel= date('Y');
$age = 0;
    //on selection les formations presentes dans la base de donnees
    $query = 'SELECT * FROM FORMATIONS';
    $form = $db->prepare($query);
    $form->execute();
    $formation = $form->fetchAll(PDO::FETCH_ASSOC);
    //on selectiionne les tranche de formations
    $query2 = 'SELECT * FROM TRANCHE_PAYEMENT';
    $form2 = $db->prepare($query2);
    $form2->execute();
    $tranche = $form2->fetchAll(PDO::FETCH_ASSOC);

    // $query = 'SELECT * FROM FORMATIONS';
    // $form = $db->prepare($query);
    // $form->execute();
    // $formation = $form->fetchAll(PDO::FETCH_ASSOC);
    
    

// echo "$date_actuel";
// echo '<h4 class="text-center mt-5 py-5">Yo man c est une erreur</h4>';
if(isset($_POST['envoyer'])){

    $NUM_TEL = strip_tags($_POST['NUM_TEL']);
    $EMAIL = strip_tags($_POST['EMAIL']);   
    $NOM_PRENOMS = strip_tags($_POST['NOM_PRENOMS']);
    $DATE_NAISSANCE = strip_tags($_POST['DATE_NAISSANCE']);
    $SEXE = strip_tags($_POST['SEXE']);
    $ADRESSE = strip_tags($_POST['ADRESSE']);
    $PHOTO = $_FILES['PHOTO'];
    $PHOTO_NOM = $PHOTO['name'];
    $destination ='images/'.$PHOTO_NOM;
    $imagePath  = pathinfo($destination,PATHINFO_EXTENSION);
    // if((exif_imagetype($destination)!==IMAGETYPE_GIF) || (exif_imagetype($destination)!==IMAGETYPE_PNG) || (exif_imagetype($destination)!==IMAGETYPE_JPEG)){
    //     $erreur_photo ="le type de fichier de l'image est invalide";
    // }
    if(!move_uploaded_file($_FILES['PHOTO']['tmp_name'],$destination)){
        $erreur_photo1 = "erreur de telechargement de l'image";
    }

    $CHOIX_FORMATION = strip_tags($_POST['CHOIX_FORMATION']);
    $DATE = date("Y-m-d H:i:s");
    $annee_naiss = date('Y',strtotime($DATE_NAISSANCE));
    $age = $date_actuel-$annee_naiss;
    // echo "$age";
    $INDICE = $NOM_PRENOMS[0].$NOM_PRENOMS[1].$NOM_PRENOMS[2];
    $reqe='SELECT COUNT(*) as totaletu FROM etudiants';
    $etu = $db->prepare($reqe);
    $etu ->execute();
    $totaletu = $etu->fetch()['totaletu'];
    $TOTAL = $totaletu +1;
    
    if(strlen($NUM_TEL)<=8){
        $erreur_numero = "le numero est incorrect";
        $ERREUR++;
    }if(strlen($EMAIL)<8 && empty($EMAIL)){
        $erreur_email = "l'email est mal renseigner";
        $ERREUR++;
    }if(strlen($NOM_PRENOMS)<=3 || !preg_match('/^[A-Z][a-zA-Z\s]+$/', $NOM_PRENOMS)){
        $erreur_nom = "remplir le champ d'au moins 8 caractere en commencent par une majuscule";
        $ERREUR++;
    }if($age<=7){
        $erreur_date = "l'age est trop petit pour un etudiant";
        $ERREUR++;
    }if($age>26){
        $erreur_date = "l'age est trop grand pour un etudiant";
        $ERREUR++; 
    }if(strlen($ADRESSE)<=4 || !preg_match('/^[A-Z][a-zA-Z\s]+$/', $ADRESSE)){
        $erreur_adresse = "l'adresse n'est pas conforme";
        $ERREUR++;
    }elseif ($ERREUR<=0){

        $ID_ETUDIANT = "3IA-ETU$date_actuel$INDICE-$TOTAL";
        
        //requete d'insertion des etudiants
        $requetes = 'INSERT INTO etudiants(ID_ETUDIANT,ID_COMPTE,NUM_TEL,EMAIL,NOM_PRENOMS,DATE_NAISSANCE,SEXE,ADRESSE,CHOIX_FORMATION,PRIX_FORMATION,DATE_DEBUT,PHOTO,MONTANT_PAYE)
        VALUES (:ID_ETUDIANT,:ID_COMPTE,:NUM_TEL,:EMAIL,:NOM_PRENOMS,:DATE_NAISSANCE,:SEXE,:ADRESSE,:CHOIX_FORMATION,:PRIX_FORMATION,:DATE_DEBUT,:PHOTO,:MONTANT_PAYE)';
        
        $stmt = $db->prepare($requetes);
        
        $stmt->bindParam(":ID_ETUDIANT",$ID_ETUDIANT,PDO::PARAM_STR);
        $stmt->bindParam(":ID_COMPTE",$_SESSION['ID_COMPTE'],PDO::PARAM_STR);
        $stmt->bindParam(":NUM_TEL",$_POST['NUM_TEL'],PDO::PARAM_INT);
        $stmt->bindParam(":EMAIL",$_POST['EMAIL'],PDO::PARAM_STR);
        
        $stmt->bindParam(":NOM_PRENOMS",$_POST['NOM_PRENOMS'],PDO::PARAM_STR);
        $stmt->bindParam(":DATE_NAISSANCE",$_POST['DATE_NAISSANCE']);
        $stmt->bindParam(":SEXE",$_POST['SEXE'],PDO::PARAM_STR);
        $stmt->bindParam(":ADRESSE",$_POST['ADRESSE'],PDO::PARAM_STR);
        $stmt->bindParam(":CHOIX_FORMATION",$_POST['CHOIX_FORMATION'],PDO::PARAM_STR);
        $stmt->bindParam(":PRIX_FORMATION",$_POST['PRIX_FORMATION'],PDO::PARAM_INT);
        $stmt->bindParam(":MONTANT_PAYE",$_POST['MONTANT_PAYE'],PDO::PARAM_INT);
        $stmt->bindParam(":PHOTO",$_FILES['PHOTO']['name']);
        $stmt->bindParam(":DATE_DEBUT",$DATE);
        $stmt->execute(); 
        $MESSAGE_SUCCESS = "insertion de l'etudiant reussi";
        // echo '<h4 class="text-center mt-5 py-5">Yo man c est une erreur</h4>';

    }
}
?>

<div class="container mt-5 py-5">
        <div class="col-1 py-2 ms-5 mt-1  fixed-top mt-5 py-5">
            <button type="button"  class="text-warning float-start bg-success btn " onclick="history.back()"><i class="bi bi-arrow-left-short icon-link-hover"></i></button>
        </div>
        <div class="row justify-content-center align-items-center w-100 py-2 mt-2">
            <form action="" method="post" class="bg-light w-50"  enctype="multipart/form-data">
                <h1 class= "text-center text-info text-uppercase">inscrition etudiants </h1>
                
                <div class="mt-3">
                    <label for="NOM_PRENOMS" class="form-label">NOM ET PRENOM</label>
                    <input type="text" name="NOM_PRENOMS" id="NOM_PRENOMS" class="form-control">
                    <!-- affiche l'erreur si le nom et le prenom sont mal ecrit -->
                    <h5 class ="text-center text-danger mt-3 text-uppercase py-2"><?php echo $erreur_nom;?></h5>
                </div>
                <div class="mt-3">
                    <label for="EMAIL" class="form-label">EMAIL</label>
                    <input type="email" name="EMAIL" id="EMAIL" class="form-control">
                    <h5 class ="text-center text-danger mt-3 text-uppercase py-2"><?php echo $erreur_email;?></h5>
                    
                </div>
                <div class="mt-3">
                    <label for="NUMERO_TEL" class="form-label">NUMERO TELEPHONE</label>
                    <input type="number" name="NUM_TEL" id="NUMERO_TEL" class="form-control">
                    <h5 class ="text-center text-danger mt-3 text-uppercase py-2"><?php echo $erreur_numero;?></h5>
                    
                </div>

                <div class="mt-3">
                    <label for="DATE_NAISSANCE" class="form-label">DATE DE NAISSANCE</label>
                    <input type="date" name="DATE_NAISSANCE" id="DATE_NAISSANCE" class="form-control">
                    <h5 class ="text-center text-danger mt-3 text-uppercase py-2"><?php echo $erreur_date;?></h5>

                </div>



                <div class="mt-3">
                    <label for="SEXE" class="form-label">SEXE</label>
                    <div class="form-check-inline ms-4">
                        <input type="radio" name="SEXE" id="SEXEh" class="form-check-input" checked value= "HOMME">
                        <label for="SEXEh" class="form-check-label">HOMME</label>
                    </div>
                    <div class="form-check-inline  ms-4">
                        <input type="radio" name="SEXE" id="SEXEf" class="form-check-input" value ="FEMME">
                        <label for="SEXEf" class="form-check-label">FEMME</label>
                    </div>
                </div>

                <div class="mt-3">
                    <label for="PHOTO" class="form-label">PHOTO</label>
                    <input type="file" name="PHOTO" id="PHOTO" class="form-control">
                    <h5 class ="text-center text-danger mt-3 text-uppercase py-2"><?php echo $erreur_photo;?></h5>
                    <h5 class ="text-center text-danger mt-3 text-uppercase py-2"><?php echo $erreur_photo1;?></h5>
                </div>
                <div class="mt-3">
                    <label for="ADRESSE" class="form-label">ADRESSE</label>
                    <input type="text" name="ADRESSE" id="ADRESSE" class="form-control">
                    <h5 class ="text-center text-danger mt-3 text-uppercase py-2"><?php echo $erreur_adresse;?></h5>
                </div>
                <div class="mt-3">
                    <label for="CHOIX_FORMATION" class="form-label" aria-label="Default select">CHOIX FORMATION</label>
                    <select name="CHOIX_FORMATION" id="CHOIX_FORMATION" class="form-select">
                        <option value="">selectionner une formation</option>
                        <?php foreach ($formation as $choix){
                            echo '<option value="'.$choix['ID_FORMATION'].'"> '.$choix['NOM_FORMATION'].'</option>';
                        }
                        ?>
                    
                </select>
            </div>
            <?php
                    $prix_query = 'SELECT PRIX_FORMATION FROM FORMATIONS WHERE ID_FORMATION=?';
                    $prix_form = $db->prepare($prix_query);
                    $prix_form->execute(array($choix['ID_FORMATION']));
                    $prix_formation = $prix_form->fetch(PDO::FETCH_ASSOC);
                    ?>

            <div class="mt-3 row">
                <div class="col-4">
                    <label for="PRIX_FORMATION" class="form-label">PRIX FORMATION </label>
                    <input type="number" name="PRIX_FORMATION" id="PRIX_FORMATION" class="form-control" value="<?= $prix_formation ?>">
                    <h5 class ="text-center text-danger mt-3 text-uppercase py-2"><?php echo $erreur_numero;?></h5>
                </div>
                <div class="col-4">
                    <label for="TRANCHE_PAYEMENT" class="form-label">TRANCHE DE PAYEMENT </label>

                    <select name="TRANCHE_PAYEMENT" id="TRANCHE_PAYEMENT" class="form-select">
                        <option value="">choisir une trache de payement</option>
                    <?php foreach ($tranche as $payement_tranche){
                            echo '<option value="'.$payement_tranche['ID_TRANCHE'].'"> '.$payement_tranche['NOM_TRANCHE'].'</option>';
                    }
                    ?>
                    
                    </select>
                    </div>
                <div class="col-4">
                        <label for="MONTANT_PAYE" class="form-label">MONTANT PAYE</label>
                        <input type="number" name="MONTANT_PAYE" id="MONTANT_PAYE" class="form-control" value="<?= $prix_formation ?>">
                        <h5 class ="text-center text-danger mt-3 text-uppercase py-2"><?php echo $erreur_numero;?></h5>
                    </div>
                </div>

                <h5 class="text-center text-success"><?php echo $MESSAGE_SUCCESS;?></h5>
                <div class="mt-3 d-flex justify-content-center align-items-center w-100 py-4">
                    <input type="submit" value="Envoyer" class="btn btn-success w-50" name="envoyer">
                </div> 
                                

            </form>
        </div>
    </div>
    
    <!-- <script src="requetesprix.js"></script> -->
<?php
    //on require le footer pour le pied de page
    require_once('C:\xampp12\htdocs\ProjetGit\layout\footer.php');
?>