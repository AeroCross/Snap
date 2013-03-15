<?php

/**
* Handles ticket CRUD and other methods.
*
* @package		SAAV
* @subpackage	Controllers
* @author		Mario Cuba <mario@mariocuba.net>
*/
class Ticket_Controller extends Base_Controller {

	public $restful = true;

	/**
	* Shows the add ticket form
	*
	* @access	public
	*/
	public function get_add() {
		// display the form
		return View::make('ticket/add');
	}

	/**
	* Adds a new ticket
	*
	* @access	public
	*/
	public function post_add() {
		$input	= array(
			'department'	=> Input::get('department'),
			'subject'		=> Input::get('subject'),
			'content'		=> Input::get('content')
		); 

		// only support and admins can set an assigned person
		if (Input::get('assign')) {
			$input['assign'] = Input::get('assign');
		}

		$rules = array(
			'department'	=> 'required',
			'subject'		=> 'required',
			'content'		=> 'required'
		);

		$validation = Validator::make($input, $rules);

		if ($validation->fails()) {
			return Redirect::to('ticket/add')->with('notification', 'form_required');
		}
	}
}