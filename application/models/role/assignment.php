<?php

/**
* Role Assignment model
*
* @package		SAAV
* @subpackage	Controllers
* @author		Mario Cuba <mario@mariocuba.net>
*/
class Role_Assignment extends Eloquent {
	public static $timestamps = true;

	/**
	* A role can have several users
	**/
	public function users() {
		return $this->has_many('User');
	}
}