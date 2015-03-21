<?php

class IndexView extends AbstractView {

	public function __construct () {

		parent::__construct();
		$this->layout 	=	'index.html.twig';
	}
}

?>