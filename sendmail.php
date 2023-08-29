<?php
$to= "leprinceruce@gmail.com";
$subject = 'Envoi mail avec PHP';
$message = 'Salut tsafack comment tu vas ';
$headers = "From:petitdassi7@gmail.com\r\n"; 
$headers .= "Content-type :text/plain; charset=utf-8\r\n";
if(mail($to, $subject, $message , $headers)){
    echo "Envois reussi";
}
else{
    echo "Echec de l'envoi de l'email !";
}

?>