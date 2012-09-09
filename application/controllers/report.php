<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends EXT_Controller {

	/**
	* The class constructor.
	*
	* @access	public
	*/
	public function __construct() {
		parent::__construct();

		// sets the title
		$this->data->title = 'Reportar un Problema';

		// loads requried code
		$this->load->presenter('notification');
	}

	/**
	* Shows the report bug form.
	*
	* @access	public
	*/
	public function index() {
		$this->data->title = 'Reportar un Problema';
	}
}

/* End of file report.php */
/* Location: ./application/controllers/report.php */