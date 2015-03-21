<?php

class SuscribirmeView extends AbstractView {

	public function __construct ($action, $token) {

		parent::__construct();
		$this->layout 	=	'suscribirme.html.twig';
		$this->addVar('action', $action);
		$this->addVar('token', $token);
	}
}

?>