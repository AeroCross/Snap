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

	public function get_download($data) {
		$data	= explode('/', base64_decode($data), 3);
		$ticket = $data[0];
		$user	= $data[1];
		$name	= $data[2];
		$ext	= File::extension($name);
		$file	= path('base') . 'files/tickets/' . $ticket . '/' . $user . '/' . $name;

		// filename cannot have %
		$name	= preg_replace('/\%/', '', $name);
		
		if (file_exists($file)) {
			return Response::download($file, $name);
		}
	}
}