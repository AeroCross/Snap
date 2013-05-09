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
}