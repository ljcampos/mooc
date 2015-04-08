<?php

//Include auto carga de clases
include_once __DIR__ . '/../vendor/autoload.php';

Connection::conecting();

$imagen_id 	=	$_GET['imagen_id'];
$imagen_id 	=	strip_tags( htmlspecialchars( $imagen_id ) );
$imagen_id 	=	intval( $imagen_id );
$imagen_id 	=	filter_var( $imagen_id, FILTER_VALIDATE_INT );



$dir 		=	__DIR__ . '/images/';
$prederterminada =	'default.jpg';
$file;



$multimedia 	=	File::find( $imagen_id );

if ( count($multimedia) > 0 ){

	$file 	=	$multimedia->name_saved;

}else {

	$file 	=	$prederterminada;

}

$path 	=	$dir . $file;

if ( file_exists( $path )) {

	$recurso 	=	finfo_open( FILEINFO_MIME_TYPE );
	$mime  		=	finfo_file( $recurso, $path );
	finfo_close( $recurso );

	header( "Content-Type: $mime");
	readfile( $path );
}


?>