<?php

class Authentication {

	private $app;

	public function __construct ( $app ) { $this->app = $app; }

	public function createUser($username, $password, $email, $role_id) {

		$profil 		=	Profil::where('username', '=', $username)->orWhere('email', '=', $email)->get();
		$coincidencia 	=	count($profil);
		$action 		=	$this->app->request->getPath();

		if ( $coincidencia > 0 ) {
			$this->app->flash('error', 'Usuario y/o Correo electrónico usado');		
		} else {
			
			$role 			=	Role::find($role_id);
			$existe_role 	=	count($role);

			if ( $existe_role > 0 ) {

				$salt 	=	hash('sha256', uniqid());
				$token 	=	hash('sha256', uniqid());
				$hash	=	hash('sha256', $password . $salt);
				
				$user 	=	new User;
				$user->role_id 	=	$role_id;
				$user->password =	$hash;
				$user->salt 	=	$salt;
				$user->token 	=	$token;
				$user->save();

				$profil 	=	new Profil;
				$profil->profil_id 	=	$user->user_id;
				$profil->username 	=	$username;
				$profil->email 		=	$email;
				$profil->save();

				$this->loadProfil($profil, $role->auth_level);
				$action 	=	str_replace(':username', $profil->username, $this->app->urlFor('home-user'));

			} else {
				$action 	=	$this->app->urFor('index');
			}

		}

		$this->app->redirect( $action );

	}

	private function loadProfil ( Profil $profil, $auth_level ) {

		$ip_cliente 	=	$_SERVER['REMOTE_ADDR'];
		$ultima_accion 	=	strtotime( date('Y:m:d H:i:s') );
		$token_sesion 	=	hash('sha256', uniqid());

		$array_profil 	=	array(
			'username' 		=>	$profil->username,
			'auth_level'	=>	$auth_level,
			'ultima_accion'	=>	$ultima_accion,
			'token_sesion'	=>	$token_sesion,
			'ip_cliente'	=>	$ip_cliente
		);

		$_SESSION['perfil'] 		=	$array_profil;
		$_SESSION['token_sesion'] 	=	$token_sesion;

	}

}

?>