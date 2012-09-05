<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Tickets controller.
*
* Handles the CRUD of the Tickets.
*
* @package		SAAV
* @subpackage	Controllers
* @author		Mario Cuba <mario@mariocuba.net>
*/
class Tickets extends EXT_Controller {
	
	/**
	* The class constructor.
	*
	* @access	public
	*/
	public function __construct() {
		parent::__construct();

		// set the title
		$this->data->title = 'Consultas';
		
		// load resources
		$this->load->presenter('notification');
		$this->load->presenter('form');
		$this->load->model('saav_ticket');

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
 	* Shows all tickets from a user.
 	*
 	* @access	public
 	*/
	public function all() {
		// fetch all the tickets from this user
		$tickets = $this->saav_ticket->data()->reported_by($this->session->userdata('id'))->by('date_created', 'desc')->getAll();

		if (count($tickets) !== 0) {
			// load the neccessary code
			$this->load->model('saav_department');
			$this->load->helper('parser');

			// format the table
			$this->load->library('table');
			$this->table->set_heading('Consulta', 'Asunto', 'Departamento', 'Creada', 'Modificada', 'Estatus', 'Tiempo estimado');

			foreach($tickets as $ticket) {
				$this->table->add_row(
					anchor('tickets/view/' . $ticket->id, $ticket->id),
					$ticket->subject,
					$this->saav_department->getDepartment($ticket->department)->name,
					$ticket->date_created,
					$ticket->date_modified,
					status($ticket->status),
					$ticket->eta
				);
			}

			$this->data->tickets = $this->table->generate();

		// no tickets
		} else {
			$this->data->tickets = '<p>No tiene consultas &mdash; ' . anchor('tickets/add', 'Cree una nueva consulta') . '.';
		}
	}

	/**
 	* Viws details of a ticket.
 	*
 	* @access	public
 	*/
	public function view($ticket) {
		// first, check if the ticket belongs to the user
		$this->data->ticket		= new StdClass;
		$this->data->ticket		= $this->saav_ticket->getTicket($ticket);

		// only admins, support cann see this ticket
		if (!$this->saav_user->permission('support')) {
			// check if the ticket is of the reporter
			if ($this->data->ticket->reported_by != $this->session->userdata('id')) {
				redirect('dashboard');
			}
			redirect('dashboard');
		}

		// if a message was sent, process it
		if (!empty($this->post)) {
			$this->presenter->notification->create($this->_addMessage());
		}

		$this->load->helper('parser');
		$this->load->model('saav_user');
		$this->load->model('saav_message');
		$this->load->model('saav_department');

		$this->data->messages	= new StdClass;
		$this->data->reporter	= new StdClass;



		$this->data->reporter	= $this->saav_user->data('firstname, lastname, email, username')->id($this->data->ticket->reported_by)->get();
		$this->data->messages	= $this->saav_message->getMessages($ticket);
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
		
		$this->load->model('saav_ticket');

		// add the new ticket and return the id
		$id = $this->saav_ticket->addTicket($data);

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
		// check if the data is complete
		$this->load->library('form_validation');
		$this->form_validation->set_rules('ticket_id', 'ID de Consulta', 'required');
		$this->form_validation->set_rules('content', 'Mensaje', 'required');

		// message is required
		if (!$this->form_validation->run()) {
			return array(
				'status'	=> 'required',
				'message'	=> 'Necesita ingresar un mensaje para actualizar su consulta.',
				'type'		=> 'warning',
			);
		}

		// load the message model to process data
		$this->load->model('saav_message');

		// prepare
		$ticket_id 	= $this->input->post('ticket_id');
		$content	= $this->input->post('content');
		$status		= $this->input->post('status');

		// check for correct status
		if (empty($status)) {
			$status = 'open';
		}

		// notify the department when the ticket is updated
		if ($this->saav_message->addMessage($ticket_id, $content, $status)) {
			// get the ticket data
			$ticket = $this->saav_ticket->getTicket($ticket_id);

			// check who shall receive the emails
			$this->load->model('saav_setting');
			$this->load->model('saav_department');
			$members = $this->saav_department->getDepartmentMembers($ticket->department);

			foreach($members as $member) {
				$bcc[] = $member->email;
			}
			
			// load the email library
			$this->load->library('email');
			$this->init->email();

			$smtp_user = $this->saav_setting->getSetting('smtp_user');
			$this->email->to($smtp_user);
			$this->email->from($smtp_user);
			$this->email->bcc($bcc);
			$this->email->subject('Ticket #' . $ticket_id . ': Actualización');
			$this->email->message(nl2br($content));

			// if message was sent, notify
			// @TODO: how can we know if the email was or wasn't sent?
			@$this->email->send();

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

/* End of file tickets.php */
/* Location: ./application/controllers/tickets.php */