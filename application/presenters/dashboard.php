<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Dashboard presenter.
*
* Shows various dashboard widgets.
*
* @package		SAV
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
	}

	/**
	* Displays the latest tickets for a user.
	*
	* @return string	- the table with the tickets or a feedback message
	*/
	public function latestTickets() {
		// load the neccesary models
		$this->app->load->model('sav_ticket');
		$this->app->load->model('sav_department');

		// fetch necessary information
		$id			= $this->app->session->userdata('id');
		$tickets	= $this->app->sav_ticket->getLatestTickets(5, $id);

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
				$this->app->sav_department->getDepartment($ticket->department)->name,
				$ticket->status
			);
		}

		$table = $this->app->table->generate();

		if (!empty($table)) {
			return $table;
		} else {
			return '<p>No tiene consultas recientes &mdash; ' . anchor('tickets/add', 'Cree una nueva consulta') . '.</p>';
		}
	}
}

/* End of file dashboard.php */
/* Location: ./application/presenters/dashboard.php */