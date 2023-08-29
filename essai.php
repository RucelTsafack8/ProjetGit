<?php
    require_once('connect.php');
   //on selectionne la colonne des montat e la table etudiant et on fait la somme
    $query = 'SELECT ID_FORMATION, NOM_FORMATION FROM FORMATIONS';
    $form = $db->prepare($query);
    $form->execute();
    $formation = $form->fetchAll(PDO::FETCH_ASSOC);
    var_dump($formation);
    echo '<label> choix formation</label>';
    echo '<select name="CHOIX_FORMATION">';
        foreach ($formation as $choix){
            echo '<option value="'.$choix['ID_FORMATION'].'"> '.$choix['NOM_FORMATION'].'</option>';
        }
    
    echo '</select>';
      
             


?>