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
		// check if there was a message sent
		if ($this->input->post('submit') != false) {
			$this->presenter->notification->create($this->_process());
		}
	}

	/**
	* Processes the report.
	*
	* @access	private
	*/
	private function _process() {
		$this->load->library('form_validation');

		$this->form_validation->set_rules('type', 'Tipo de Reporte', 'required');
		$this->form_validation->set_rules('subject', 'Asunto', 'required');
		$this->form_validation->set_rules('message', 'Mensaje', 'required');

		if (!$this->form_validation->run()) {
			return array(
				'status'	=> 'validation_failed',
				'message'	=> 'Todos los campos son requeridos.',
				'type'		=> 'warning'
			);
		}

		switch ($this->input->post('type')) {
			case 'issue':		$type = '(SAAV) Problema: ';		break;
			case 'suggestion':	$type = '(SAAV) Sugerencia: ';		break;
		}

		$reporter = new StdClass;
		$reporter->name = $this->session->userdata('name');
		$reporter->email = $this->session->userdata('email');
		$subject = $this->input->post('subject');
		$message = $this->input->post('message');

		// responsible/s
		$support = 'mario.cuba@ingenium-dv.com';

		$this->load->library('email');
		$this->init->email();

		$this->email->to($support);
		$this->email->from($reporter->email, $reporter->email);
		$this->email->subject($type . $subject);
		$this->email->message($message);

		if ($this->email->send()) {
			return array(
				'status' 	=> 'sent',
				'message'	=> 'Su mensaje ha sido enviado. Soporte técnico le contactará a la brevedad posible &mdash; muchas gracias.',
				'type'		=> 'success'
			);

		// couldn't sent email
		} else {
			echo $this->email->print_debugger();
			return array(
				'status'		=> 'sending_failed',
				'message'		=> 'No hemos podido enviar su mensaje a soporte &mdash; escríbanos directamente vía ' . mailto('soporte@ingenium-dv.com', 'correo electrónico') . '.',
				'type'			=> 'error'
			);
		}
	}
}

/* End of file report.php */
/* Location: ./application/controllers/report.php */