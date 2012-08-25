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
class NotificationPresenter {

	// stored notifications
	private $notifications = array();

	/**
	* Creates a new notification.
	*
	* @param	mixed	- the notification data
	* @return	bool	- TRUE if the notification was created, FALSE otherwise
	* @access	public
	*/
	public function create($data) {

		// if it's not an array, there's nothing to do here
		if (!is_array($data)) {
			return FALSE;
		}

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
}

/* End of file notification.php */
/* Location: ./application/presenters/notification.php */