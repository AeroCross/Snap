<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class File extends EXT_Controller {

	/**
	* The class constructor.
	*
	* @access	public
	*/
	public function __construct() {
		parent::__construct();
		$this->view		= FALSE;
		$this->layout	= FALSE;
	}

	/**
	* Do nothing if the controller's accessed directly.
	*
	* @access	public
	*/
	public function index() {
		redirect('dashboard');
	}

	/**
	* Downloads a file.
	*
	* @param	string	- source of the file (ticket, personal, user, etc.)
	* @param	int		- id of the source
	* @param	int		- user id
	* @param	string	- the filename
	*/
	public function get($type, $id, $user, $filename) {
		$filename	= urldecode($filename);
		$file		= FCPATH . 'files/' . $type . '/' . $id . '/'. $user . '/' . $filename;

		// @TODO: better feedback
		if (!file_exists($file)) {
			die();
		}

		// get mime-type for headers
		$handler	= finfo_open(FILEINFO_MIME_TYPE);
		$mime		= finfo_file($handler, $file);
		finfo_close($handler);

		// set headers and download
		header('Content-disposition: attachment; filename=' . $filename);
		header('Content-type: ' . $mime);
		readfile($file);
	}
}

/* End of file file.php */
/* Location: ./application/controllers/file.php */