<?php 
require_once 'vendor/autoload.php'; 


function enviar_correo_electronico($Asunto,$correo_usuario,$mensaje)
{
	$host = 'smtp.gmail.com';
	$puerto = 587;
	$encryptacion = 'tls';
	$correo_admin = 'cecomp.laravel@gmail.com';
	$nombre_admin = 'SisAdmin';
	$pass_admin = 'amen1234';

	try {
    		
		    $transport = (new Swift_SmtpTransport($host, $puerto,$encryptacion))
		        ->setUsername($correo_admin)
		        ->setPassword($pass_admin);
		 

		    $mailer = new Swift_Mailer($transport);

		    $message = new Swift_Message();

		    $message->setSubject($Asunto);
		 

		    $message->setFrom([$correo_admin => $nombre_admin]);

		    $message->addTo($correo_usuario,'');
		 
		    $message->setBody($mensaje);
		 
		  
		    $result = $mailer->send($message);

		} catch (Exception $e) {
		  echo $e->getMessage();
		}

}



?>
