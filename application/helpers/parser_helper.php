<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function status($status) {
	switch ($status) {
		case 'open': 
			$status		= 'Abierto';
			$highlight	= 'success';
		break;

		case 'closed':
			$status		= 'Cerrado';
			$highlight	= 'error';
		break;
	}

	return '<span class="highlight-' . $highlight . '">' . $status . '</span>';
}

/* End of file parser_helper.php */
/* Location: ./application/helpers/parser_helper.php */