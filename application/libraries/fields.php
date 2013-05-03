<?php

/**
* Generates fields for different types of form inputs
*
* @package		SAAV
* @subpackage	Libraries
* @author		Mario Cuba <mario@mariocuba.net>
*/
class Fields {

	/**
	* Creates the option values for department members, grouped by department
	*
	* @param	object	- the departments as a database resource
	* @access	public
	*/
	public static function members($departments = null) {
		// if no department model is passed, use all departments
		if (empty($departments)) {
			$departments = Department::all();
		}

		// field starts empty
		$field		= '<option></option>';

		// loop through each department to form groups
		foreach ($departments as $department) {
			// get the members of THIS department
			$members	= Department::find($department->id)->user()->where_deleted('0')->get();

			// start the group
			$field .= '<optgroup label="' . $department->name . '">';

			// fill the group
			foreach ($members as $member) {
				$field .= '<option value="' . $member->id . '">' . $member->firstname . ' ' . $member->lastname . '</option>';
			}

			// end the group
			$field .= '</optgroup>';
		}

		// rinse, repeat, then show
		echo $field;
	}

	/**
	* Generates the option values for all departments
	*
	* @access	public
	*/
	public static function departments() {
		// the field starts empty
		$field = '<option></option>';

		$departments = Department::all();

		foreach($departments as $department) {
			$field .= '<option value="' . $department->id . '">' . $department->name . '</option>';
		}
		
		// no need to return
		echo $field;
	}

	/**
	* Generates the option values for all companies
	*
	* @access	public
	*/
	public static function companies() {
		// the field starts empty
		$field = '<option></option>';

		$companies = Company::all();

		foreach($companies as $company) {
			$field .= '<option value="' . $company->id . '">' . $company->name . '</option>';
		}
		
		// no need to return
		echo $field;
	}
}