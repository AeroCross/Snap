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
		// create a notification if there's any
		Notification::create($this->notification(Session::get('notification')));

		// display the form
		return View::make('ticket/add');
	}

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
			return Redirect::to('ticket/add')->with('notification', 'required');
		}
	}

	/**
	* Define all possible notifications for this controller
	*
	* @param	string	- the notification to show
	* @return	array	- the notification and type
	* @access	private
	*/
	private function notification($type) {
		switch ($type) {
			case 'required':
				return array(
					'message'	=> 'Todos los campos son requeridos',
					'type'		=> 'warning'
				);
			break;
		}
	}

}