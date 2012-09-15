<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* File class.
*
* Handles incoming and outgoing files.
*
* @package		SAAV
* @subpackage	Libraries
* @author		Mario Cuba <mario@mariocuba.net>
*/
class File {

	/**
	* The class constructor.
	*
	* @access	public
	*/
	public function __construct() {
		$this->app =& get_instance();
	}

	/**
	* Wrapper for the proper file upload method.
	*
	* @param	string	- the destination of the file (by class)
	* @param	int		- the id of the source
	* @param	array	- the FILE array content
	* @return	array	- the data and errors array
	* @access	public
	*/
	public function upload($destination, $id, $file) {
		if ($destination === 'ticket') {
			return $this->_isTicket($id, $file);
		}
	}

	/**
	* Uploads a file for a ticket.
	*
	* @param	int		- the id of the source
	* @param	array	- the FILE array content
	* @return	array	- the data and errors array
	* @access	public
	*/
	public function _isTicket($id, $file) {
		$this->app->load->library('upload');
		$config = array(
			'upload_path'	=> './files/tickets/' . $id . '/' . $this->app->session->userdata('id') . '/',
			'allowed_types'	=> 'bmp|gif|jpg|png|psd|doc|docx|txt|zip|tar.gz|tar|tar.bz|rar|ppt|pptx|xls|xlsx|csv|ai',
			'file_name'		=> strtolower($file['name'])
		);

		$dir = FCPATH . substr($config['upload_path'], 1);

		if (!file_exists($dir)) {
			mkdir($dir, 0777, TRUE);
		}

		$this->app->upload->initialize($config);
		$this->app->upload->do_upload('file');

		return array(
			'data'		=> $this->app->upload->data(),
			'errors'	=> $this->app->upload->display_errors('<li>', '</li>')
		);
	}
}

/* End of file file.php */
/* Location: ./application/libraries/file.php */