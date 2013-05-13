<?php

/**
* Manages companies and the users within them
*
* @package      SAAV
* @subpackage   Controllers
* @author       Mario Cuba <mario@mariocuba.net>
*/
class Admin_Companies_Controller extends Base_Controller {

    public $restful = true;

    /**
    * Shows all available companies and creates new ones
    *
    * @access   public
    * @return   View
    */
    public function get_index() {
        $companies = Company::all();
        $users = User::all();

        return View::make('admin.companies.index')
        ->with('title', 'Compañías')
        ->with('companies', $companies)
        ->with('users', $users);
    }

    /**
    * Creates a new company
    *
    * @return   Redirect
    * @access   public
    */
    public function post_new() {
        $name       = Input::get('name');
        $rules      = array('name'  => 'required');
        $validation = Validator::make($name, $rules);

        if ($validation->fails()) {
            return Redirect::to('admin/companies')->with('notification', 'form_required');
        }

        $company    = Company::create(array('name' => $name));

        return Redirect::to('admin/companies')->with('notification', 'company_added');
    }

    /**
    * Adds users to a company
    *
    * @return   Redirect
    * @access   public
    */
    public function put_update() {
        $to     = Input::get('to');
        $users  = Input::get('users');
        $rules  = array(
            'to'    => 'required',
            'users' => 'required'
        );

        $validation = Validator::make(Input::all(), $rules);

        if ($validation->fails()) {
            return Redirect::to('admin/companies')->with('notification', 'form_required');
        }

        // eliminate company for users
        DB::transaction(function() use ($users, $to) {
            $users_string = implode("','", $users);
            $users_string = "('" . $users_string . "')";
            DB::table('company_users')->where('user_id', 'IN', DB::raw($users_string))->delete();
            
            // reassign company for users
            foreach($users as $user) {
                $assignment = new Company_User();
                $assignment->company_id = $to;
                $assignment->user_id = $user;
                $assignment->save();
            }
        });

        return Redirect::to('admin/companies')->with('notification', 'company_users_updated');
    }
}