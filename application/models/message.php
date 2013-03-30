<?php

/**
* Messages model
*
* @package		SAAV
* @subpackage	Models
* @author		Mario Cuba <mario@mariocuba.net>
*/
class Message extends Eloquent {
	public static $timestamps = true;

	/**
	* Adds a new message to a ticket
	*
	* @param	int		- the ticket to add the message to
	* @param	array	- the complete data of the ticket
	* @return	bool	- true if the insert was completed, false otherwise
	* @access	public
	*/
	public static function add($ticket_id, $data) {
		$rules = array(
			'content'	=> 'required',
			'user_id'	=> 'required',
			'ticket_id'	=> 'required'
		);

		// make sure the ticket id is in the data array, for convenience
		if (!isset($data['ticket_id'])) {
			$data['ticket_id'] = $ticket_id;	
		}

		$validation = Validator::make($data, $rules);

		if ($validation->fails()) {
			return 'validation_failed';
		}

		$insert = array(
			'ticket_id' 	=> $data['ticket_id'],
			'user_id'		=> $data['user_id'],
			'content'		=> $data['content'],
			'created_at'	=> DB::raw('NOW()'),
			'updated_at'	=> DB::raw('NOW()')
		);

		return DB::table('messages')->insert($insert);
	}
}