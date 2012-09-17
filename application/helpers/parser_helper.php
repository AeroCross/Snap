<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Returns the correct colored status of a ticket.
*
* @param	string	- the status (as a database value)
* @return	string	- the formatted html string
*/
function status($status) {
	switch ($status) {
		case 'open': 
			$status		= 'Abierta';
			$highlight	= 'warning';
		break;

		case 'closed':
			$status		= 'Cerrada';
			$highlight	= 'success';
		break;
	}

	return '<span class="highlight-' . $highlight . '">' . $status . '</span>';
}

/* End of file parser_helper.php */
/* Location: ./application/helpers/parser_helper.php */