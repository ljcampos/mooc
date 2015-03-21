<?php

class FrontController extends Controller {

	static $routes 	=	array(
		'index'		=>	'indexAction'
	);

	public function __construct ( $app ) { $this->app 	=	$app; }

	public function indexAction () {

		$this->view 	=	new IndexView();
		$this->view->display();

	}
	
}

?>