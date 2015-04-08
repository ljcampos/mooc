<?php

use Illuminate\Database\Eloquent\Model as Model;

class Profil extends Model {

	protected 	$table 			=	'Profil';
	protected	$primaryKey 	=	'profil_id';
	public 		$timestamps 	=	false;

	public function user () {
		return $this->belongsTo('User', 'profil_id');
	}
}

?>