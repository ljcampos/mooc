<?php

use Illuminate\Database\Eloquent\Model as Model;

class User extends Model {

	protected 	$table 		=	'User';
	protected 	$primaryKey	=	'user_id';
	public 		$timestamps	=	false;
	
}

?>