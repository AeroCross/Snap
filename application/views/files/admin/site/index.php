<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	/**
	* Since the admin controller is not quite a controller, but a module in 
	* HMVC (thus making it a folder), Codeigniter wrongly assumes
	* that there's a view in here, and the admin is actually a controller.
	*
	* The workaround for this is to add controller logic in here and let
	* another controller handle the job.
	*
	* Currently, you shouldn't be able to access the admin "controller" directly
	* or, if you do, redirect to either the dashboard (i.e not implemented) or just
	* the only available admin controller — the tickets view.
	*
	* @TODO: Find a better workaround.
	*/

	redirect('dashboard'); 

?>