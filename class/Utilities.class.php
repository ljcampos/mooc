<?php

class Utilities {
	
	public static function generateFormToken () {

		$token 				=	hash('sha256', uniqid());
		$fecha_creacion 	=	strtotime( date('Y-m-d H:i:s') );
		$fecha_expiracion 	=	strtotime('+15 minute', $fecha_creacion);
		$ip_cliente 		=	$_SERVER['REMOTE_ADDR'];

		$array_token 	=	array(
			'token'				=>	$token,
			'fecha_creacion'	=>	$fecha_creacion,
			'fecha_expiracion'	=>	$fecha_expiracion,
			'ip_cliente'		=>	$ip_cliente
		);

		$_SESSION['_token'] 	=	$array_token;

		return $token;
	}

	public static function getTokenForm () {

		if ( isset($_SESSION['_token']) )
			return $_SESSION['_token'];
		else 
			return null;

	}

}

?>