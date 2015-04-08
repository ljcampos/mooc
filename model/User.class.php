<?php

use Illuminate\Database\Eloquent\Model as Model;

class User extends Model {

	protected 	$table 		=	'User';
	protected 	$primaryKey	=	'user_id';
	public 		$timestamps	=	false;
	
	public function profil () {
		return $this->hasOne('Profil', 'profil_id', 'user_id');
	}

	public function role () {
		return $this->belongsTo('Role', 'role_id');
	}
}

?>