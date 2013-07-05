<?php

/**
* Manages user roles inside the application
*
* @package		SAAV
* @subpackage	Controllers
* @author		Mario Cuba <mario@mariocuba.net>
*/
class Admin_Departments_Controller extends Base_Controller {

	public $restful = true;

	/**
	* Shows the roles management view
	*
	* @access	public
	* @return	View
	*/
	public function get_index() {
		$departments	= Department::all();
		$users			= User::all();

		return View::make('admin.departments.index')
			->with('title', 'Departamentos')
			->with('departments', $departments)
			->with('users', $users)
			->with('members', $members);
	}

	/**
	* Adds a new department
	*
	* @access	public
	*/
	public function post_add() {
		$department = Input::get('department');

		if (empty($department)) {
			return Redirect::to('admin/departments')
				->with('notification', 'form_required');
		}

		$department = Department::create(array('name' => $department));

		if ($department != false) {
			return Redirect::to('admin/departments')
				->with('notification', 'department_added');
		}
	}

	/**
	* Updates the department members
	*
	* @access	public
	* @return	View
	*/
	public function put_update_users() {
		$users	= Input::get('users');
		$to		= Input::get('to');
		$rules	= array(
			'users'	=> 'required',
			'to'		=> 'required'
		);

		$validation = Validator::make(Input::all(), $rules);

		if ($validation->fails()) {
			return Redirect::to('admin/departments')->with('notification', 'form_required');
		}

		DB::transaction(function() use ($users, $to) {
			// remove previous assignments
			$users_string = implode("','", $users);
			$users_string = "('" . $users_string . "')";

			DB::table('department_members')->where('user_id', 'IN', DB::raw($users_string))->delete();

			// assign new memberships
			foreach($users as $user) {
				Department_Member::create(array('user_id' => $user, 'department_id' => $to));
			}
		});

		return Redirect::to('admin/departments')->with('notification', 'department_members_updated');
	}
}