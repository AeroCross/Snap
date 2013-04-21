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

		return View::make('settings.index')->with('setting', $data)->with('title', 'Configuración');
	}

	/**
	* Updates settings
	*
	* @access	public
	*/
	public function put_index() {
		$settings = array(
			'per_page'		=> Input::get('per_page'),
			'smtp_host'		=> Input::get('smtp_host'),
			'smtp_port'		=> Input::get('smtp_port'),
			'smtp_user'		=> Input::get('smtp_user'),
			'smtp_pass'		=> Input::get('smtp_pass'),
			'smtp_name'		=> Input::get('smtp_name'),
			'smtp_crypto'	=> Input::get('smtp_crypto')
		);

		foreach ($settings as $setting => $value) {
			DB::table('settings')->where('name', '=', $setting)->update(array('value' => $value, 'updated_at' => DB::raw('NOW()')));
		}

		return Redirect::to('settings')->with('notification', 'settings_success');
	}
}