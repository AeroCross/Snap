<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Codeigniter Core Controller Extension
*
* Enables the auto-loading of views, layout loading, log timing 
* and other application-wide functionality.
*
* Original concept by Jamie Rumbelow <jamie@jamierumbelow.com>, found in 
* the "Codeigniter Handbook", Vol. 1. (@see http://http://codeigniterhandbook.com/)"
*
* NOTICE OF LICENSE
*
* Licensed under the Creative Commons Attribution 3.0 Unported License.
*
* This source file is subject to the Creative Commons Attribution 3.0 Unported License
* that is available through http://creativecommons.org/licenses/by/3.0/legalcode. It is
* released to the public domain via http://github.com/AeroCross/ci-core-extensions.
*
* You are free to share, modify, and profit from this source file as long as
* there is attribution to the author and this Notice of License is not removed.
*
* @package		Codeigniter
* @subpackage	Core Extensions
* @author		Mario Cuba <mario@mariocuba.net>
* @license		http://creativecommons.org/licenses/by/3.0
*/
class SAV_Controller extends CI_Controller {

	// the data to be passed around views and controllers
	public $data;
	public $view	= TRUE;
	public $layout	= TRUE;

	public function __construct() {
		parent::__construct();

		// required to suppress strict errors
		$this->data	= new StdClass;
		$this->load->presenter('notification');

		// check if there's a session in the login controller
		if ($this->uri->segment(1) === 'login') {

			$logout = $this->session->flashdata('logout');

			// session found - redirecting into the app
			if ($this->init->hasSession() AND empty($logout)) {
				redirect('dashboard');

			// no session found
			} else {
				$notification = serialize(array(
					'status'	=> 'not_logged_in',
					'message'	=> 'No ha iniciado sesión.',
					'type'		=> 'error'
				));

				$this->presenter->notification->create($notification);
			}

		// not the login, not logging out and not the site - check session
		} elseif (!$this->init->hasSession() AND $this->uri->segment(1) !== 'site' AND $this->uri->segment(1) !== NULL) {
			$notification = serialize(array(
				'status'	=> 'not_logged_in',
				'message'	=> 'No ha iniciado sesión.',
				'type'		=> 'error'
			));

			$this->session->set_flashdata('notification', $notification);

			// redirect
			redirect('login');
		}

	}

	/**
	* Remaps every controller call.
	*
	* @param	string	- the called controller
	* @param	string	- the methods and variables
	*/
	public function _remap($method, $parameters) {
		if (method_exists($this, $method)) {

			// $this 	- the controller name (as in the class definition)
			// $method 	- the method inside the controller

			call_user_func_array(array($this, $method), $parameters);

			// set the path to the view files
			$view = strtolower('files/' . get_class($this)) . '/' . $method;

			// does a specific view needs to be loaded?
			if (is_string($this->view) && !empty($this->view)) {
				$view = $this->view;
			}

			// autoload the view
			if ($this->view !== FALSE) {
				$this->data->yield = $this->load->view($view, $this->data, TRUE);

				// check if there's a custom layout
				if (is_string($this->layout) AND !empty($this->layout)) {
					$layout = $this->layout;

				// set the path to check for an existing layout
				} elseif (file_exists(APPPATH . 'views/layouts/' . strtolower(get_class($this) . '.php'))) {
					$layout = strtolower(get_class($this));

				// if all else fails, set the main layout
				} else {
					$layout = 'default';
				}

				// if the layout is going to be called
				if (is_string($layout) AND !empty($layout)) {
					$this->load->view('layouts/' . $layout, $this->data);

				// if not, echo directly to output for ajax calls, file handling, etc.
				} else {
					echo $this->data->yield;
				}
			}

		// if there's not a view found, show 404
		} else {

			// this can be changed to a routed or custom controller
			show_404();
		}

		/* add here everything else you need to do before the load of the
		/* controller ends */
	}
}

/* End of file SAV_Controller.php */
/* Location: ./application/core/SAV_Controller.php */