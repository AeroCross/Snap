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
	* @param	bool	- true if the first option must be empty
	* @return	string	- the generated html
	* @access	public
	*/
	public function departments($first_empty = true) {
		$this->app->load->model('saav_department');
		return $this->_createOptions($this->app->saav_department->getDepartments(), 'id', 'name', $first_empty);
	}

	/**
	* Creates options for the admins.
	*
	* @param	bool	- true if the first option must be empty
	* @return	string	- the generated html
	* @access	public
	*/
	public function admins($first_empty = true) {
		$this->app->load->model('saav_user');
		return $this->_createOptions($this->app->saav_user->getNamesByRole(array(1)), 'id', 'name', $first_empty);
	}

	/**
	* Creates options for the support personnel.
	*
	* @param	bool	- true if the first option must be empty
	* @return	string	- the generated html
	* @access	public
	*/
	public function support($first_empty = true) {
		$this->app->load->model('saav_user');
		return $this->_createOptions($this->app->saav_user->getNamesByRole(array(2)), 'id', 'name', $first_empty);
	}

	/**
	* Creates options for the companies.
	*
	* @param	bool	- true if the first option must be empty
	* @return	string	- the generated html
	* @access public
	*/
	public function companies($first_empty = true) {
		$this->app->load->model('saav_company');
		return $this->_createOptions($this->app->saav_company->getCompanies(), 'id', 'name', $first_empty);
	}

	/**
	* Creates options for the users.
	*
	* @param	bool	- true if the first option must be empty
	* @return	string	- the generated html
	* @access public
	*/
	public function users($first_empty = true) {
		$this->app->load->model('saav_user');
		return $this->_createOptions($this->app->saav_user->getNamesByRole(array(3)), 'id', 'name', $first_empty);
	}

	/**
	* Creates options for the roles.
	*
	* @param	bool	- true if the first option must be empty
	* @return	string	- the generated html
	*/
	public function roles($first_empty = true) {
		$this->app->load->model('saav_role'); 
		return $this->_createOptions($this->app->saav_role->getRoles(), 'id', 'name', $first_empty);
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
	private function  _createOptions($data, $value, $name, $first_empty = true) {
		$items = array();

		// first empty item
		if ($first_empty === true) {
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