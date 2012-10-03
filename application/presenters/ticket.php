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
	public function files($ticket_id) {
		$path = APPPATH . 'uploads/tickets/' . $ticket_id . '/';

		// no uploads by the user, dismiss
		if (!file_exists($path)) {
			return NULL;
		}

		$folders	= scandir($path);
		
		// the only way this folder has 2 or less is that's empty
		if (count($folders) <= 2) {
			return NULL;
		}

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

		// still no results
		if (empty($results)) {
			return NULL;
		}

		$this->app->load->library('table');
		
		$config = array('table_open'	=> '<table class="table table-striped table-bordered table-hover sortable">');
		$this->app->table->set_template($config);
		unset($config);

		$this->app->table->set_heading('Archivo', 'Tipo', 'Enviado por', 'Tamaño', 'Última Modificación');

		foreach($results as $result) {
			$fullpath	= $path . $result;

			// since we don't want more subdirectories, omit all remaining folders
			if (is_dir($fullpath)) {
				continue;
			}

			$stat		= stat($fullpath);
			$result		= explode('/', $result);
			$user		= $this->app->saav_user->data('id, firstname, lastname, email')->id($result[0])->get();
			$file		= $result[1];
			$ext		= explode('.', $file);
			
			if 	(count($ext) !== 1) {
				$ext = end($ext);
			} else {
				$ext = '';
			}

			$this->app->table->add_row(
				anchor('file/get/tickets/' . $ticket_id . '/' . $result[0] . '/' . $stat['ino'], img($this->app->resource->img(extension($ext))), array('class' => 'file-extension')) . ' ' . anchor('file/get/tickets/' . $ticket_id . '/' . $result[0] . '/' . $stat['ino'], $file),
				extension_name($ext),
				($this->app->saav_user->permission('support')) ? safe_mailto($user->email, $user->firstname . ' ' . $user->lastname) : $user->firstname . ' ' . $user->lastname,
				number_format((int) $stat['size'] / 1024  / 1024, 2) . ' MB',
				date('Y-m-d H:i:s', $stat['mtime'])
			);
		}

		return $this->app->table->generate();
	}
}

/* End of file ticket.php */
/* Location: ./application/presenters/ticket.php */