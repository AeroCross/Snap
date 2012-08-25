<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Form presenter.
*
* Widgets for forms.
*
* @package		SAV
* @subpackage	Presenters
* @author		Mario Cuba <mario@mariocuba.net>
*/
class FormPresenter {

	// prevent overloading
	private $sav;

	/**
	* The class constructor.
	*
	* @access	public
	*/
	public function __construct() {
		// get the global CI object
		$this->sav =& get_instance(); 
	}

	/**
	* Creates option elements for all the methods.
	*
	* @param	array	- data that contains the database information
	* @param	string	- database field that contains the value
	* @param	string	- database field that contains the name to display
	* @return	string	- formed HTML of options
	* @access	private
	*/
	private function  _createOptions($data, $value, $name, $first_empty = TRUE) {
		// first empty item
		if ($first_empty === TRUE) {
			$items[]	= '<option value=""></option>';
		}

		// fill all the options with database values
		foreach($data as $d) {
			$items[]	= '<option value="' . $d->$value . '">' . $d->$name . '</option>';
		}

		// implode() isn't used because the bad prototype would be used
		// @see http://www.php.net/manual/en/function.implode.php
		$result = '';

		foreach ($items as $i) {
			$result = $result . $i;
		}

		return $result;
	}

	/**
	* Creates options for the departments.
	*
	* @access	public
	*/
	public function departments() {
		$this->sav->load->model('sav_department');
		return $this->_createOptions($this->sav->sav_department->getDepartments(), 'id', 'name');
	}
}

/* End of file form.php */
/* Location: ./application/presenters/form.php */