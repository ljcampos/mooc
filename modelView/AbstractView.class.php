<?php

class AbstractView {

	protected	$layout;
	protected	$arrayVar = Array();

	public function __construct () {

		$session 	=	Session::getSession();
		$this->addVar('session', $session);
		$this->addVar('flash', $_SESSION['slim.flash']);
		
	}

	public function addVar ( $var, $val ) { $this->arrayVar[$var] = $val; }

	public function render () {

		$loader		=	new Twig_Loader_Filesystem( __DIR__ . '/../template/' );
		$twig 		=	new Twig_Environment( $loader, array('debug' => true) );
		$template	=	$twig->loadTemplate( $this->layout );

		return $template->render( $this->arrayVar );
	}

	public function display () { echo $this->render(); }
}
