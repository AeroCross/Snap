<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Notification presenter.
*
* Shows notifications troughout the application.
*
* @package		SAAV
* @subpackage	Presenters
* @author		Mario Cuba <mario@mariocuba.net>
*/
class NotificationPresenter {

	// stored notifications
	private $notifications = array();

	public function __construct() {
		$this->app =& get_instance();
	}

	/**
	* Creates a new notification.
	*
	* @param	mixed	- the notification data
	* @param	string	- the type of notification (normal, toast)
	* @return	bool	- TRUE if the notification was created, FALSE otherwise
	* @access	public
	*/
	public function create($data, $type = 'normal') {

		// if it's not an array, there's nothing to do here
		if (!is_array($data)) {
			return FALSE;
		}

		if ($type === 'toast') {
			return $this->_createToast($data);
		} else {
			return $this->_createNotification($data);
		}
	}

	/**
	* Shows the selected notification.
	*
	* @param	int		- the notification to show
	* @param	bool	- return as text (TRUE) or echo the notification (FALSE)
	* @return	mixed	- the notification or the echo
	* @access	public
	*/
	public function show($notification = NULL, $return = FALSE) {

		// no notifications, return nothing
		if (empty($this->notifications)) {
			return NULL;
		}

		// no notification selected — get the last one
		if ($notification === NULL) {
			$notification = count($this->notifications) - 1;

		// notification selected with proper numbering
		} elseif (is_numeric($notification)) {
			(int) $notification = (int) $notification - 1;

		// erroneous parameter
		} else {
			show_error('Parameter <strong>$notification</strong> must be an integer.');
		}

		// return if selected
		if ($return === TRUE) {
			return $this->notifications[$notification];

		// echo the result
		} else {
			echo $this->notifications[$notification];
		}
	}

	/**
	* Creates a new normal notification.
	*
	* @param	mixed	- the notification data
	* @return	bool	- TRUE if the notification was created, FALSE otherwise
	* @access	public
	*/
	public function _createNotification($data) {
		// initialize
		$class		= '';
		$message	= '';
		$title		= '';

		// fetch the data
		foreach($data as $key => $d) {
				switch ($key) {
					case 'block':	$class		.= ' alert-block'; 	break;
					case 'class':	$class		.= $d;				break;
					case 'type':	$type		= $d;				break;
					case 'message':	$message	= $d;				break;
					case 'title': 	$title 		= $d;				break;
				}
			}

		// properly configure title
		if (isset($title)) {
			if (isset($data['block'])) {
				$message = '<h4>' . $title . '</h4> ' . $message;
			} else {
				$message = '<strong>' . $title . '</strong> ' . $message;	
			}
		}

		// form the notification
		$start	= '<div class="alert fade in alert-' . $type . $class . '">';
		$close	= '<a class="close" data-dismiss="alert" href="#">&times;</a>';
		$end	= '</div>';

		$this->notifications[] = $start . $close . $message . $end;

		// all good
		return TRUE;
	}

	/**
	* Creates a toast.
	*
	* @param	mixed	- the notification data
	* @return	bool	- TRUE if the notification was created, FALSE otherwise
	* @access	public
	*/
	public function _createToast($data) {
		if (isset($data['title'])) {
			$data['title'] = ', \'' . $data['title'] . '\'';
		}

		$this->notifications[] = $this->app->load->view('notifications/toast', $data, TRUE);

		return TRUE;
	}
}

/* End of file notification.php */
/* Location: ./application/presenters/notification.php */