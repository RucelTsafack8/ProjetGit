<?php
session_start();
$EMAIL=$_SESSION['EMAIL'];
$TOKEN=$_SESSION['TOKEN'];
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


// Load Composer's autoloader
require_once 'vendor/autoload.php';

   if($_SERVER["REQUEST_METHOD"] == "POST")
	{
       
		// require_once("config.php"); 
        // require_once("Code/functions.php");
		// CheckSession();
        // require_once("Code/ComposeReport.php");
	
		// Instantiation and passing `true` enables exceptions
		$mail = new PHPMailer(true);
		
		try{
			//Server settings
			$mail->SMTPDebug = 3;
			$mail->isSMTP();                                            
			$mail->Host       = 'smtp.gmail.com';                   
			$mail->SMTPAuth   = true;                                   
			$mail->Username   = 'petitdassi7@gmail.com';                     
			$mail->Password   = 'cvmirnmuzjvktwzr';                               
			$mail->SMTPSecure = 'tls';        
			$mail->Port       =  587;  
			
			//Recipients
			$mail->addAddress($EMAIL);            

			// Content
			$mail->isHTML(true);     
			// Set email format to HTML
			$mail->Subject = 'Test message Mailer';
			$mail->Body    = " <h2>salut !</h2>
            <h3>vous avez demandez a modifier votre mot de passe veillez cliquer sur le lien</h3>
            <a href='http://localhost/ProjetGit/motdepasse.php?EMAIL='.$EMAIL.'&TOKEN='.$TOKEN.''>reinitialiser le mot de passe</a>
            ";
			$mail->AltBody = 'Le test de l envoi d email avec php reussi avec success';
			
			if ($mail->Send()) {
				$result = 'le message a bien ete envoyer a tsafack rucel';
			} else {
				$result = "Error: " . $mail->ErrorInfo;
                echo "le message d erreur de connexion a la base ";
			}
		} catch (phpmailerException $e) {
			$result = $e->errorMessage();
		} catch (Exception $e) {
			$result = $e->getMessage();
		}
		
		// $today = date("Y-m-d H:i:s"); 
		// $myfile = fopen("output.txt", "a+") or die("Unable to open file!");
		
		// $output = "[" . $today . "] " . $result ."\n";
		
		// fwrite($myfile, $output);
		// fclose($myfile);	
        		
    }
	echo $EMAIL;
?>