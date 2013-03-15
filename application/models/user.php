<?php

/**
* User model
*
* @package		SAAV
* @subpackage	Controllers
* @author		Mario Cuba <mario@mariocuba.net>
*/
class User extends Eloquent {
	public static $timestamps = true;

	/** 
	* An user can belong to different departments, and 
	* a department can have a lot of users
	*/
	public function department() {
		return $this->has_many_and_belongs_to('Department', 'department_members');
	}
}