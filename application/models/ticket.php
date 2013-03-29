<?php

/**
* Ticket model
*
* @package		SAAV
* @subpackage	Controllers
* @author		Mario Cuba <mario@mariocuba.net>
*/
class Ticket extends Eloquent {
	public static $timestamps = true;

	/**
	* A ticket can have several messages, but a message
	* can only belong to one ticket
	*/
	public function messages() {
		return $this->has_many('Message');
	}
}