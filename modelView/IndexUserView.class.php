<?php

class IndexUserView extends AbstractView {

	public function __construct (Profil $profil = null) {

		parent::__construct();
		$this->layout 	=	'index_user.html.twig';
		$this->addVar('profil', $profil);
	}
}

?>