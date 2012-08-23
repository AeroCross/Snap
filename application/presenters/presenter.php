<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Presenter class.
*
* Adds a RoR-like interface for presenting results into views without using
* explicit logic inside them.
*
* Original concept by Jamie Rumbelow <jamie@jamierumbelow.com>, found in 
* the "Codeigniter Handbook", Vol. 1. (@see http://http://codeigniterhandbook.com/)
*
* @package		SAV
* @subpackage	Presenters
* @author		Mario Cuba <mario@mariocuba.net>
*/
class Presenter {

	// the name of the object
	protected $name;

	/**
	* The class constructor.
	*
	* This takes whatever object is passed to this class, and removed the "_presenter" suffix.
	* 
	* @param	object	- the object to process
	* @access	public
	*/
	public function __construct($object = NULL) {
		if (is_object($object)) {
			$this->name = strtolower(str_replace('_presenter', '', get_class($this)));
		}
	}

	/**
	* The class getter.
	*
	* This will help the class to load properties, methods and values automatically, if they don't exist.
	*
	* @param	mixed	- the object, property, or method to be loaded
	* @return	object	- the object property or method 
	*/
	public function __get($attr) {
		if (isset(get_instance()->$attr)) {
			return get_instance()->$attr;
		}
	}
}

/* End of file presenter.php */
/* Location: ./application/presenters/presenter.php */