<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Handles the administrative part of tickets.
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
		$this->data->title = 'Administración » Tickets';

		// load the ticket model
		$this->load->model('saav_ticket');
		$this->load->model('saav_user');

		// check if the user's an admin
		if (!$this->saav_user->permission('support')) {
			redirect('dashboard');
		}
	}

	/**
	* Redirects to the all() method.
	*
	* @access	public
	*/
	public function index() {
		// set the correct view
		$this->view = 'files/admin/tickets/all';

		 // redirect flow
		$this->all();
	}

	/**
	* Displays the ticket selection system.
	*
	* @access	public
	*/
	public function all() {
		$this->load->presenter('form');
		$this->load->library('table');
		$this->table->set_heading('Consulta', 'Asunto', 'Departamento', 'Creada', 'Modificada', 'Estatus');
		
		// load the necessary code
		$this->load->model('saav_department');
		$this->load->helper('parser');

		// try to search
		$search	= $this->input->post('search');
		$value	= $this->input->post('value');

		if (!empty($search) AND !empty($value)) {
			$tickets	= $this->saav_ticket->data()->$search($value)->by('date_created', 'desc')->getAll();

		// fetch table data normally
		} else {
			$tickets = $this->saav_ticket->data()->by('date_created', 'desc')->getAll();
		}

		// tickets found - generate table
		if (count($tickets) > 0) {
			foreach($tickets as $ticket) {
				$this->table->add_row(
					anchor('tickets/view/' . $ticket->id, $ticket->id),
					$ticket->subject,
					$this->saav_department->getDepartment($ticket->department)->name,
					$ticket->date_created,
					$ticket->date_modified,
					status($ticket->status)
				);
			}

			$this->data->tickets = $this->table->generate();

		// no tickets found — feedback
		} else {
			$this->data->tickets = 'No existen consultas en el sistema.';
		}
	}
}

/* End of file tickets.php */
/* Location: ./application/controllers/admin/tickets.php */