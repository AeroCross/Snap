<?php

/**
* Department model
*
* @package		SAAV
* @subpackage	Controllers
* @author		Mario Cuba <mario@mariocuba.net>
*/
class Department extends Eloquent {
	public static $timestamps = true;

	/** 
	* A department can have lots of users, and 
	* the same user can belong to different departments
	*/
	public function user() {
		return $this->has_many_and_belongs_to('User', 'department_members');
	}

	/**
	* Alias of $this->user()
	*/
	public function users() {
		return $this->has_many_and_belongs_to('User', 'department_members');
	}
}