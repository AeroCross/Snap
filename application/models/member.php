<?php

/**
* Member model
*
* @package		SAAV
* @subpackage	Controllers
* @author		Mario Cuba <mario@mariocuba.net>
*/
class Member extends Eloquent {

	// the "pivot" table does not follow conventions
	public static $table		= 'department_members';
	public static $timestamps	= true;
}