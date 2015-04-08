<?php


class UserUpdateView extends AbstractView {

	public function __construct (Profil $profil = null,  $action = null, $token = null, $countries = null) {

		parent::__construct();
		$this->layout 	=	'user_update.html.twig';
		$this->addVar('profil', $profil);
		$this->addVar('action', $action);
		$this->addVar('token', $token);
		$this->addVar('countries', $countries);
		
	}
}

?>