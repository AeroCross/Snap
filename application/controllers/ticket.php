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
			$input['assigned_to'] = Input::get('assign');
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

		// validation passed, prepare data to be added to database
		$ticket = array(
			'subject'		=> $input['subject'],
			'content'		=> $input['content'],
			'department'	=> $input['department'],
			'reported_by'	=> Session::get('id'),
		);

		if (isset($input['assigned_to'])) {
			$ticket['assigned_to']	= $input['assigned_to'];
		}

		// notify only the assigned person or the whole department
		if (isset($input['assigned_to'])) {
			$members	= User::where_id($input['assigned_to'])->get(array('firstname', 'lastname', 'email'));
		} else {
			$members	= Department::find($input['department'])->user()->where_deleted('0')->get('firstname', 'lastname', 'email');
		}
		
		// get the email addresses of people being notified
		foreach ($members as $member) {
			$bcc[$member->email] = $member->firstname . ' ' . $member->lastname;
		}

		// save it to the database
		$ticket		= Ticket::insert_get_id($ticket);
		$reporter	= User::find(Session::get('id'));

		// create an email for the assigned person
		if (isset($input['assigned_to'])) {
			$subject	= 'Asignación de Consulta #' . $ticket . ': ' . $input['subject'];
			$body		= View::make('messages.ticket.assigned')->with('input', $input)->with('reporter', $reporter)->with('ticket', $ticket);

		// or for the whole department
		} else {
			$subject	= 'Consulta #' . $ticket . ': ' . $input['subject'];
			$body		= View::make('messages.ticket.created')->with('input', $input)->with('reporter', $reporter)->with('ticket', $ticket);
		}

		// send the mail
		$mailer		= IoC::resolve('mailer');
		$message	= Swift_Message::newInstance($subject)
		->setFrom(array('soporte@ingenium-dv.com' => 'Soporte'))	// @TODO: take from settings
		->setBcc($bcc)
		->setBody($body, 'text/html')
		->addPart($input['content'], 'text/plain');

		// send the email
		$sent = $mailer->send($message);

		// all good
		return View::make('ticket.success')->with('ticket', $ticket);
	}

}