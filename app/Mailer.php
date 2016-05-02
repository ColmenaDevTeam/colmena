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
		$resultado = false;
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

		try{
			//Enviar el mail
			$resultado = $mailer->send($mensaje);
		}catch(\Swift_TransportException $e){
			$resultado = false;
		}catch(\Exception $e){
			$resultado = false;
		}
		return $resultado;
	}
}
