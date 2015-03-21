<?php

/**********************"Funciones Middlewares"**********************
Estas funciones nos permiten realizar diversas validaciones.
	=> Validar la presencia de un token en cada formulario.
	=> Verificar tiempo máximo de inactividad de una sesión.
	=> Verificar si existe o no una sesion activa.
******************************************************************/


/**********************"Middleware checkToken()"**************************************
La función de este middleware es la de verificar la presencia de un valor "token"
dentro de un formulario asi también, verificar la fecha de expiración del mismo token,
esto con el fin de controlar un tiempo máximo de vida de una formulario.
*************************************************************************************/
function checkToken () {

	$app 	=	\Slim\Slim::getInstance();
	$token 	=	Utilities::getTokenForm();

	if ( !is_null($token) ) {

		$ip_cliente 	=	$_SERVER['REMOTE_ADDR'];
		$fecha_actual 	=	strtotime( date('Y:m:d H:i:s') );

		if( ($fecha_actual > $token['fecha_expiracion']) || ($ip_cliente !== $token['ip_cliente']) ) {
			
			$app->flash('error', 'Tiempo de vida del formulario agotado');
			$app->redirect( $app->request->getPath() );			
		}


	} else {

		$app->flash('error', 'Tiempo de vida del formulario agotado');
		$app->redirect( $app->request->getPath() );
	}

}


function verificarInactividad () {

	$app 		=	\Slim\Slim::getInstance();
	$sesion 	=	Session::getSession();

	if ( !is_null($sesion) ) {
	
		$ip_cliente 		=	$_SERVER['REMOTE_ADDR'];
		$fecha_actual 		=	strtotime( date('Y:m:d H:i:s') );
		$fecha_expiracion 	=	strtotime('+1 minute', $sesion['ultima_accion']);

		if ( $fecha_actual > $fecha_expiracion ) {
			
			//$_SESSION 	=	array();
			session_destroy();

			$app->flash('error', 'Sesión expirada');
			$app->redirect( $app->urlFor('login-form') );

		} else {
			$_SESSION['perfil']['ultima_accion'] 	=	$fecha_actual;
		}

	}

}

