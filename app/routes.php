<?php

/******************************************************
Include del archivo que contiene las funciones
middlewares: 

=> Verificación de sesión
=> Verificación de la existencia de variable token

*********************************************************/

//Include Middlewares
include_once __DIR__ . '/middlewares.php';


/********************************************
	Include los archivos que contienen
	las rutas clasificadas por controlador
********************************************/

//Rutas para el controlador FrontController
include_once __DIR__ . '/front.routes.php';

//Rutas para el controlador UserController
include_once __DIR__ . '/User.routes.php';