<?php

class Session {

	public function __construct () {

	}

	public function startSession () {

		if (session_status() !== PHP_SESSION_ACTIVE) {
			session_cache_limiter(false);
			session_start();
		}
	}

	public static function getSession () {

		if ( isset($_SESSION['perfil']) )
			return $_SESSION['perfil'];
		else
			return null;
	}
	
}

?>