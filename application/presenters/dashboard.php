<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Dashboard presenter.
*
* Shows various dashboard widgets.
*
* @package		SAAV
* @subpackage	Presenters
* @author		Mario Cuba <mario@mariocuba.net>
*/
class DashboardPresenter {

	// prevent overloading
	private $app;

	/**
	* The class constructor.
	*
	* @access	public
	*/
	public function __construct() {
		$this->app =& get_instance();

		// load the neccesary code
		$this->app->load->model('saav_ticket');
		$this->app->load->model('saav_department');
		$this->app->load->helper('parser');
	}

	/**
	* Displays the latest tickets for a user.
	*
	* @return string	- the table with the tickets or a feedback message
	*/
	public function latestTickets() {
		// fetch necessary information
		$id			= $this->app->session->userdata('id');
		$tickets	= $this->app->saav_ticket->getLatestTickets(5, $id);

		if (count($tickets) !== 0) {
			// configure table generation
			$this->app->load->library('table');
			$this->app->table->set_heading(
				'Consulta',
				'Asunto',
				'Creada',
				'Departamento',
				'Estatus'
			);

			foreach ($tickets as $ticket) {
				$this->app->table->add_row(
					anchor('tickets/view/' . $ticket->id, $ticket->id),
					$ticket->subject,
					$ticket->date_created,
					$this->app->saav_department->getDepartment($ticket->department)->name,
					status($ticket->status)
				);
			}

			$table = $this->app->table->generate();

		// no tickets, return nothing
		} else {
			$table = NULL;
		}

		if (!empty($table)) {
			return $table;
		} else {
			return '<p>No tiene consultas recientes &mdash; ' . anchor('tickets/add', 'Cree una nueva consulta') . '.</p>';
		}
	}

	/**
	* Displays the latest tickets assigned to the current user.
	*
	* @return string	- the table with the tickets or a feedback message
	*/
	public function latestAssigned() {
		$id			= $this->app->session->userdata('id');
		$tickets	= $this->app->saav_ticket->data('*')->assigned_to($id)->by('date_created', 'desc')->limit(10)->getAll();

		if (count($tickets) !== 0) {
			$this->app->load->model('saav_company');
			$this->app->load->library('table');
			$this->app->table->set_heading(
				'Consulta',
				'Reportado por',
				'Compañía',
				'Asunto',
				'Departamento',
				'Creada',
				'Modificada',
				'Estatus'
			);

			foreach ($tickets as $ticket) {
				$reported = $this->app->saav_user->data('firstname, lastname, email')->id($ticket->reported_by)->get();
				$this->app->table->add_row(
					anchor('tickets/view/' . $ticket->id, $ticket->id),
					safe_mailto($reported->email, $reported->firstname . ' ' . $reported->lastname),
					$this->app->saav_company->findCompany($ticket->reported_by)->name,
					$ticket->subject,
					$this->app->saav_department->getDepartment($ticket->department)->name,
					$ticket->date_created,
					$ticket->date_modified,
					status($ticket->status)
				);
			}

			$table = $this->app->table->generate();
			
		// no tickets, return nothing
		} else {
			$table = NULL;
		}

		if (!empty($table)) {
			return $table;
		} else {
			return '<p>No tiene consultas asignadas.</p>';
		}
	}
}

/* End of file dashboard.php */
/* Location: ./application/presenters/dashboard.php */