<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Pagination configuration file
*
* Handles default options for pagination (used by the Pagination Class)
*
*/

// get the global object
$app =& get_instance();

// markup
$config['full_tag_open']	= '<div class="pagination"><ul>';
$config['full_tag_close']	= '</ul></div>';

// first link
$config['first_link']		= '&laquo;';
$config['first_tag_open']	= '<li>';
$config['first_tag_close']	= '</li>';

// last link
$config['last_link']		= '&raquo;';
$config['last_tag_open']	= '<li>';
$config['last_tag_close']	= '</li>';

// next link
$config['next_link']		= 'Siguiente →';
$config['next_tag_open']	= '<li>';
$config['next_tag_close']	= '</li>';

// previous link
$config['prev_link']		= '← Anterior';
$config['prev_tag_open']	= '<li>';
$config['prev_tag_close']	= '</li>';

// current link
$config['cur_tag_open']		= '<li class="active"><a href="#">';
$config['cur_tag_close']	= '</a></li>';

// number link
$config['num_tag_open']		= '<li>';
$config['num_tag_close']	= '</li>';

// other options
$config['use_page_numbers']	= true;
$config['per_page']			= $app->saav_setting->getSetting('per_page');