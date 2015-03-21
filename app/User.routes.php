<?php

/**********************************************************************
Ruta que permite visualizar el formulario de autenticación al sitio web
**********************************************************************/
$app->get('/login', function () use ( $app ) {

	$controller 	=	new UserController( $app );
	$controller->callAction('login');

})->name('login-form');


/*************************************************************************
Ruta que realiza el proceso de autenticación de un usuario ("Login post").
Se espera recibir los siguientes valores por el método POST
	=> usr_login: nombre de usuario
	=> passwd_login: contraseña de usuario
*************************************************************************/
$app->post('/login', 'checkToken', function () use ( $app ) {

	$controller 	=	new UserController( $app );
	$controller->callAction('loginAction', $app->request->post());

})->name('login-post');



/**********************************************************************
Ruta que permite visualizar el formulario de inscripcion al sitio web
**********************************************************************/
$app->get('/suscribirme', function () use ( $app ) {

	$controller 	=	new UserController( $app );
	$controller->callAction('suscribirme');

})->name('suscribirme');


/*************************************************************************
Ruta que realiza el proceso de inscripción de un usuario ("Suscribirme POST").
Se espera recibir los siguientes valores por el método POST
	=> usernae_suscr: nombre de usuario
	=> email_suscr: Correo electrónico
	=> password_suscr: Contraseña
*************************************************************************/
$app->post('/suscribirme', 'checkToken', function () use ( $app ) {

	$controller 	=	new UserController( $app );
	$controller->callAction('suscribirmeAction', $app->request->post());

})->name('suscribirme-post');


/*************************************************************************
Ruta que muestra la págin principal de un usuario
*************************************************************************/
$app->get('/user/:username', 'verificarInactividad', function ( $username ) use ( $app ) {

	echo $username;
	echo '<pre>';
	print_r($_SESSION['perfil']);
	echo '</pre>';

})->name('home-user');