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
                    case 'open':    $status = 'Abierta';    $type = 'warning';  break;
                    case 'closed':  $status = 'Cerrada';    $type = 'success';  break;
                    case 'hold':    $status = 'En espera';  $type = 'info';     break;
                }

                return '<span class="highlight highlight-' . $type . '">' . $status . '</span>';
            break;
        }
    }

    /**
    * Turns a unix timestamp into an SQL-standard date, time, or both
    *
    * @param    int     - unix time()
    * @param    string  - the time of string needed: 
    **/
    public static function sqltime($timestamp, $type = 'date') {
        switch ($type) {
            case 'date':    return date('Y-m-d', $timestamp);       break;
            case 'time':    return date('H:i:s', $timestamp);       break;
            default:        return date('Y-m-d H:i:s', $timestamp); break;
        }
    }
}