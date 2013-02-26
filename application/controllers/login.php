<?php

class Login_Controller extends Base_Controller {

	public $restful = true;

	public function __construct() {
		parent::__construct();
		Asset::add('login', 'css/login.css');
	}

	public function get_index() {
		return View::make('login.index');
	}

}