<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
/**
* Calculates limit and offset for pagination.
*
* @param	int		- the uri segment of the page
* @return	object	- the limit and the offset
*/
function calculateOffset($uri_segment) {
	// get the global object
	$app =& get_instance();

	$pagination			= new StdClass;
	$pagination->limit	= $app->saav_setting->getSetting('per_page');
	$value				= $app->uri->segment($uri_segment);

	if (empty($value)) {
		$uri = 1;
	} else {
		$uri = 	(int) $app->uri->segment($uri_segment);
	}

	$pagination->offset	= ($uri * $pagination->limit) - $pagination->limit;

	return $pagination;
}
	
/* End of file pagination_helper.php */
/* Location: ./application/helpers/pagination_helper.php */