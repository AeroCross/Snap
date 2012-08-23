<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Notification presenter.
*
* Shows notifications troughout the application.
*
* @package		SAV
* @subpackage	Presenters
* @author		Mario Cuba <mario@mariocuba.net>
*/
class NotificationPresenter extends Presenter {

	// stored notifications
	private $notifications = array();

	/**
	* Creates a new notification.
	*
	* @param	mixed	- the notification data
	* @return	bool	- TRUE if the notification was created, FALSE otherwise
	* @access	public
	*/
	public function create() {
		
	}
}

/* End of file notification.php */
/* Location: ./application/presenters/notification.php */