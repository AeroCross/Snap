<?php

class Notification {

	/**
	* Creates a new notification
	*
	* @param	string	- a message override
	* @param	string	- a type override
	* @param	string	- a title override
	* @access	public
	*/
	public static function show($message = null, $type = 'info', $title = null) {
		// session notification?
		$notification	= Session::get('notification'); 
		// the default data
		$notification	= self::notifications($notification);

		if (!empty($message)) {
			$notification = array(
				'message'	=> $message,
				'type'		=> $type,
				'title'		=> $title
			);
		// nothing to do here since there's no notification
		} elseif (empty($notification)) {
			return false;
		}		

		$message		= $notification['message'];
		$type			= $notification['type'];

		// create a notification with a title
		if (isset($notification['title'])) {
			$message = '<strong>' . $data['title'] . '</strong> ' . $message;
		}

		$start	= '<div class="alert alert-' . $type . ' fade in"><button type="button" class="close" data-dismiss="alert">&times;</button>';
		$end	= '</div>';

		// output inmediatly
		echo $start . $message . $end;
	}

	/**
	* Defines all the system notifications
	*
	* @access	public
	*/
	public static function notifications($notification) {
		switch ($notification) {
			// form fields
			case 'form_required':
				return array(
					'message' => 'Todos los campos son requeridos',
					'type'	=> 'warning'
				);
			break;
			// authentication messages
			case 'auth_logout':
				return array(
					'message'	=> 'Ha cerrado sesión',
					'type'		=> 'info'
				);
			break;
			case 'auth_failed':
				return array(
					'message'	=> 'Nombre de usuario o contraseña incorrectos',
					'type'		=> 'warning',
				);
			break;
			case 'auth_missing':
				return array(
					'message'	=> 'No ha iniciado sesión',
					'type'		=> 'error',
				);
			break;
		}
	}
}