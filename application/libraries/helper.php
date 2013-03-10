<?php

/**
* Various helper methods
*
* @package		SAAV
* @subpackage	Libraries
* @author		Mario Cuba <mario@mariocuba.net>
*/
class Helper {

	/**
	* Parses the value of a ticket status
	*
	* @param	string	- the ticket status
	* @return	string	- an icon referencing the status
	* @access	public
	*/
    public static function status($status) {
        switch ($status) {
        	case 'closed':	$status = 'ok-sign text-success'; break;
        	case 'open':	$status = 'exclamation-sign text-error'; break;
        	default:		$status	= 'question-sign text-info'; break;
        }

        return '<i class="icon-' . $status . '"></i> ';
    }

    /**
    * Creates the markup for an icon
    *
    * @param	string	- the name of the icon
    * @return	string	- the markup of the icon
    * @access	public
    */
    public static function icon($icon) {
    	return '<i class="icon-' . $icon . '"></i>';
    }
}