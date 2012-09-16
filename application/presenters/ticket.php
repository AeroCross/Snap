<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class TicketPresenter {
	// prevent overloading
	private $app;

	/**
	* The class contructor.
	*
	* @access	public
	*/
	public function __construct() {
		$this->app =& get_instance();
	}

	/**
	* Shows the person assigned to a ticket.
	*
	* @param	int		- the id of the ticket
	* @return	string	- the name or link of the assigned person
	* @access	public
	*/
	public function showAssignedTo($ticket_id) {
		// load necessary code
		$this->app->load->model('saav_user');
		$this->app->load->model('saav_ticket');

		$assigned	= $this->app->saav_ticket->getTicket($ticket_id)->assigned_to;

		// if there's noone assigned, return nothing
		if (empty($assigned)) {
			return NULL;
		}

		$user = $this->app->saav_user->data('firstname, lastname, email')->id($assigned)->get();
		$data = $user->firstname . ' ' . $user->lastname;

		if ($this->app->saav_user->permission('support')) {
			$data = safe_mailto($user->email, $data);
		}

		return $data;
	}

	/**
	* Shows the files uploaded to a ticket.
	*
	* @param	int		- the id of the ticket
	* @return	string	- the table with all the files
	* @access	public
	*/
	public function showFiles($ticket_id) {
		$path = FCPATH . 'files/tickets/' . $ticket_id . '/';

		// no uploads by the user, dismiss
		if (!file_exists($path)) {
			return NULL;
		}

		$folders	= scandir($path);
		
		// get all the files
		foreach($folders as $folder) {
			if ($folder === '.' OR $folder === '..') {
				continue;
			}

			if (!is_dir($path . $folder)) {
				continue;
			}

			$files = scandir($path . $folder);

			foreach($files as $file) {
				if ($file === '.' OR $file === '..') {
					continue;
				} else {
					$results[] = $folder . '/' . $file;
				}
			}
		}

		$this->app->load->library('table');
		$this->app->table->set_heading('Archivo', 'Extensión', 'Enviado por', 'Tamaño', 'Última Modificación');

		foreach($results as $result) {
			$fullpath	= $path . $result;
			$stat		= stat($fullpath);
			$result		= explode('/', $result);
			$user		= $this->app->saav_user->data('id, firstname, lastname, email')->id($result[0])->get();
			$file		= $result[1];
			$ext		= array();
			$search		= preg_match('/\.[^.]+$/', $file, $ext);
			$ext		= $ext[0];
			
			$this->app->table->add_row(
				img($this->app->resource->img(extension($ext, 32)), FALSE, array('class' => 'file-extension')) . ' ' . anchor('file/get/ticket/' . $ticket_id . '/' . $result[0] . '/' . $file, $file),
				substr($ext, 1),
				safe_mailto($user->email, $user->firstname . ' ' . $user->lastname),
				number_format((int) $stat['size'] / 1024  / 1024, 2) . ' MB',
				date('Y-m-d H:i:s', $stat['mtime'])
			);
		}

		return $this->app->table->generate();
	}
}

/* End of file ticket.php */
/* Location: ./application/presenters/ticket.php */