<?php

/**
* Company users model
*
* @package		SAAV
* @subpackage	Controllers
* @author		Mario Cuba <mario@mariocuba.net>
*/
class Company_User extends Eloquent {
	public static $timestamps = true;

	/**
	* A company can have several users
	**/
	public function users() {
		return $this->has_many('User');
	}
}