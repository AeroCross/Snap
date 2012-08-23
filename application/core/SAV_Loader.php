<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SAV_Loader extends CI_Loader {

	/**
	* Loads a presenter.
	*
	* @param	string - the presenter to load
	* @access	public
	*/
	public function presenter($presenter = array()) {
		if (is_array($presenter)) {
			foreach ($presenter as $p) {
				$p = str_replace('_presenter', '', $p);
				$files[$p] = APPPATH . 'presenters/' . $p . '.php';
			}
		} else {
			$files = array($presenter => APPPATH . 'presenters/' . $presenter . '.php');
		}

		foreach ($files as $key => $file) {
			if (file_exists($file)) {
				// add the class to memory
				require_once $file;

				// set the correct class name
				$name = ucfirst($key) . 'Presenter';
				
				// get the CI object
				$CI =& get_instance();
				
				// check if the "presenter" property exists so it can be created
				if (!property_exists($CI, 'presenter')) {
					$CI->presenter = new StdClass;
				}

				// instantiate
				$CI->presenter->$key = new $name();
			} else {
				show_error('Unable to load the requested file: presenters/' . $key . '.php');
				return FALSE;
			}
		} 

		// all files loaded
		return TRUE;
	}

	/**
	* Plural alias of presenter()
	*
	* @param	string - the presenter to load
	* @access	public
	*/
	public function presenters($presenters = array()) {
		$this->presenter($presenters);
	}
}

/* End of file SAV_Loader.php */
/* Location: ./application/core/SAV_Loader.php */