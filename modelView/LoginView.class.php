<?php

class LoginView extends AbstractView {

	public function __construct ($action, $token) {

		parent::__construct();
		$this->layout 	= 	'login.html.twig';
		$this->addVar('action', $action);
		$this->addVar('token', $token);
		
	}
}

?>