<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Tickets controller.
*
* Handles the CRUD of the Tickets.
*
* @package		SAV
* @subpackage	Controllers
* @author		Mario Cuba <mario@mariocuba.net>
*/
class Tickets extends SAV_Controller {
	
	/**
	* The class constructor.
	*
	* @access	public
	*/
	public function __construct() {
		parent::__construct();

		// load resources
		$this->load->presenter('notification');
		$this->load->model('sav_ticket');

		// store the post array
		$this->post = $this->input->post();
	}

	public function index() {
		$this->add();
	}
	
 	/**
 	* Displays the add ticket form.
 	*
 	* @access	public
 	*/
	public function add() {
		// if a ticket was tried to be registered
		if ($this->input->post() != FALSE) {
			$this->presenter->notification->create($this->_process());
		}

		$this->load->presenter('form');
		$this->view = 'files/tickets/add';
	}

	/**
 	* Viws details of a ticket.
 	*
 	* @access	public
 	*/
	public function view($ticket) {
		// if a message was sent, process it
		if (!empty($this->post)) {
			$this->presenter->notification->create($this->_addMessage());
		}

		$this->load->helper('parser');
		$this->load->model('sav_user');
		$this->load->model('sav_message');
		$this->load->model('sav_department');

		$this->data->messages	= new StdClass;
		$this->data->reporter	= new StdClass;
		$this->data->ticket		= new StdClass;

		$this->data->ticket		= $this->sav_ticket->getTicket($ticket);
		$this->data->reporter	= $this->sav_user->data('firstname, lastname, email, username')->id($this->data->ticket->reported_by)->get();
		$this->data->messages	= $this->sav_message->getMessages($ticket);
	}

 	/**
 	* Displays a feedback message post-ticket.
 	*
 	* @access	public
 	*/
	public function success() {
		// check the flashdata
		$id = $this->session->flashdata('ticket');

		// proceed with feedback
		if (!empty($id)) {
			$this->data->ticket = $this->session->flashdata('ticket');
		} else {
			redirect('tickets/add');
		}
	}

	/**
 	* Processes a new ticket.
 	*
 	* @access	private
 	*/
	private function _process() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('department', 'Departamento', 'required');
		$this->form_validation->set_rules('subject', 'Asunto', 'required');
		$this->form_validation->set_rules('content', 'Contenido', 'required');

		// all fields are required
		if (!$this->form_validation->run()) {
			return array(
				'status'	=> 'required',
				'message'	=> 'Todos los campos son requeridos.',
				'type'		=> 'warning'
			);
		}

		// fetch the data
		$data = array(
			'department'	=> $this->input->post('department'),
			'subject'		=> $this->input->post('subject'),
			'content'		=> $this->input->post('content'),
		);
		
		$this->load->model('sav_ticket');

		// add the new ticket and return the id
		$id = $this->sav_ticket->addTicket($data);

		if (!empty($id)) {
			$this->session->set_flashdata('ticket', $id);
			redirect('tickets/success');

		// for some reason, we couldn''t insert the data
		} else {
			return array(
				'status'	=> 'failed',
				'message'	=> 'Error al intentar ingresar la consulta.',
				'type'		=> 'error'
			);
		}
	}

	/**
 	* Updates a ticket.
 	*
 	* @access	private
 	*/
	private function _addMessage() {
		// load the message model to process data
		$this->load->model('sav_message');

		// prepare
		$ticket_id 	= $this->input->post('ticket_id');
		$content	= $this->input->post('content');
		$status		= $this->input->post('status');

		// check for correct status
		if (empty($status)) {
			$status = 'open';
		}

		// notify the department when the ticket is updated
		if ($this->sav_message->addMessage($ticket_id, $content, $status)) {
			// get the ticket data
			$ticket = $this->sav_ticket->getTicket($ticket_id);

			// check who shall receive the emails
			$this->load->model('sav_setting');
			$this->load->model('sav_department');
			$members = $this->sav_department->getDepartmentMembers($ticket->department);

			foreach($members as $member) {
				$bcc[] = $member->email;
			}
			
			// load the email library
			$this->load->library('email');
			$this->init->email();

			$smtp_user = $this->sav_setting->getSetting('smtp_user');
			$this->email->to($smtp_user);
			$this->email->from($smtp_user);
			$this->email->bcc($bcc);
			$this->email->subject('Ticket #' . $ticket_id . ': Actualización');
			$this->email->message(nl2br($content));

			// if message was sent, notify
			$this->email->send();

			return array(
				'status'	=> 'sent',
				'message'	=> 'Su consulta ha sido actualizada y el departamento ha sido notificado.',
				'type'		=> 'success'
			);

		// error happened - couldn't insert the message
		} else {
			return array(
				'status'	=> 'not_inserted',
				'message'	=> 'Error al enviar su mensaje. Contacte a soporte técnico e intente más tarde.',
				'type'		=> 'error'
			);
		}
	}
}

/* End of file controller.php */
/* Location: ./application/controllers/controller.php */