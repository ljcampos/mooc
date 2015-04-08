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
$app->get('/logout', function () use ( $app ) {

	$_SESSION 	=	array();
	session_destroy();
	$app->redirect( $app->urlFor('login-form') );

})->name('logout');


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
$app->get('/user/:username', 'verificarInactividad', $authenticateForLevel(100), function ( $username ) use ( $app ) {

	$controller 	=	new UserController( $app );
	$controller->callAction('index', $username);

})->name('home-user');


/*************************************************************************
Ruta que muestra el formulario para modificar un usuario
*************************************************************************/
$app->get('/user/:username/modificar', 'verificarInactividad', $authenticateForLevel(100), function ($username) use ( $app ) {

	$controller 	=	new UserController( $app );
	$controller->callAction('updateUser', $username);

})->name('form-modif-user');

$app->put('/user/:username', 'checkToken', 'verificarInactividad', $authenticateForLevel(100), function ($username) use ( $app ) {

	$post 	=	array('put' => $app->request->put(), 'usr' => $username);

	$controller 	=	new UserController( $app );
	$controller->callAction('updateUserAction', $post);

})->name('modif-user-put');


/*************************************************************************
Ruta que permite guardar una foto de perfil
*************************************************************************/
$app->post('/avatar', function () use ( $app ) {

})->name('guardar-avatar');


