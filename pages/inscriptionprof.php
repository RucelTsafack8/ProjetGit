<?php
//on demarre la session
session_start();
//on require le header pour l'entete de la page
$ID_TYPE_COMPTE = $_SESSION['ID_TYPE_COMPTE'];
$MOT = 'ADMIN';
$resultat = strstr($ID_TYPE_COMPTE,$MOT);
if($resultat===false){
    require_once('headerset.php');
}else{
    require_once('C:\xampp12\htdocs\ProjetGit\layout\headeradmin.php');
}
//require once le fichier conect pour la connexion a la base de dennees
require_once('C:\xampp12\htdocs\ProjetGit\layout\connect.php');

$erreur_nom = '';
$erreur_email = '';
$erreur_numero = '';
$erreur_photo = '';
$erreur_photo1 = '';
$erreur_cni = '';
$erreur_adresse = '';
$erreur_date = '';
$MESSAGE_SUCCESS='';
$ERREUR = 0;
$annee_naiss= 0;
$date_actuel= date('Y');
$age = 0;
$ID_COMPTE = $_SESSION['ID_COMPTE'];
if(isset($_POST['envoyer'])){
    $NUMERO_CNI = $_POST['NUMERO_CNI'];
    $NUMERO_TEL = $_POST['NUMERO_TEL'];
    $EMAIL = $_POST['EMAIL'];
    $NOM_PRENOMS = $_POST['NOM_PRENOMS'];
    $DATE_NAISSANCE = $_POST['DATE_NAISSANCE'];
    $SEXE = $_POST['SEXE'];
    $ADRESSE = $_POST['ADRESSE'];
    $annee_naiss = date('Y',strtotime($DATE_NAISSANCE));

    $PHOTO = $_FILES['PHOTO'];
    $PHOTO_NOM = $PHOTO['name'];
    $destination ='images/'.$PHOTO_NOM;
    $imagePath  = pathinfo($destination,PATHINFO_EXTENSION);
    $VALID_EXTENSION = array('jpg','png','jpeg');
    if(!in_array(strtolower($destination),$VALID_EXTENSION)){
        $erreur_photo ="le type de fichier de l'imagfe est invalide";
    }
    if(!move_uploaded_file($_FILES['PHOTO']['tmp_name'],$destination)){
        $erreur_photo1 = "erreur de telechargement de l'image";
    }

    $age = $date_actuel-$annee_naiss;
    $DATE = $date_actuel;
    $DATE1 = date("Y-m-d H:i:s");
    $reqprof='SELECT COUNT(*) as totalprof FROM professeurs';
    $prof = $db->prepare($reqprof);
    $prof ->execute();
    $totalprof = $prof->fetch()['totalprof'];
    $INDICE = $NOM_PRENOMS[0].$NOM_PRENOMS[1].$NOM_PRENOMS[2];
    $TOTAL = $totalprof +1;

    $ID_PROFESSEUR = "3IA-PROF.$DATE$INDICE-$TOTAL";

    if(strlen($NOM_PRENOMS)<=3 || !preg_match('/^[A-Z][a-zA-Z\s]+$/', $NOM_PRENOMS)){
        $erreur_nom= "veillez remplir le champ d'au moins 3 caracteres";
        $ERREUR++;
    }if(strlen($EMAIL)<=8 && empty($EMAIL)) {
        $erreur_email = "l'email est mal renseigner";
        $ERREUR++;
    }if(strlen($NUMERO_TEL)<9){
        $erreur_numero = "le numero est incorrect";
        $ERREUR++;
    } if(strlen($NUMERO_CNI)<=8){
        $erreur_cni = "le numero  de la cni est incorrect";
        $ERREUR++;
    } if($age <= 17){
        $erreur_date = "l'age est inferieur a la normal";
        $ERREUR++;
    }if(strlen($ADRESSE)<=4 || !preg_match('/^[A-Z][a-zA-Z\s]+$/', $ADRESSE)){
        $erreur_adresse = "l'adresse est mal ecrit ";
        $ERREUR++;
    }else if($ERREUR<=0){
       


        //REQUETE D'INSERTION A LA TABLE 
    
        $requete1 = 'INSERT INTO PROFESSEURS(ID_PROFESSEUR,ID_COMPTE,NUMERO_CNI,NUMERO_TEL,EMAIL,FONCTIONS,DATE,NOM_PRENOMS,DATE_NAISSANCE,SEXE,ADRESSE,PHOTO) VALUES 
        (:ID_PROFESSEUR,:ID_COMPTE,:NUMERO_CNI,:NUMERO_TEL,:EMAIL,:FONCTIONS,:DATE,:NOM_PRENOMS,:DATE_NAISSANCE,:SEXE,:ADRESSE,:PHOTO)';

        $stmt = $db->prepare($requete1);

        $stmt->bindParam(":ID_COMPTE",$_SESSION['ID_COMPTE'],PDO::PARAM_STR);
        $stmt->bindParam(":ID_PROFESSEUR",$ID_PROFESSEUR,PDO::PARAM_STR);
        $stmt->bindParam(":NUMERO_CNI",$_POST['NUMERO_CNI'],PDO::PARAM_INT);
        $stmt->bindParam(":NUMERO_TEL",$_POST['NUMERO_TEL'],PDO::PARAM_INT);
        $stmt->bindParam(":EMAIL",$_POST['EMAIL'],PDO::PARAM_STR);
        $stmt->bindParam(":FONCTIONS",$_POST['FONCTIONS'],PDO::PARAM_STR);
        
        $stmt->bindParam(":DATE",$DATE1);
        $stmt->bindParam(":NOM_PRENOMS",$_POST['NOM_PRENOMS'],PDO::PARAM_STR);
        $stmt->bindParam(":DATE_NAISSANCE",$_POST['DATE_NAISSANCE']);
        $stmt->bindParam(":SEXE",$_POST['SEXE'],PDO::PARAM_STR);
        $stmt->bindParam(":PHOTO",$_FILES['PHOTO']['name']);
        $stmt->bindParam(":ADRESSE",$_POST['ADRESSE'],PDO::PARAM_STR);

        $stmt->execute();
        
        // $_SESSION['ID_COMPTE'] = $ID_COMPTE;
        // $_SESSION['SEXE'] = $SEXE;
        // $_SESSION['ADRESSE'] = $ADRESSE;
        // $_SESSION['NOM_PRENOMS'] =$NOM_PRENOMS;
        // $_SESSION['EMAIL'] =$EMAIL;
        // $_SESSION['DATE_NAISSANCE'] =$DATE_NAISSANCE;
        // $_SESSION['NUMERO_TEL'] =$NUMERO_TEL;

        header('location:donneeprof.php');

    }
}

?>

<div class="container mt-5 py-5">
        <div class="col-1 py-2 ms-5 mt-1  fixed-top mt-5 py-5">
            <button type="button"  class="text-warning float-start bg-success btn " onclick="history.back()"><i class="bi bi-arrow-left-short icon-link-hover"></i></button>
        </div>
        
        <div class="row  justify-content-center align-items-center w-100 py-2 mt-2">
            <form action="" method="post" class="mt-3 w-50 bg-light" enctype="multipart/form-data">
                <h1 class ="text-center text-uppercase text-info mt-3 py-3"> inscription Professeur </h1>            
                <div class="mt-3">

                    <label for="NUMERO_CNI" class="form-label">NUMERO DE CNI</label>
                    <input type="number" name="NUMERO_CNI" id="NUMERO_CNI" class="form-control">
                    <h5 class ="text-center text-danger mt-2 text-uppercase"><?php echo $erreur_cni;?></h5>

                </div>
                <div class="mt-3">
                    <label for="NUMERO_TEL" class="form-label">NUMERO TELEPHONE</label>
                    <input type="number" name="NUMERO_TEL" id="NUMERO_TEL" class="form-control">
                    <h5 class ="text-center text-danger mt-2 text-uppercase"><?php echo $erreur_numero;?></h5>

                </div>

                <div class="mt-3">
                    <label for="EMAIL" class="form-label">EMAIL</label>
                    <input type="email" name="EMAIL" id="EMAIL" class="form-control">
                    <h5 class ="text-center text-danger mt-2 text-uppercase"><?php echo $erreur_email;?></h5>

                </div>

                <div class="mt-3">
                    <label for="NOM_PRENOMS" class="form-label">NOM ET PRENOM</label>
                    <input type="text" name="NOM_PRENOMS" id="NOM_PRENOMS" class="form-control">
                    <!-- affiche l'erreur si le nom et le prenom sont mal ecrit -->
                    <h5 class ="text-center text-danger mt-2 text-uppercase"><?php echo $erreur_nom;?></h5>
                </div>
                <div class="mt-3">
                    <label for="FONCTIONS" class="form-label" aria-label="Default select">FONCTIONS ENSEIGNANT</label>
                    <select name="FONCTIONS" id="FONCTIONS" class="form-select">
                        <option value="ENG-PRODEV">ENSEIGNANT PROGRAMMATION</option>
                        <option value="ENG-INFOGRAPHIE">ENSEIGNANT INFOGRAPHIE</option>
                        <option value="ENG-SECRETARIAT">ENSEIGNANT SECRETARIAT</option>
                        <option value="ENG-RESEAUX">ENSEIGNANT RESEAUX</option>
                        
                    </select>
                </div>


                <div class="mt-3">
                    <label for="DATE_NAISSANCE" class="form-label">DATE DE NAISSANCE</label>
                    <input type="date" name="DATE_NAISSANCE" id="DATE_NAISSANCE" class="form-control">
                    <h5 class ="text-center text-danger mt-2 text-uppercase"><?php echo $erreur_date;?></h5>

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
                    <h5 class ="text-center text-danger mt-2 text-uppercase"><?php echo $erreur_adresse;?></h5>
                </div> 
                <h5 class="text-center text-success text-uppercase"><?php echo $MESSAGE_SUCCESS;?></h5>
                <div class="mt-3 d-flex justify-content-center align-items-center w-100 py-4">
                    <input type="submit" value="Envoyer" class="btn btn-success w-50" name="envoyer">
                </div> 
            </form>
        </div>
    </div>
    <div class="row py-4 ms-5">
    

<?php
    //on require le footer pour le pied de page
    require_once('C:\xampp12\htdocs\ProjetGit\layout\footer.php');
?>