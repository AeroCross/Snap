<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Codeigniter Core Loader Extension
*
* Adds methods for loading and instantiating new objects.
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
class EXT_Loader extends CI_Loader {

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

/* End of file EXT_Loader.php */
/* Location: ./application/core/EXT_Loader.php */