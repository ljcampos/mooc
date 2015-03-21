<?php

//Incluir la auto carga de clases
require_once __DIR__ . '/../vendor/autoload.php';


/***********************
Configuración de Slim
************************/

//Instaciamos el objeto slim
$app 	= new \Slim\Slim();
$conf 	=	parse_ini_file(__DIR__ . '/../config/conf.slim.ini');
$app->config( $conf );


//Inicio de session
$session 	=	new Session();
$session->startSession();



//Incluir el archivo de configuración de las rutas
include_once __DIR__ . '/../app/routes.php';


//Iniciamos la aplicación
$app->run();