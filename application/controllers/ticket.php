<?php

/**
* Handles ticket CRUD and other methods.
*
* @package		SAAV
* @subpackage	Controllers
* @author		Mario Cuba <mario@mariocuba.net>
*/
class Ticket_Controller extends Base_Controller {

	public $restful = true;

	/**
	* Shows the add ticket form
	*
	* @access	public
	*/
	public function get_add() {
		// all departments are here, ordered by id
		$departments	= Department::get();

		foreach ($departments as $department) {
			// all members of THIS department are here, ordered by ID
			$members = Department::find($department->id)->user()->get();
			
			foreach ($members as $member) {
				$staff[$department->id][$member->id]['id']		= $member->id;
				$staff[$department->id][$member->id]['name']	= $member->firstname . ' ' . $member->lastname;
			}
		}
		
		// data that's gonna be passed to the view
		$this->data->departments	= $departments;
		$this->data->members		= $staff;

		return View::make('ticket/add')->with('data', $this->data);
	}

}