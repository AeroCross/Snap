<?php

/**
* Handles the configuration settings for the application
*
* @package		SAAV
* @subpackage	Controllers
* @author		Mario Cuba <mario@mariocuba.net>
*/
class Settings_Controller extends Base_Controller {

	public $restful = true;

	/**
	* Shows the settings
	*
	* @access	public
	*/
	public function get_index() {
		// get all the settings and send them to the view
		$settings = Setting::all();

		foreach ($settings as $setting) {
			$data[$setting->name] = $setting->value;
		}

		// cast the array as an object, for ease of access
		$data = (object) $data;

		return View::make('settings.index')->with('setting', $data);
	}

	/**
	* Updates settings
	*
	* @access	public
	*/
	public function put_index() {

	}
}