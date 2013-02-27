<?php

class Notification {

	public static $notification;

	/**
	* Creates a new notification
	*
	* @param	array, object	- the data (message, type, title) of the notification
	* @access	public
	*/
	public static function create($data) {
		if (empty($data)) {
			return false;
		}

		// convert to object
		$data = (object) $data;

		$message	= $data->message;
		$type		= $data->type;

		if (isset($data->title)) {
			$message = '<strong>' . $data->title . '</strong> ' . $message;
		}

		$start	= '<div class="alert alert-' . $type . ' fade in"><button type="button" class="close" data-dismiss="alert">&times;</button>';
		$end	= '</div>';

		self::$notification = $start . $message . $end;
	}

	/**
	* Outputs a notification, if available
	*
	* @access	public
	*/
	public static function show() {
		echo self::$notification; 
	}
}