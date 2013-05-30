<?php

/**
* Handles files download
*
* @package		SAAV
* @subpackage	Controllers
* @author		Mario Cuba <mario@mariocuba.net>
*/
class File_Controller extends Base_Controller {
	
	public $restful	= true;

	/**
	* Downloads a file
	*
	* @param	string	- safe-encoded base64 string
	* @return	Response
	* @access	public 
	*/
	public function get_download($data) {
		$data	= explode('/', Helper::decode_safe_base64($data), 3);
		$ticket = $data[0];
		$user	= $data[1];
		$name	= $data[2];
		$ext	= File::extension($name);
		$file	= path('base') . 'files/tickets/' . $ticket . '/' . $user . '/' . $name;

		$headers = array(
			'Content-Type'			=> 'application/octet-stream',
			'Content-Disposition'	=> 'attachment; filename=' . $name,
			'Content-Length'		=> filesize($file),
			'Pragma'				=> 'no-cache',
		);

		if (file_exists($file)) {
			return Response::make(readfile($file), 200, $headers);

		// @TODO: better error handling yo
		} else {
			return Response::make('File not found', 404);
		}

	}
}