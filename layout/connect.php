<?php
    try {
        //connexion a la base de donnees
        $db= new PDO("mysql:host=localhost; dbname=sir_gestion; port=3306; chartset=utf8",'root','');

    } catch (PDOExeption $th) {
        // en cas d'echec de connexion a la base de donnees 
        echo 'Erreur '.$th->getMessage();
        die();
    }
?>