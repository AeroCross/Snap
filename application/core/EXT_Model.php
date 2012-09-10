<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Codeigniter Core Model Extension
*
* Adds methods for chaining common database queries.
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
class EXT_Model extends CI_Model {

	/**
	* The class constructor.
	*
	* @access	public
	*/
	public function __construct() {
		parent::__construct();
	}

	/**
	* Adds a where clause to the object if called.
	*
	* @param	string	- the name of the method (not accessible)
	* @param	array	- an array of parameters
	* @return	object 	- the database object
	* @access	public
	*/
	public function __call($name, $parameter) {
		$this->db->where($name, $parameter[0]);
		return $this;
	}

	/**
	* Selects table data.
	*
	* @param	string	- the table fields
	* @return	object	- the database object
	* @access	public
	*/
	public function data($fields = '*') {
		$this->db->select($fields);
		return $this;
	}

	/**
	* Fetches query for further processing.
	*
	* @return	object	- the database object
	* @access	public
	*/
	public function fetch() {
		return $this->db->get($this->_table);
	}

	/**
	* Finishes query and gets a result.
	*
	* @return	object	- the database object
	* @access	public
	*/
	public function get() {
		return $this->db->get($this->_table)->row();
	}

	/**
	* Finishes query and gets all result.
	*
	* @return	object	- the database object
	* @access	public
	*/
	public function getAll() {
		return $this->db->get($this->_table)->result();
	}

	/**
	* Orders the query by field.
	*
	* @param	string	- the database field to order by
	* @param	string	- the ordering method
	* @return	object	- the database object
	* @access	public
	*/
	public function by($field, $order) {
		$this->db->order_by($field, $order);
		return $this;
	}

	/**
	* Limits and offsets the query to given numbers.
	*
	* @param	int		- the limit
	* @param	int		- the offset
	* @return	object	- the database object
	* @access	public
	*/
	public function limit($limit, $offset = NULL) {
		if (empty($offset)) {
			$this->db->limit($limit);
		} else {
			$this->db->limit($limit, $offset);
		}

		return $this;
	}

	/**
	* Inserts data.
	*
	* @param	array	- an associative array of data to add
	* @return	object	- the database object
	* @access	public
	*/
	public function insert($data) {
		return $this->db->insert($this->_table, $data);
	}

	/**
	* Updates rows.
	*
	* @param	array	- an associative array with all the where clauses
	* @param	array	- the data to add
	* @return	object	- the database object
	* @access	public
	*/
	public function update($where, $data) {
		return $this->db->where($where)->update($this->_table, $data);
	}

	/**
	* Deletes rows.
	*
	* @param	array	- an associative array with the where clauses
	* @return	object	- the database object
	* @access	public
	*/
	public function delete($where) {
		return $this->db->where($where)->delete($this->_table);
	}

	/**
	* Checks if the the data provided exists in the database.
	*
	* @param	string	- the value to compare
	* @param	string	- the database field to compare
	* @return	bool	- TRUE if the data exists, FALSE otherwise
	* @access	public
	*/
	public function match($value, $field) {
		$this->db
		->select($field)
		->where($field, $value);
		
		$sql = $this->db->get($this->_table);
		
		if ($sql->num_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}

/* End of file EXT_Model.php */
/* Location: ./application/core/EXT_Model.php */