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

		// allowed file types
		$this->allowed = array(
			// images
			'bmp',
			'gif',
			'jpg',
			'jpeg',
			'png',
			// adobe
			'psd', 
			'ai',
			'swf',
			'fla',
			// office documents
			'doc', 
			'docx', 
			'ppt', 
			'pptx', 
			'xls', 
			'xlsx', 
			// text files
			'txt', 
			'csv', 
			// compressed files
			'zip', 
			'tar.gz', 
			'tar', 
			'tar.bz', 
			'rar'
		);
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
		$this->app->load->library('upload');

		if ($destination === 'ticket') {
			return $this->_ticket($id, $file);
		}

		if ($destination === 'avatar') {
			return $this->_avatar($id, $file);	
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
	public function _ticket($id, $file) {

		// get file extension to check if permitted
		$ext = substr($this->app->upload->get_extension($file['name']), 1);

		// not allowed, notify
		if (!in_array($ext, $this->allowed)) {
			return array(
				'status'	=> 'ext_not_allowed',
				'message'	=> 'El tipo de archivo <strong>.' . $ext . '</strong> no está permitido guardarlo en el sistema.',
				'type'		=> 'warning'
			);
		}

		// file size exceeded
		if ($file['size'] === 0 AND $file['error'] === 1) {
			return array(
				'status'	=> 'max_filesize_exceeded',
				'message'	=> 'El archivo excede el límite de transferencia. El tamaño máximo es de <strong>' . ini_get('upload_max_filesize') . 'B</strong>.',
				'type'		=> 'warning'
			);
		}

		// configure
		$config = array(
			'upload_path'	=> APPPATH . 'uploads/tickets/' . $id . '/' . $this->app->session->userdata('id') . '/',
			'allowed_types'	=> implode('|', $this->allowed),
			'remove_spaces'	=> FALSE
		);

		if (!file_exists($config['upload_path'])) {
			mkdir($dir, 0777, TRUE);
		}

		// make sure there's an .htaccess file in the root of the tickets folder
		$htaccess = APPPATH . 'uploads/tickets/.htaccess';

		if (!file_exists($htaccess)) {
			$handler = fopen($htaccess, 'w+b');
			fwrite($handler, 'Deny from All');
			fclose($handler);
		}

		$this->app->upload->initialize($config);
		$this->app->upload->do_upload('file');

		// all good
		return array(
			'data'		=> $this->app->upload->data(),
		);
	}

	/**
	* Uploads an user profile picture.
	*
	* @param	int		- the user id
	* @param	array	- the file array
	* @return	array	- the notification
	*/
	private function _avatar($id, $file) {

		// get file extension to check if permitted
		$ext = substr($this->app->upload->get_extension($file['name']), 1);

		// allowed file types
		$allowed = array('jpg', 'jpeg', 'png');

		// no file uploaded
		if ($file['error'] === 4) {
			return array(
				'status'	=> 'no_file',
				'message'	=> 'No se ha seleccionado ningún archivo',
				'type'		=> 'warning'
			);
		}

		// not allowed, notify
		if (!in_array($ext, $allowed)) {
			return array(
				'status'	=> 'ext_not_allowed',
				'message'	=> 'El tipo de archivo <strong>.' . $ext . '</strong> no está permitido',
				'type'		=> 'warning'
			);
		}

		// file size exceeded
		if ($file['size'] === 0 AND $file['error'] === 1) {
			return array(
				'status'	=> 'max_filesize_exceeded',
				'message'	=> 'El archivo excede el límite de <strong>1MB</strong>',
				'type'		=> 'warning'
			);
		}

		// if file > 1MB, not permitted
		if ($file['size'] > 1048576) {
			return array(
				'status'	=> 'max_filesize_exceeded',
				'message'	=> 'El archivo excede el límite de <strong>1MB</strong>',
				'type'		=> 'warning'
			);
		}

		// check if the image is squared
		$size = getimagesize($file['tmp_name']);

		if ($size[0] != $size[1]) {
			return array(
				'status'	=> 'not_square',
				'message'	=> 'La imagen no es cuadrada',
				'type'		=> 'warning'
			);
		}

		// configure
		$config = array(
			'upload_path'	=> APPPATH . 'uploads/avatars/' . $id . '/',
			'allowed_types'	=> implode('|', $allowed),
			'remove_spaces'	=> false,
			'overwrite'		=> true,
			'file_name'		=> md5($id) . '.jpg',
		);

		if (!file_exists($config['upload_path'])) {
			mkdir($config['upload_path'], 0777, TRUE);
		}

		$this->app->upload->initialize($config);
		$this->app->upload->do_upload('file');

		// all good
		return array(
			'data'		=> $this->app->upload->data(),
		);
	}

	/**
	* Checks if a file was sent and if exceedes the post_max_size directive.
	*
	* @return	bool	- true if theere was a sent file exceeding the limit, false otherwise
	* @access	public
	*/
	public function excess() {
		// there was something sent, check if post size was exceeded
		if (isset($_SERVER['CONTENT_LENGTH'])) {
			if ((int) $_SERVER['CONTENT_LENGTH'] > ini_get('post_max_size')) {
				return true;
			}
		}
		return false;
	}
}

/* End of file file.php */
/* Location: ./application/libraries/file.php */