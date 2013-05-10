<?php

/**
* Manages user roles inside the application
*
* @package		SAAV
* @subpackage	Controllers
* @author		Mario Cuba <mario@mariocuba.net>
*/
class Admin_Roles_Controller extends Base_Controller {

	public $restful = true;

	/**
	* Shows the roles management view
	*
	* @access	public
	* @return	View
	*/
	public function get_index() {
		$users = User::all();
		
		foreach ($users as $user) {
			$users_array[$user->id] = $user;
		}

		// for quick traversing
		$users = $users_array;

		// users from each role
		$admins		= Role_Assignment::where_role_id(1)->get();
		$supports	= Role_Assignment::where_role_id(2)->get();
		$regulars	= Role_Assignment::where_role_id(3)->get();
		
		return View::make('admin.roles.index')
			->with('title', 'Roles')
			->with('users', $users)
			->with('admins', $admins)
			->with('supports', $supports)
			->with('regulars', $regulars);
	}

	/**
	* Updates roles for users
	*
	* @return	Redirect
	*/
	public function put_update() {
		$input = Input::all();
		$rules = array(
			'users'	=> 'required',
			'action'	=> 'required'
		);

		$validation = Validator::make($input, $rules);

		if ($validation->fails()) {
			return Redirect::to('admin/roles')->with('notification', 'form_required');
		}

		DB::transaction(function() use ($input) {
			// remove all role assignments
			$users = implode("','", $input['users']);
			$users = "('" . $users . "')";
			$sql = DB::table('role_assignments')->where('user_id', 'IN', DB::raw($users))->delete();

			// add new role assignments
			foreach ($input['users'] as $user) {
				$assignment = new Role_Assignment;
				$assignment->role_id = $input['action'];
				$assignment->user_id = $user;
				$assignment->save();
			}
		});

		return Redirect::to('admin/roles')->with('notification', 'roles_assigned');
	}
}