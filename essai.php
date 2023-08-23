<?php

    $message_erreur = "3IA-2023-ADMIN.TSA-815";
    $MOT = 'ADMIN';
    $resultat = strstr($message_erreur,$MOT);
    if($resultat===false){
        echo "le mot est introuvable";
    }else{
        echo "'le mot .$MOT. viens d etre trouve'";
    }

?>