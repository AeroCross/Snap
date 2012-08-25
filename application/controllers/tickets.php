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
		$this->load->helper('parser');
		$this->load->model('sav_user');
		$this->load->model('sav_message');

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
 	* @access	public
 	*/
	public function _process() {

		$data = array(
			'department'	=> $this->input->post('department'),
			'subject'		=> $this->input->post('subject'),
			'content'		=> $this->input->post('content'),
		);
		
		$this->load->model('sav_ticket');
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
}

/* End of file controller.php */
/* Location: ./application/controllers/controller.php */