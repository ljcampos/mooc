<?php

class UserController extends Controller {

	static $routes 	=	array(
		'login'				=>	'loginForm',
		'loginAction'		=>	'loginAction',
		'suscribirme'		=>	'suscribirmeForm',
		'suscribirmeAction'	=>	'suscribirmeAction',
		'index'				=>	'indexAction',
		'updateUser'		=>	'updateUserForm',
		'updateUserAction' 	=>	'updateUserAction'
	);

	public function __construct ( $app ) { $this->app = $app; }


	public function loginForm () {

		$action = $this->app->urlFor('login-post');
		$token 	=	Utilities::generateFormToken();

		$this->view 	=	new LoginView($action, $token);
		$this->view->display();
	}


	public function loginAction (Array $post) {

		$keys 		=	array('usr_login', 'passwd_login');
		$this->verificarKeys($post, $keys);

		$email 		=	strip_tags( $post['usr_login'] );
		$email 		=	filter_var($email, FILTER_VALIDATE_EMAIL);
		$password 	=	strip_tags( $post['passwd_login'] );
		$password 	=	filter_var($password, FILTER_SANITIZE_STRING);

		if ( $email === "" || $password === "") {
			$this->app->flash('error', 'Debe ingresar todos los valores');
			$this->app->redirect( $this->app->request->getPath() );
		}

		$obj 	=	new Authentication( $this->app );
		$obj->Authenticate($email, $password);

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


	public function indexAction ($username) {

		$username 	=	strip_tags( $username );
		$username 	=	filter_var($username, FILTER_SANITIZE_STRING);

		$profil 	=	Profil::with('user')->where('username', '=', $username)->get();
		$total_elementos 	=	count($profil);

		if ( $total_elementos > 0 ) {

			$this->view 	=	new IndexUserView($profil[0]);

		} else {

			$this->view 	=	new IndexUserView();

		}	

		$this->view->display();

	}


	public function updateUserForm ($username) {

		$username 	=	strip_tags($username);
		$username 	= 	filter_var($username, FILTER_SANITIZE_STRING);

		$profil 	=	Profil::with('user')->where('username', '=', $username)->get();
		$total_elementos 	=	count($profil);

		if ($total_elementos > 0) {

			$session 		=	Session::getSession();

			if ( $session['username'] === $username || $session['auth_level'] >= 1000 ) {

				$countries 		=	Country::all();
				$action 		=	str_replace(':username', $profil[0]->username, $this->app->urlFor('modif-user-put'));
				$token 			=	Utilities::generateFormToken();
				$this->view 	=	new UserUpdateView($profil[0], $action, $token, $countries);

			} else {
				
				$this->app->flash('auth_error', 'No tiene los permisos suficientes para acceder a esta sección');				
				$this->view 	=	new UserUpdateView();				
			}


		} else {

			$this->view 	=	new UserUpdateView();
		}

		$this->view->display();
	}

	public function updateUserAction (Array $put) {

		$username 	=	strip_tags($put['usr']);
		$username 	=	filter_var($username, FILTER_SANITIZE_STRING);

		$profil 	=	Profil::with('user')->where('username', '=', $username)->get();
		$total_elementos 	=	count($profil);
		$action 	=	str_replace(':username', $username, $this->app->urlFor('form-modif-user'));


		if ($total_elementos > 0) {

			$keys 	=	array('firstname_upd', 'lastname_upd', 'email_upd', 'birthday_upd', 'gender_upd', 'country_upd', 'description_upd', 'address_upd');
			$this->verificarKeys($put['put'], $keys);
			$vars 	=	$put['put'];
			$this->sanitizeVars($vars);

			$firstname 		=	$vars['firstname_upd'];
			$lastname 		=	$vars['lastname_upd'];
			$email 	 		=	$vars['email_upd'];
			$email 			=	filter_var($email, FILTER_VALIDATE_EMAIL);
			$birthday 		=	$vars['birthday_upd'];
			$gender 		=	$vars['gender_upd'];
			$country 		=	$vars['country_upd'];
			$description 	=	$vars['description_upd'];
			$address		=	$vars['address_upd'];

			require_once __DIR__ . '/../vendor/smtp-validate-email-master/smtp-validate-email.php';

			$from 		=	'aaronlopezsosa@gmail.com';
			$validator 	=	new SMTP_Validate_Email($email, $from);
			$smtp_results 	=	$validator->validate();

			if (!$email || $smtp_results[$email] == 0) {
				$this->app->flash('error', 'correo electrónico no válido');
			} else {

				$profil[0]->firstname 	=	$firstname;
				$profil[0]->lastname 	=	$lastname;
				$profil[0]->email 		=	$email;
				$profil[0]->birthday 	=	$birthday;
				$profil[0]->gender 		=	$gender;
				$profil[0]->country_id 	=	$country;
				$profil[0]->description =	$description;
				$profil[0]->address 	=	$address;

				if ($profil[0]->save()) {
					$this->app->flash('success', 'Se actualizaron correctamente sus datos');
				} else {
					$this->app->flash('error', 'Estamos presentando problemas, por favor vuelva a intentarlo mas tarde');
				}

			}

		} else {
			$this->app->flash('error', 'Usuario no encontrado');
		}

		$this->app->redirect($action);

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

	private function sanitizeVars (Array &$vars) {

		foreach ($vars as $key => $value) {
			$value 			=	strip_tags($value);
			$value 			=	filter_var($value, FILTER_SANITIZE_STRING);
			$vars[$key] 	=	$value;
		}

	}


}

?>