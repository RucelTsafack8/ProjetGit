<?php
//on demarre la session
session_start();
//on require le header pour l'entete de la page
require_once('header.php');


//require once le fichier conect pour la connexion a la base de dennees
require_once('connect.php');
$erreur_nom = '';
$erreur_email = '';
$erreur_numero = '';
$erreur_cni = '';
$erreur_adresse = '';
$erreur_date = '';
$MESSAGE_SUCCESS='';
$ERREUR = 0;
$ID_ETUDIANT= '';

$date_actuel= date('Y');
$age = 0;
echo "$date_actuel";
if(isset($_POST['envoyer'])){

    $NUM_TEL = $_POST['NUM_TEL'];
    $EMAIL = $_POST['EMAIL'];
    $NOM_PRENOMS = $_POST['NOM_PRENOMS'];
    $DATE_NAISSANCE = $_POST['DATE_NAISSANCE'];
    $SEXE = $_POST['SEXE'];
    $ADRESSE = $_POST['ADRESSE'];
    $DATE = date("D-M-Y");
    $annee_naiss = date('Y',strtotime($DATE_NAISSANCE));
    $age = $date_actuel-$annee_naiss;
    echo "$age";
    $RANGNUMBER = rand(1000,10000);
    $INDICE = $NOM_PRENOMS[0].$NOM_PRENOMS[1].$NOM_PRENOMS[2];
    
    if(strlen($NUM_TEL)<=8){
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
    }elseif ($ERREUR<0){
        $ID_ETUDIANT = "3IA-ETU$date_actuel$INDICE-$RANGNUMBER";
        echo "$ID_ETUDIANT";
    
        //requete d'insertion des etudiants
        $requetes = 'INSERT INTO ETUDIANTS(ID_ETUDIANT,ID_COMPTE,NUM_TEL,EMAIL,NOM_PRENOMS,DATE_NAISSANCE,SEXE,ADRESSE,CHOIX_FORMATION,DATE_DEBUT)
        VALUES (:ID_ETUDIANT,:ID_COMPTE,:NUM_TEL,:EMAIL,:NOM_PRENOMS,:DATE_NAISSANCE,:SEXE,:ADRESSE,:CHOIX_FORMATION,:DATE_DEBUT)';
        $MESSAGE_SUCCESS = "insertion de l'etudiant reussi";

        $stmt = $db->prepare($requetes);
        $stmt->bindParam(":ID_ETUDIANT",$ID_ETUDIANT,PDO::PARAM_STR);
        $stmt->bindParam(":ID_COMPTE",$_SESSION['ID_COMPTE'],PDO::PARAM_STR);
        $stmt->bindParam(":NUMERO_TEL",$_POST['NUMERO_TEL'],PDO::PARAM_INT);
        $stmt->bindParam(":EMAIL",$_POST['EMAIL'],PDO::PARAM_STR);
        
        $stmt->bindParam(":NOM_PRENOMS",$_POST['NOM_PRENOMS'],PDO::PARAM_STR);
        $stmt->bindParam(":DATE_NAISSANCE",$_POST['DATE_NAISSANCE']);
        $stmt->bindParam(":SEXE",$_POST['SEXE'],PDO::PARAM_STR);
        $stmt->bindParam(":ADRESSE",$_POST['ADRESSE'],PDO::PARAM_STR);
        $stmt->bindParam(":CHOIX_FORMATION",$_POST['CHOIX_FORMATION'],PDO::PARAM_STR);
        $stmt->bindParam(":DATE_DEBUT",$DATE);
        $stmt->execute();

        header('location:details.php');
    }


}
?>

<body>
    <div class="container mt-5 py-5">
        <div class="row justify-content-center align-items-center w-100 py-2 mt-2">
            <form action="" method="post" class="bg-light w-75">
                <h1 class= "text-center text-info text-uppercase">inscrition etudiants</h1>
                
                <div class="mt-3">
                    <label for="NUMERO_TEL" class="form-label">NUMERO TELEPHONE</label>
                    <input type="number" name="NUM_TEL" id="NUMERO_TEL" class="form-control">
                    <h5 class ="text-center text-danger mt-3 text-uppercase py-2"><?php echo $erreur_numero;?></h5>

                </div>

                <div class="mt-3">
                    <label for="EMAIL" class="form-label">EMAIL</label>
                    <input type="email" name="EMAIL" id="EMAIL" class="form-control">
                    <h5 class ="text-center text-danger mt-3 text-uppercase py-2"><?php echo $erreur_email;?></h5>

                </div>

                <div class="mt-3">
                    <label for="NOM_PRENOMS" class="form-label">NOM ET PRENOM</label>
                    <input type="text" name="NOM_PRENOMS" id="NOM_PRENOMS" class="form-control">
                    <!-- affiche l'erreur si le nom et le prenom sont mal ecrit -->
                    <h5 class ="text-center text-danger mt-3 text-uppercase py-2"><?php echo $erreur_nom;?></h5>
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
                    <label for="ADRESSE" class="form-label">ADRESSE</label>
                    <input type="text" name="ADRESSE" id="ADRESSE" class="form-control">
                    <h5 class ="text-center text-danger mt-3 text-uppercase py-2"><?php echo $erreur_adresse;?></h5>
                </div>
                <div class="mt-3">
                    <label for="CHOIX_FORMATION" class="form-label" aria-label="Default select">CHOIX FORMATION</label>
                    <select name="CHOIX_FORMATION" id="CHOIX_FORMATION" class="form-select">
                        <option value="PRODEV">PROGRAMMATION</option>
                        <option value="INFOGRAPHIE">INFOGRAPHIE</option>
                        <option value="SECRETARIAT">SECRETARIAT</option>
                        <option value="RESEAUX">RESEAUX</option>
                        <option value="itAcadmy">ItAcadmy</option>
                    </select>
                </div>

                <h5 class="text-center text-success"><?php echo $MESSAGE_SUCCESS;?></h5>
                <div class="mt-3 d-flex justify-content-center align-items-center w-100 py-4">
                    <input type="submit" value="Envoyer" class="btn btn-success w-50" name="envoyer">
                </div> 
                                

            </form>
        </div>
    </div>
    
</body>
</html>
<?php
    //on require le footer pour le pied de page
    require_once('footer.php');
?>