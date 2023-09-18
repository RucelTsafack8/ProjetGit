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
$erreur_cni = '';
$erreur_adresse = '';
$erreur_date = '';
$MESSAGE_SUCCESS='';
$ERREUR = 0;
$ID_ETUDIANT= '';
$ID_COMPTE=$_SESSION['ID_COMPTE'];
$CHOIX_FORMATION = '';
$ID_STAGIAIRE = $_GET['ID_STAGIAIRE'];
$date_actuel= date('Y');
$age = 0;
// echo "$date_actuel";
// echo '<h4 class="text-center mt-5 py-5">Yo man c est une erreur</h4>';
if(isset($_POST['envoyer'])){

    $NUMERO_CNI = strip_tags($_POST['NUMERO_CNI']);
    $NUMERO_TEL = strip_tags($_POST['NUMERO_TEL']);
    $EMAIL = strip_tags($_POST['EMAIL']);   
    $NOM_PRENOMS = strip_tags($_POST['NOM_PRENOMS']);
    $DATE_NAISSANCE = strip_tags($_POST['DATE_NAISSANCE']);
    $SEXE = strip_tags($_POST['SEXE']);
    $ADRESSE = strip_tags($_POST['ADRESSE']);
    $CAMPUS=$_POST['CAMPUS'];
    $FILIERE =$_POST['FILIERE'];
    $NIVEAU=$_POST['NIVEAU'];
    $DATE = date("Y-m-d H:i:s");
    $annee_naiss = date('Y',strtotime($DATE_NAISSANCE));
    $age = $date_actuel-$annee_naiss;
    // echo "$age";
    // $RANGNUMBER = rand(100,1000);
    // $INDICE = $NOM_PRENOMS[0].$NOM_PRENOMS[1].$NOM_PRENOMS[2];
    
    if(strlen($NUMERO_TEL)<=8){
        $erreur_numero = "le numero est incorrect";
        $ERREUR++;
    }elseif(strlen($EMAIL)<8 && empty($EMAIL)){
        $erreur_email = "l'email est mal renseigner";
        $ERREUR++;
    }elseif(strlen($NOM_PRENOMS)<=8 || !preg_match('/^[A-Z][a-zA-Z\s]+$/', $NOM_PRENOMS)){
        $erreur_nom = "remplir le champ d'au moins 8 caractere en commencent par une majuscule";
        $ERREUR++;
    }elseif($age<=7){
        $erreur_date = "l'age est trop petit pour un etudiant";
        $ERREUR++;
    }elseif($age>26){
        $erreur_date = "l'age est trop grand pour un etudiant";
        $ERREUR++; 
    }elseif(strlen($ADRESSE)<=4 || !preg_match('/^[A-Z][a-zA-Z\s]+$/', $ADRESSE)){
        $erreur_adresse = "l'adresse n'est pas conforme";
        $ERREUR++;
    }elseif ($ERREUR<=0){
        // $ID_STAGIAIRE = "3IA-STA$date_actuel$INDICE-$RANGNUMBER";
        //requete d'insertion des etudiants
        $requetes = 'UPDATE STAGIAIRE SET ID_STAGIAIRE=:ID_STAGIAIRE,ID_COMPTE=:ID_COMPTE,NUMERO_CNI=:NUMERO_CNI,NUMERO_TEL=:NUMERO_TEL,EMAIL=:EMAIL,
        NOM_PRENOMS=:NOM_PRENOMS,DATE_NAISSANCE=:DATE_NAISSANCE,SEXE=:SEXE,ADRESSE=:ADRESSE,PRIX_FORMATION=:PRIX_FORMATION,
        DATE_DEBUT=:DATE_DEBUT,CAMPUS=:CAMPUS,FILIERE=:FILIERE,NIVEAU=:NIVEAU
        WHERE ID_STAGIAIRE=:ID_STAGIAIRE';
        
        $stmt = $db->prepare($requetes);
        
        $stmt->bindParam(":ID_STAGIAIRE",$ID_STAGIAIRE,PDO::PARAM_STR);
        $stmt->bindParam(":ID_COMPTE",$_POST['ID_COMPTE'],PDO::PARAM_STR);
        $stmt->bindParam(":NUMERO_CNI",$_POST['NUMERO_CNI'],PDO::PARAM_INT);
        $stmt->bindParam(":NUMERO_TEL",$_POST['NUMERO_TEL'],PDO::PARAM_INT);
        $stmt->bindParam(":EMAIL",$_POST['EMAIL'],PDO::PARAM_STR);
        
        $stmt->bindParam(":NOM_PRENOMS",$_POST['NOM_PRENOMS'],PDO::PARAM_STR);
        $stmt->bindParam(":DATE_NAISSANCE",$_POST['DATE_NAISSANCE']);
        $stmt->bindParam(":SEXE",$_POST['SEXE'],PDO::PARAM_STR);
        $stmt->bindParam(":ADRESSE",$_POST['ADRESSE'],PDO::PARAM_STR);
        $stmt->bindParam(":PRIX_FORMATION",$_POST['PRIX_FORMATION'],PDO::PARAM_INT);
        $stmt->bindParam(":CAMPUS",$_POST['CAMPUS'],PDO::PARAM_STR);
        $stmt->bindParam(":FILIERE",$_POST['FILIERE'],PDO::PARAM_STR);
        $stmt->bindParam(":NIVEAU",$_POST['NIVEAU'],PDO::PARAM_STR);
        $stmt->bindParam(":DATE_DEBUT",$DATE);
        $stmt->execute(); 

        if($resultat===false){
            header('location:recustage.php');
            
        }else{
            header('location:donneestage.php');
            
        }
        // echo '<h4 class="text-center mt-5 py-5">Yo man c est une erreur</h4>';

    }
    }
    if(isset($_GET['ID_STAGIAIRE'])){


        $requete = 'SELECT * FROM STAGIAIRE WHERE ID_STAGIAIRE = ?';
        //on prepare la requete
        $query = $db->prepare($requete);
        //on excecute la requete
        $query->execute(array($ID_STAGIAIRE));
        //on stock les donnees les donnes dans une variable
        $STAGE = $query->fetch();
        // if(!$SECRET){   
        //     header('Location:admin.php');
        //     $message ="<h1 class='text-center text-danger border text-uppercase mt-5 py-5'> $message_erreur</h1>";
        // }
    }

?>

<div class="container mt-5 py-5">
        <div class="col-1  py-2 ms-5 mt-1  fixed-top mt-5 py-5">
            <button type="button"  class="text-warning float-start bg-success btn " onclick="history.back()"><i class="bi bi-arrow-left-short icon-link-hover"></i></button>
        </div>
        <div class="row justify-content-center align-items-center w-100 py-2 mt-2">
            <form action="" method="post" class="bg-light w-50">
                <h1 class= "text-center text-info text-uppercase">inscrition Stagiare</h1>
                
                <div class="mt-3">
                    <label for="NUMERO_CNI" class="form-label">NUMERO CNI</label>
                    <input type="number" name="NUMERO_CNI" id="NUMERO_CNI" class="form-control" value="<?= $STAGE['NUMERO_CNI'] ?>">
                    <h5 class ="text-center text-danger mt-3 text-uppercase py-2"><?php echo $erreur_numero;?></h5>

                </div>
                <div class="mt-3">
                    <label for="NUMERO_TEL" class="form-label">NUMERO TELEPHONE</label>
                    <input type="number" name="NUMERO_TEL" id="NUMERO_TEL" class="form-control" value="<?= $STAGE['NUMERO_TEL'] ?>">
                    <h5 class ="text-center text-danger mt-3 text-uppercase py-2"><?php echo $erreur_numero;?></h5>

                </div>

                <div class="mt-3">
                    <label for="EMAIL" class="form-label">EMAIL</label>
                    <input type="email" name="EMAIL" id="EMAIL" class="form-control" value="<?= $STAGE['EMAIL'] ?>">
                    <h5 class ="text-center text-danger mt-3 text-uppercase py-2"><?php echo $erreur_email;?></h5>

                </div>

                <div class="mt-3">
                    <label for="NOM_PRENOMS" class="form-label">NOM ET PRENOM</label>
                    <input type="text" name="NOM_PRENOMS" id="NOM_PRENOMS" class="form-control" value="<?= $STAGE['NOM_PRENOMS'] ?>">
                    <input type="hidden" name="ID_COMTE" id="NOM_PRENOMS" class="form-control" value="<?= $STAGE['ID_COMPTE'] ?>">
                    <input type="hidden" name="ID_STAGIAIRE" id="NOM_PRENOMS" class="form-control" value="<?= $STAGE['ID_STAGIAIRE'] ?>">
                    <!-- affiche l'erreur si le nom et le prenom sont mal ecrit -->
                    <h5 class ="text-center text-danger mt-3 text-uppercase py-2"><?php echo $erreur_nom;?></h5>
                </div>

                <div class="mt-3">
                    <label for="DATE_NAISSANCE" class="form-label">DATE DE NAISSANCE</label>
                    <input type="date" name="DATE_NAISSANCE" id="DATE_NAISSANCE" class="form-control" value="<?= $STAGE['DATE_NAISSANCE'] ?>">
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
                    <label for="ADRESSE" class="form-label">ADRESSE</label>
                    <input type="text" name="ADRESSE" id="ADRESSE" class="form-control" value="<?= $STAGE['ADRESSE'] ?>">
                    <h5 class ="text-center text-danger mt-3 text-uppercase py-2"><?php echo $erreur_adresse;?></h5>
                </div>
                <div class="mt-3">
                    <label for="CAMPUS" class="form-label" aria-label="Default select">NOM CAMPUS</label>
                    <select name="CAMPUS" id="CAMPUS" class="form-select">
                        <option value="NANFAH">INT NANFAH</option>
                        <option value="UDS">UDS </option>
                        <option value="IUC">IUC</option>
                        <option value="FOYAGEM">INT FOYAGEM</option>
                    </select>
                </div>
                <div class="mt-3">
                    <label for="FILIERE" class="form-label" aria-label="Default select">FILIERE </label>
                    <select name="FILIERE" id="FILIERE" class="form-select" value="<?= $STAGE['FILIERE'] ?>">
                        <option value="GEL">GENIE LOGICIEL</option>
                        <option value="MSI">INFOGRAPHIE</option>
                        <option value="INFO-IN">INFO INDUSTRIELLE</option>
                        <option value="RESEAUX">RESEAUX</option>
                    </select>
                </div>
                <div class="mt-3">
                    <label for="NIVEAU" class="form-label" aria-label="Default select">NIVEAU ETUDE </label>
                    <select name="NIVEAU" id="NIVEAU" class="form-select">
                        <option value="NIVEAU L1">LICENCE I</option>
                        <option value="NIVEAU L2">LICENCE II</option>
                        <option value="NIVEAU L3">LICENCE III</option>
                        <option value="MAT 1">MASTER I</option>
                        <option value="MAT 2">MASTER II</option>
                    </select>
                </div>
                <div class="mt-3">
                    <label for="PRIX_FORMATION" class="form-label">PRIX STAGE</label>
                    <input type="number" name="PRIX_FORMATION" id="PRIX_FORMATION" class="form-control" value="<?= $STAGE['PRIX_FORMATION'] ?>">
                    <h5 class ="text-center text-danger mt-3 text-uppercase py-2"><?php echo $erreur_numero;?></h5>

                </div>

                <h5 class="text-center text-success"><?php echo $MESSAGE_SUCCESS;?></h5>
                <div class="mt-3 d-flex justify-content-center align-items-center w-100 py-4">
                    <input type="submit" value="Envoyer" class="btn btn-success w-50" name="envoyer">
                </div> 
                                

            </form>
        </div>
    </div>
    
    

<?php
    //on require le footer pour le pied de page
    require_once('C:\xampp12\htdocs\ProjetGit\layout\footer.php');
?>