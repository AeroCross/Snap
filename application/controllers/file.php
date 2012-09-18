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
	* @param	string	- the file inode
	*/
	public function get($type, $id, $user, $inode) {

		// all parameters are required
		if (empty($type) OR empty($id) OR empty($user) OR empty($inode)) {
			redirect('dashboard');
		}

		// match inode
		$dir	= FCPATH . 'files/' . $type . '/' . $id . '/'. $user . '/';
		$files	= scandir($dir);

		foreach($files as $file) {
			$stat = stat($dir . $file);
			if ($inode == $stat['ino']) {
				$filename = $file;
			}
		}

		// @TODO: better feedback
		if (!isset($filename)) {
			die('Archivo no existente');
		}

		$file = FCPATH . 'files/' . $type . '/' . $id . '/'. $user . '/' . $filename;

		// @TODO: better feedback
		if (!file_exists($file)) {
			die('Archivo no encontrado o con caracteres no autorizados.');
		}

		// get mime-type for headers (if needed)
		$handler	= finfo_open(FILEINFO_MIME_TYPE);
		$mime		= finfo_file($handler, $file);
		finfo_close($handler);

		// set headers and download
		header('Content-disposition: attachment; filename=' . $filename);
		header("Content-Length: " . filesize($file));  
		header('Content-type: application/octet-stream');

		// make sure anything's outputted to the browser
		@ob_clean();
		@flush();

		// download
		readfile($file);
	}
}

/* End of file file.php */
/* Location: ./application/controllers/file.php */