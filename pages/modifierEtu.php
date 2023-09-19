<?php
//on demarre la session
session_start();
//on require le header pour l'entete de la page
$ID_TYPE_COMPTE = $_SESSION['ID_TYPE_COMPTE'];
$MOT = 'ADMIN';
$resultat = strstr($ID_TYPE_COMPTE,$MOT);
if($resultat===false){
    require_once('C:\xampp12\htdocs\ProjetGit\layout\headerset.php');
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
$ID_ETUDIANT = $_GET['ID_ETUDIANT'];
$date_actuel= date('Y');
$age = 0;

if(isset($_POST['envoyer'])){

    $NUM_TEL = strip_tags($_POST['NUM_TEL']);
    $EMAIL = strip_tags($_POST['EMAIL']);   
    $NOM_PRENOMS = strip_tags($_POST['NOM_PRENOMS']);
    $DATE_NAISSANCE = strip_tags($_POST['DATE_NAISSANCE']);
    $SEXE = strip_tags($_POST['SEXE']);
    $ADRESSE = strip_tags($_POST['ADRESSE']);
    $CHOIX_FORMATION = strip_tags($_POST['CHOIX_FORMATION']);
    $DATE = date("Y-m-d H:i:s");
    $annee_naiss = date('Y',strtotime($DATE_NAISSANCE));
    $age = $date_actuel-$annee_naiss;
    // echo "$age";
    $RANGNUMBER = rand(1000,10000);
    $INDICE = $NOM_PRENOMS[0].$NOM_PRENOMS[1].$NOM_PRENOMS[2];
    
    if(strlen($NUM_TEL)<=8){
        $erreur_numero = "le numero est incorrect";
        $ERREUR++;
    }elseif(strlen($EMAIL)<8 && empty($EMAIL)){
        $erreur_email = "l'email est mal renseigner";
        $ERREUR++;
    }elseif(strlen($NOM_PRENOMS)<=3 || !preg_match('/^[A-Z][a-zA-Z\s]+$/', $NOM_PRENOMS)){
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
    //    $ID_ETUDIANT = "3IA-ETU$date_actuel$INDICE-$RANGNUMBER";
     
        //requete d'insertion des etudiants
        $requetes = 'UPDATE  ETUDIANTS SET ID_ETUDIANT=:ID_ETUDIANT,ID_COMPTE=:ID_COMPTE,NUM_TEL=:NUM_TEL,EMAIL=:EMAIL,CHOIX_FORMATION=:CHOIX_FORMATION,RECU_ACTION=:RECU_ACTION,
        PRIX_FORMATION=:PRIX_FORMATION,NOM_PRENOMS=:NOM_PRENOMS,DATE_NAISSANCE=:DATE_NAISSANCE,SEXE=:SEXE,ADRESSE=:ADRESSE,DATE_DEBUT=:DATE_DEBUT
        WHERE ID_ETUDIANT=:ID_ETUDIANT';
        
        $stmt = $db->prepare($requetes);
        
        $stmt->bindParam(":ID_ETUDIANT",$ID_ETUDIANT,PDO::PARAM_STR);
        $stmt->bindParam(":ID_COMPTE",$_SESSION['ID_COMPTE'],PDO::PARAM_STR);
        $stmt->bindParam(":NUM_TEL",$_POST['NUM_TEL'],PDO::PARAM_INT);
        $stmt->bindParam(":RECU_ACTION",$_POST['RECU_ACTION'],PDO::PARAM_INT);
        $stmt->bindParam(":EMAIL",$_POST['EMAIL'],PDO::PARAM_STR);
        
        $stmt->bindParam(":NOM_PRENOMS",$_POST['NOM_PRENOMS'],PDO::PARAM_STR);
        $stmt->bindParam(":DATE_NAISSANCE",$_POST['DATE_NAISSANCE']);
        $stmt->bindParam(":SEXE",$_POST['SEXE'],PDO::PARAM_STR);
        $stmt->bindParam(":ADRESSE",$_POST['ADRESSE'],PDO::PARAM_STR);
        $stmt->bindParam(":CHOIX_FORMATION",$_POST['CHOIX_FORMATION'],PDO::PARAM_STR);
        $stmt->bindParam(":PRIX_FORMATION",$_POST['PRIX_FORMATION'],PDO::PARAM_INT);
        $stmt->bindParam(":DATE_DEBUT",$DATE);
        $stmt->execute(); 
        if($resultat===false){
            header('location:recuetu.php');
            
        }else{
            header('location:donneeetu.php');
            
        }
        // echo '<h4 class="text-center mt-5 py-5">Yo man c est une erreur</h4>';

    }
    }
    if(isset($_GET['ID_ETUDIANT'])){


        $requete = 'SELECT * FROM ETUDIANTS WHERE ID_ETUDIANT = ?';
        //on prepare la requete
        $query = $db->prepare($requete);
        //on excecute la requete
        $query->execute(array($ID_ETUDIANT));
        //on stock les donnees les donnes dans une variable
        $ETUDIANT = $query->fetch();
        // if(!$SECRET){   
        //     header('Location:admin.php');
        //     $message ="<h1 class='text-center text-danger border text-uppercase mt-5 py-5'> $message_erreur</h1>";
        // }
    }

?>

<div class="container mt-5 py-5">
        <div class="col-1  py-2 ms-5 mt-1  fixed-top mt-5 py-5">
            <a  class="text-warning float-start bg-success btn " href="donneeetu.php"><i class="bi bi-arrow-left-short icon-link-hover"></i></a>
        </div>
        <div class="row justify-content-center align-items-center w-100 py-2 mt-2">
            <form action="" method="post" class="bg-light w-50">
                <h1 class= "text-center text-info">Modification Information etudiant <?php echo $ETUDIANT['NOM_PRENOMS']; ?></h1>
                
                <div class="mt-3">
                    <input type="hidden" name="ID_ETUDIANT"  class="form-control" value="<?= $ETUDIANT['ID_ETUDIANT']?>">
                    <input type="hidden" name="ID_COMPTE"  class="form-control" value="<?= $ETUDIANT['ID_COMPTE']?>">

                    <label for="NUMERO_TEL" class="form-label">NUMERO TELEPHONE</label>
                    <input type="number" name="NUM_TEL" id="NUMERO_TEL" class="form-control" value="<?= $ETUDIANT['NUM_TEL']?>">
                    <h5 class ="text-center text-danger mt-3 text-uppercase py-2"><?php echo $erreur_numero;?></h5>

                </div>

                <div class="mt-3">
                    <label for="EMAIL" class="form-label">EMAIL</label>
                    <input type="email" name="EMAIL" id="EMAIL" class="form-control" value="<?= $ETUDIANT['EMAIL']?>">
                    <h5 class ="text-center text-danger mt-3 text-uppercase py-2"><?php echo $erreur_email;?></h5>

                </div>

                <div class="mt-3">
                    <label for="NOM_PRENOMS" class="form-label">NOM ET PRENOM</label>
                    <input type="text" name="NOM_PRENOMS" id="NOM_PRENOMS" class="form-control" value="<?= $ETUDIANT['NOM_PRENOMS']?>">
                    <!-- affiche l'erreur si le nom et le prenom sont mal ecrit -->
                    <h5 class ="text-center text-danger mt-3 text-uppercase py-2"><?php echo $erreur_nom;?></h5>
                </div>

                <div class="mt-3">
                    <label for="DATE_NAISSANCE" class="form-label">DATE DE NAISSANCE</label>
                    <input type="date" name="DATE_NAISSANCE" id="DATE_NAISSANCE" class="form-control" value="<?= $ETUDIANT['DATE_NAISSANCE']?>">
                    <h5 class ="text-center text-danger mt-3 text-uppercase py-2"><?php echo $erreur_date;?></h5>

                </div>

                <div class="mt-3">
                    <label for="SEXE" class="form-label">SEXE</label>
                    <div class="form-check-inline ms-4" value="<?= $ETUDIANT['SEXE']?>">
                        <input type="radio" name="SEXE" id="SEXEh" class="form-check-input"  value= "HOMME">
                        <label for="SEXEh" class="form-check-label">HOMME</label>
                    </div>
                    <div class="form-check-inline  ms-4">
                        <input type="radio" name="SEXE" id="SEXEf" class="form-check-input" value ="FEMME">
                        <label for="SEXEf" class="form-check-label">FEMME</label>
                    </div>
                </div>

                <div class="mt-3">
                    <label for="ADRESSE" class="form-label">ADRESSE</label>
                    <input type="text" name="ADRESSE" id="ADRESSE" class="form-control" value="<?= $ETUDIANT['ADRESSE']?>">
                    <h5 class ="text-center text-danger mt-3 text-uppercase py-2"><?php echo $erreur_adresse;?></h5>
                </div>
                <div class="mt-3">
                    <label for="RECU_ACTION" class="form-label">RECU_ACTION</label>
                    <input type="NUMBER" name="RECU_ACTION" id="RECU_ACTION" class="form-control" value="<?= $ETUDIANT['RECU_ACTION']?>">
                    <h5 class ="text-center text-danger mt-3 text-uppercase py-2"><?php echo $erreur_adresse;?></h5>
                </div>
                <div class="mt-3">
                    <label for="CHOIX_FORMATION" class="form-label" aria-label="Default select">CHOIX FORMATION</label>
                    <input name="CHOIX_FORMATION" id="CHOIX_FORMATION" class="form-control"  value="<?= $ETUDIANT['CHOIX_FORMATION']?>">
                        <!-- <option value="PRODEV">PROGRAMMATION</option>
                        <option value="INFOGRAPHIE">INFOGRAPHIE</option>
                        <option value="SECRETARIAT">SECRETARIAT</option>
                        <option value="RESEAUX">RESEAUX</option>
                        <option value="itAcadmy">ItAcadmy</option>
                    -->
                </div>
                <div class="mt-3">
                    <label for="MONTANT_PAYE" class="form-label">PRIX FORMATION VERSE</label>
                    <input type="number" name="MONTANT_PAYE" id="MONTANT_PAYE" class="form-control" value="<?= $ETUDIANT['MONTANT_PAYE']?>">
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