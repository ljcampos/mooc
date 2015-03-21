<?php

class UserController extends Controller {

	static $routes 	=	array(
		'login'				=>	'loginForm',
		'loginAction'		=>	'loginAction',
		'suscribirme'		=>	'suscribirmeForm',
		'suscribirmeAction'	=>	'suscribirmeAction'
	);

	public function __construct ( $app ) { $this->app = $app; }

	public function loginForm () {

		$action = $this->app->urlFor('login-post');
		$token 	=	Utilities::generateFormToken();

		$this->view 	=	new LoginView($action, $token);
		$this->view->display();
	}

	public function loginAction (Array $post) {


	}

	public function suscribirmeForm () {

		$action 	=	$this->app->urlFor('suscribirme-post');
		$token 		=	Utilities::generateFormToken();

		$this->view 	=	new SuscribirmeView($action, $token);
		$this->view->display();

	}

	public function suscribirmeAction (Array $post) {

		$keys 		=	array('username_suscr', 'email_suscr', 'password_suscr');
		$action 	=	$this->app->request->getPath();

		$this->verificarKeys($post, $keys);

		$username 	=	strip_tags($post['username_suscr']);
		$username 	=	filter_var($username, FILTER_SANITIZE_STRING);
		$email 		=	strip_tags($post['email_suscr']);
		$email 		=	filter_var($email, FILTER_SANITIZE_STRING);
		$email 		=	filter_var($email, FILTER_VALIDATE_EMAIL);
		$password 	=	strip_tags($post['password_suscr']);
		$password 	=	filter_var($password, FILTER_SANITIZE_STRING);

		if ( $username == "" || $email == "" || $password == "" ) {
			$this->app->flash('error', 'Debe ingresar todos los datos');
			$this->app->redirect( $action );
		} else {	

			require_once __DIR__ . '/../vendor/smtp-validate-email-master/smtp-validate-email.php';

			$from 		=	'aaronlopezsosa@gmail.com';
			$validator 	=	new SMTP_Validate_Email($email, $from);
			$smtp_results 	=	$validator->validate();

			if ( $smtp_results[$email] == 0 ) {
				$this->app->flash('error', 'Correo electrónico no válido');
			}

			if ( strlen($password) < 8 ) {
				$this->app->flash('error', 'Su contraseña debe ser mayor a 8 caracteres');
			}

			$auth 	=	new Authentication( $this->app );
			$auth->createUser($username, $password, $email, 3);

		}

		
	}

	private function verificarKeys (Array $valores, Array $keys) {

		$total_elementos 	=	count($valores);

		foreach ($keys as $key => $value) {
			if ( !array_key_exists($value, $valores) ) {
				$this->app->flash('error', 'Faltan valores');
				$this->app->redirect( $this->app->request->getPath() );
			}
		}

	}

}

?>