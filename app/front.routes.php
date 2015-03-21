<?php

//Index de la aplicación
$app->get('/', function () use ($app) {
	
	$controller 	=	new FrontController( $app );
	$controller->callAction('index');

})->name('index');

