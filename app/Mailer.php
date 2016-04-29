<?php
/**
 * @author Elias D. Peraza @tes1oner
 **/
namespace Colmena;
class Mailer{
	/**
	 * @param $destinarario: Array de objetos Cusuario
	*/
	public static function enviar($destinatario, $asunto, $contenido){
		return true;
		$transporte = \Swift_SmtpTransport::newInstance(env('MAIL_HOST', 'smtp.gmail.com'), env('MAIL_PORT', 587), env('MAIL_ENCRYPTION', 'tls'))
    				->setUsername(env('MAIL_USERNAME'))
    				->setPassword(env('MAIL_PASSWORD'));

		//Crear el mailer pasándole el transport con la configuración de gmail
		$mailer = \Swift_Mailer::newInstance($transporte);

		//Crear el mensaje pasandole el mailer
		$mensaje = \Swift_Message::newInstance($asunto)
			->setFrom(array(env('MAIL_SET_FROM_EMAIL', 'noresponer@colmena.com.ve') => env('MAIL_SET_FROM_NAME', 'Colmena - Sistema de Gestión del Talento Humano')))
            ->setTo(($destinatario instanceof Cusuario) ? $destinatario->email : $destinatario)
            ->setBody($contenido,'text/html');

		//Enviar el mail
		$resultado = $mailer->send($mensaje);
		return $resultado;
	}
	public static function enviar2(){
		$mail = new PHPMailer;
		//$mail->SMTPDebug = 3;                               // Enable verbose debug output
		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = env('smtp.gmail.com');  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = env('MAIL_USERNAME');                 // SMTP username
		$mail->Password = env('MAIL_PASSWORD');                           // SMTP password
		$mail->SMTPSecure = env('MAIL_ENCRYPTION','tls');                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = env('MAIL_PORT');                                    // TCP port to connect to

		$mail->setFrom(env('MAIL_SET_FROM_EMAIL'), env('MAIL_SET_FROM_NAME'));
		$mail->addAddress('recipiente@mail.com', 'Nombre');     // Add a recipient
		//$mail->addAddress('ellen@example.com');               // Name is optional
		$mail->addReplyTo(env('MAIL_REPLAY_TO'), env('MAIL_REPLAY_TO_NAME'));

		//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
		$mail->isHTML(true);                                  // Set email format to HTML

		$mail->Subject = 'Here is the subject';
		$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
		$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		if(!$mail->send()) {
		    echo 'Message could not be sent.';
		    echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
		    echo 'Message has been sent';
		}
	}

}
