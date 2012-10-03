<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* User presenter.
*
* Handles the display of user-related objects.
*
* @package		SAAV
* @subpackage	Presenters
* @author		Mario Cuba <mario@mariocuba.net>
*/
class UserPresenter {

	/**
	* The class constructor.
	*
	* @access	public
	*/
	public function __construct() {
		$this->app = & get_instance();
	}

	/**
	* Shows the user avatar.
	*
	* @param	int		- the user id for the avatar
	* @param	int		- the width of the image
	* @param	int		- the height of the image
	* @return	string	- the html img tag with the avatar
	* @access	public
	*/
	public function avatar($user_id, $width = 200, $height = null) {
		$file = APPPATH . 'uploads/avatars/' . $user_id . '/' . md5($user_id) . '.jpg';

		if (empty($height)) {
			$height = $width;
		}

		if (!file_exists($file)) {
			return '<img src="' . $this->app->resource->img('avatars/default.png') . '" alt="" width="' . $width . '" height ="' . $height . '" />';
		}else {
			return '<img src="' . base_url('application/uploads/avatars/' . $user_id . '/' . md5($user_id) . '.jpg?' . time()) . '" alt="" width="' . $width . '" height="' . $height . '" />';
		}
	}
}

/* End of file user.php */
/* Location: ./application/presenters/user.php */