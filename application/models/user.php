<?php

/**
* User model
*
* @package		SAAV
* @subpackage	Models
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

	/**
	* An user can have many messages in tickets, but a message
	* can belong only to a single user
	*/
	public function messages() {
		return $this->has_many('Message');
	}

	/**
	* An user can only be part of one company, but the
	* company can have unlimited users
	*/
	public function company() {
		return $this->has_one('Company_User');
	}
}