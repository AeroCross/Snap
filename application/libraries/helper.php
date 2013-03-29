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
    * Creates the markup for an icon
    *
    * @param	string	- the name of the icon
    * @return	string	- the markup of the icon
    * @access	public
    */
    public static function icon($icon) {
    	return '<i class="icon-' . $icon . '"></i>';
    }

    /**
    * Parses a ticket status
    *
    * @param    string  - the status
    * @return   string  - a formatted HTML string
    * @access   public
    */
    public static function status($status, $type = 'text') {
        switch ($type) {
            case 'text':
                switch($status) {
                    case 'open':    $status = 'Abierto'; $type = 'warning'; break;
                    case 'closed':  $status = 'Cerrado'; $type = 'success'; break;
                }

                return '<span class="highlight highlight-' . $type . '">' . $status . '</span>';
            break;
        }
    }
}