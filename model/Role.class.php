<?php

use Illuminate\Database\Eloquent\Model as Model;

class Role extends Model {

	protected 	$table 		=	'Role';
	protected 	$primaryKey =	'role_id';
	public 		$timestamps =	false;

	public function users () {
		return $this->hasMany('User', 'role_id');
	}
}
?>