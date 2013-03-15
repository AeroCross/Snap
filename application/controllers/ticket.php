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

		// validation passed, add data to database
		$ticket = array(
			'subject'		=> $input['subject'],
			'content'		=> $input['content'],
			'department'	=> $input['department'],
			'reported_by'	=> Session::get('id'),
		);

		if (isset($input['assign'])) {
			$ticket['assigned_to']	= $input['assign'];
		}

		// notify the whole department
		$members	= Department::find($input['department'])->user()->where_deleted('0')->get('firstname', 'lastname', 'email');
		
		foreach ($members as $member) {
			$bcc[$member->email] = $member->firstname . ' ' . $member->lastname;
		}

		// save it to the database
		$ticket = Ticket::insert_get_id($ticket);

		// mail the department
		$mailer = IoC::resolve('mailer');

		// construct the message
		$message = Swift_Message::newInstance('Consulta #' . $ticket . ': ' . $input['subject'])
		->setFrom(array('soporte@ingenium-dv.com' => 'Soporte'))
		->setTo(array('soporte@ingenim-dv.com' => 'Soporte'))
		->setBcc($bcc)
		->setBody($input['content'], 'text/html')
		->addPart($input['content'], 'text/plain');

		// send the email
		$sent = $mailer->send($message);
	}
}