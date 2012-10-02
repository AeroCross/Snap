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
	public function all($page = 1) {
		// load required code
		$this->load->presenter('form');
		$this->load->library('table');
		$this->load->library('pagination');
		$this->load->helper('parser');
		$this->load->helper('pagination');
		$this->load->model('saav_company');
		$this->load->model('saav_department');

		// try to search
		$search	= $this->input->post('search');
		$value	= $this->input->post('value');
		
		// no post search, try session search
		if (empty($value) OR empty($search)) {
			$search	= $this->session->userdata('search');
			$value	= $this->session->userdata('value');
		}
		
		$clear = $this->input->post('clear');
		
		// empty search results, if set
		if (!empty($clear)) {
			$search	= NULL;
			$value	= NULL;
		}

		$config = array(
			'base_url'			=> base_url('admin/tickets/all'),
			'uri_segment'		=> 4,
		);

		// calculate offset
		$pagination = calculateOffset($config['uri_segment']);

		// if there's a post or session search, fetch results accordingly
		if (!empty($search) AND !empty($value)) {
			if ($search == 'company') {
				$config['total_rows']	= count($this->saav_ticket->getTicketsByCompany($value)->getAll());
				$tickets				= $this->saav_ticket->getTicketsByCompany($value)->limit($pagination->limit, $pagination->offset)->getAll();
			} else {
				$config['total_rows']	= count($this->saav_ticket->data('id')->$search($value)->getAll());
				$tickets				= $this->saav_ticket->data()->$search($value)->limit($pagination->limit, $pagination->offset)->by('date_created', 'desc')->getAll();
			}

		// fetch table data normally
		} else {
			$config['total_rows']	= count($this->saav_ticket->data('id')->getAll());
			$tickets				= $this->saav_ticket->data()->limit($pagination->limit, $pagination->offset)->by('date_created', 'desc')->getAll();
		}

		$this->pagination->initialize($config);

		// save search (if any)
		$this->session->set_userdata('search', $search);
		$this->session->set_userdata('value', $value);

		// tickets found - generate table
		if (count($tickets) > 0) {
			// configure table
			$this->table->set_heading('Consulta', 'Reportado por', 'Compañía', 'Asunto', 'Departamento', 'Creada', 'Modificada', 'Estatus');

			// eager load the reporters
			$reporters = array();
			foreach ($tickets as $key => $ticket) {
				if (!array_key_exists($ticket->reported_by, $reporters)) {
					$user = $this->saav_user->data('firstname, lastname, email')->id($ticket->reported_by)->get();
					$reporters[$ticket->reported_by]['name']	= $user->firstname . ' ' . $user->lastname;
					$reporters[$ticket->reported_by]['email']	= $user->email;
				}
			}

			foreach($tickets as $ticket) {
				$this->table->add_row(
					anchor('tickets/view/' . $ticket->id, $ticket->id),
					safe_mailto($reporters[$ticket->reported_by]['email'], $reporters[$ticket->reported_by]['name']),
					$this->saav_company->getCompany($ticket->reported_by)->name,
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