<?php
require('C:\xampp12\htdocs\ProjetGit\fpdf.php');
require_once('C:\xampp12\htdocs\ProjetGit\layout\connect.php');


include('C:\xampp12\htdocs\ProjetGit\pages\ajax\ChiffresEnLettres.php');

$lettre=new ChiffreEnLettre();



class PDF extends FPDF
{
    // En-tête
    function Header()
    {
        // Logo
        $this->Image('C:\xampp12\htdocs\ProjetGit\pages\images\image3ia.png',10,10,80);
        // Police Arial gras 15
        $this->SetFont('Arial','B',35);
        // Décalage à droite
        $this->Cell(100);
        // Titre
        $this->Image('C:\xampp12\htdocs\ProjetGit\pages\images\Image2.png',80,10,100);
    
        
        // Saut de ligne
        $this->Ln(20);
    }
    // Pied de page
    function Footer()
    {
        $DATE = date("H:i:s");
        $DATED = date("d-m-Y");
        // Positionnement à 1,5 cm du bas
        $this->SetY(-15);
        // Police Arial italique 8
        // $this->SetFont('Arial','I',8);
        $this->Ln(-12);
        $this->SetFont('Arial','B',9);
        $this->Cell(135);
        $this->Cell(0,5,'Fait a Dschang le '.$DATED.' a '.$DATE.'');
        $this->Ln(06);
        //$this->Image('images\3ia.jpg',10,20,100);
        
        //mot de pied de page
        $this->Cell(0,10,utf8_decode('NB : ce reçu n\'est établir qu\'une seule fois, '),'C');
        $this->Ln(06);
        $this->Cell(0,10,utf8_decode('Toute falsification de ce document fera l\'objet de poursuite judiciaire,'),'C');
        $this->Ln(06);
        $this->Cell(0,10,utf8_decode('Toujours se rassurer que votre reçu soit signé par la secrétaire comptable ou par le promoteur'),'C');
    }
}
$NBRE = 0;
$dateA = date("Y");


if(isset($_GET['ID_ETUDIANT'])){
    $ID_ETUDIANT =$_GET['ID_ETUDIANT'];

    $requete = 'SELECT * FROM ETUDIANTS WHERE ID_ETUDIANT = ? AND RECU_ACTION = 1';
    //on prepare la requete
    $query = $db->prepare($requete);
    //on excecute la requete
    $query->execute(array($ID_ETUDIANT));
    //on stock les donnees les donnes dans une variable
    $ETUDIANT = $query->fetch();
}
    $requete = 'SELECT NOM_FORMATION, MODE_VERSEMENT,DUREE_FORMATION FROM ETUDIANTS etu JOIN FORMATIONS ft ON etu.CHOIX_FORMATION=ft.ID_FORMATION WHERE ID_ETUDIANT = ?';
    $query3 = $db->prepare($requete);
    //on excecute la requete
    $query3->execute(array($ID_ETUDIANT));
    //on stock les donnees les donnes dans une variable
    $FORMATION = $query3->fetch();

    $req = ' SELECT NOM_PRENOMS  FROM personnels WHERE ID_COMPTE = ? ';
    $query4= $db->prepare($req);
    //on excecute la requete
    $query4->execute(array($ETUDIANT['ID_COMPTE']));
    //on stock les donnees les donnes dans une variable
    $PERSON = $query4->fetch();
// Instanciation de la classe dérivée
$NBRE = substr($ETUDIANT['ID_ETUDIANT'],-1);
try{ 
    $pdf = new PDF('L','mm','A5');

    $pdf->AddPage();
    $pdf->SetFont('Times','B',12);
    $pdf->Ln(9);

    $pdf->Cell(140);      
    $pdf->Cell(60,20,utf8_decode( 'Reçu No  :     '.$NBRE.''));
    $pdf->SetFont('Times','B',12);
    $pdf->Ln(3);
    $pdf->Cell(1,15,'ID Etudiant  :        '.$ETUDIANT['ID_ETUDIANT'].'');
    $pdf->Ln(8);
    $pdf->SetFont('Times','B',12);
    $pdf->Cell(1,15,'Noms et Prenoms :        '.$ETUDIANT['NOM_PRENOMS'].'');
    $pdf->SetFont('Arial','I',7);
    $pdf->Ln(3);
    $pdf->Cell(1,15,'NAME AND SURNAME : ');
    $pdf->SetFont('Times','B',12);
    $pdf->Cell(100);
    $pdf->Cell(1,15,utf8_decode('Année académique  :  '.$dateA.' / '.($dateA+1).'')); 

    $pdf->Ln(9);
    // $pdf->Cell(12);
    $pdf->Cell(1,15,'Tel:        '.$ETUDIANT['NUM_TEL'].'');
    $pdf->SetFont('Arial','I',7);
    $pdf->Ln(3);
    $pdf->Cell(1,15,'PHONE NUMBER : ');
    $pdf->SetFont('Times','B',12);
    $pdf->Cell(100);
    $pdf->Cell(1,15,utf8_decode('Spécialité :         '.$FORMATION['NOM_FORMATION'].''));
    $pdf->SetFont('Arial','I',7);
    // $pdf->Cell(100);
    $pdf->Cell(1,22,'SPECIALITY: ');
    $pdf->Ln(9);
    $pdf->SetFont('Times','B',12);
    $pdf->Cell(1,10,'Mode de versement :         '.$FORMATION['MODE_VERSEMENT'].'');
    $pdf->Ln(9);
    $pdf->Cell(1,10,utf8_decode( 'Total a versé  :    '.$ETUDIANT['PRIX_FORMATION'].' F'));
    $pdf->SetFont('Arial','I',7);
    $pdf->Ln(3);
    $pdf->Cell(1,10,' TOTAL AMOUNT : ');
    $pdf->SetFont('Times','B',12);
    $pdf->Cell(100);
    $pdf->Cell(1,5,utf8_decode(' Durée formation :         '.$FORMATION['DUREE_FORMATION'].''));
    $pdf->SetFont('Arial','I',7);
    // $pdf->Cell(100);
    $pdf->Cell(1,15,'During: ');

    $pdf->SetFont('Times','B',12);
    $pdf->Ln(4);   
    $pdf->Cell(1,10,'En Lettre :    '.$lettre->Conversion($ETUDIANT['PRIX_FORMATION']).' F');

    $pdf->Ln(9);   
    $pdf->Cell(1,10,'Avance :      '.$ETUDIANT['MONTANT_PAYE'].' F');
    $pdf->SetFont('Arial','I',7);
    $pdf->Ln(3);
    $pdf->Cell(1,10,'Amount : ');
    $pdf->SetFont('Times','B',12);
    $pdf->Ln(4);   
    $pdf->Cell(1,10,'En Lettre :    '.$lettre->Conversion($ETUDIANT['MONTANT_PAYE']).' F');
    $pdf->Cell(100); 
    $pdf->Cell(1,5,' Reste:         '.$ETUDIANT['PRIX_FORMATION']-$ETUDIANT['MONTANT_PAYE'].' F');
    $pdf->Ln(7);   
    //$pdf->Cell(1,10,'Etablir par  :      '.$PERSON['NOM_PRENOMS'].' ');
    $pdf->Ln(3);   
    $pdf->Cell(85);
    $pdf->Cell(1,10,'Signature :         ');




    $pdf->Output();
     }catch (PDOExeption $e){
        echo "Impossible d'imprimer se recu $e->getError()";
     }
?>