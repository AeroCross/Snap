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
		$file	= path('base') . 'files/tickets/' . $ticket . '/' . $user . '/' . $name;

		if (file_exists($file)) {
			return Response::download($file, Str::slug($name));
		}
	}
}