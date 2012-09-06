<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Form presenter.
*
* Widgets for forms.
*
* @package		SAAV
* @subpackage	Presenters
* @author		Mario Cuba <mario@mariocuba.net>
*/
class FormPresenter {

	// prevent overloading
	private $app;

	/**
	* The class constructor.
	*
	* @access	public
	*/
	public function __construct() {
		// get the global CI object
		$this->app =& get_instance(); 
	}

	/**
	* Creates options for the departments.
	*
	* @access	public
	*/
	public function departments() {
		$this->app->load->model('saav_department');
		return $this->_createOptions($this->app->saav_department->getDepartments(), 'id', 'name');
	}

	/**
	* Creates options for the admins.
	*
	* @access	public
	*/
	public function admins() {
		$this->app->load->model('saav_user');
		return $this->_createOptions($this->app->saav_user->_getUserNames(array(1)), 'id', 'name');
	}

	/**
	* Creates options for the support personnel.
	*
	* @access	public
	*/
	public function support($first_empty = TRUE) {
		$this->app->load->model('saav_user');
		return $this->_createOptions($this->app->saav_user->_getUserNames(array(2)), 'id', 'name', $first_empty);
	}

	/**
	* Creates options for the companies.
	*
	* @access public
	*/
	public function companies($first_empty = TRUE) {
		$this->app->load->model('saav_company');
		return $this->_createOptions($this->app->saav_company->getCompanies(), 'id', 'name');
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
}

/* End of file form.php */
/* Location: ./application/presenters/form.php */