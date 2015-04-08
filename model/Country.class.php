<?php

use Illuminate\Database\Eloquent\Model as Model;

class Country extends Model {

	protected 	$table 			=	'Country';
	protected 	$primaryKey 	=	'country_id';
	public 		$timestamps 	=	false;

	public function profils () {
		return $this->hasMany('Profil', 'country_id');
	}
}

?>