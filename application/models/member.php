<?php

/**
* Member model
*
* @package		SAAV
* @subpackage	Controllers
* @author		Mario Cuba <mario@mariocuba.net>
*/
class Member extends Eloquent {
	public static $timestamps	= true;

	// the "pivot" table does not follow conventions
	public static $table		= 'department_members';
}