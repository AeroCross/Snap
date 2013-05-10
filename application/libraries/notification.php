<?php

/**
* Notification framework
*
* @package		SAAV
* @subpackage	Libraries
* @author		Mario Cuba <mario@mariocuba.net>
*/
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

		$message	= $notification['message'];
		$type		= $notification['type'];

		// create a notification with a title
		if (isset($notification['title']) and !empty($notification['title'])) {
			$message = '<strong>' . $notification['title'] . '</strong><br / > ' . $message;
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

			case 'form_email_invalid':
				return array(
					'message' => 'Dirección de correo electrónico inválida',
					'type'	=> 'warning'
				);
			break;

			case 'form_email_exists':
				return array(
					'message' => 'La dirección de correo ya está registrada',
					'type'	=> 'warning'
				);
			break;

			case 'form_user_exists':
				return array(
					'message' => 'El nombre de usuario ya está registrado',
					'type'	=> 'warning'
				);
			break;

			case 'form_passwords_must_match':
				return array(
					'message' => 'Los campos de contraseña deben coincidir',
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

			// ticket messages
			case 'message_add_failed':
				return array(
					'message'	=> 'Error en la base de datos',
					'type'		=> 'error'
				);
			break;
			case 'message_add_success':
				return array(
					'message'	=> 'El personal ha sido notificado y responderá a la brevedad posible',
					'type'		=> 'success',
					'title'		=> 'Consulta actualizada'
				);
			break;

			// tickets
			case 'ticket_status_changed':
				return array(
					'message'	=> 'Estatus de la consulta actualizado',
					'type'		=> 'info'
				);
			break;

			// settings
			case 'settings_success':
				return array(
					'message'	=> 'Configuración actualizada',
					'type'		=> 'success'
				);
			break;

			// users
			case 'user_add_success':
				return array(
					'message'	=> 'Usuario creado',
					'type'		=> 'success'
				);
			break;

			case 'user_add_failure':
				return array(
					'message'	=> 'No se pudo crear el usuario por un error desconocido',
					'type'		=> 'success'
				);
			break;

			// roles
			case 'roles_assigned':
				return array(
					'message'	=> 'Roles asignados',
					'type'		=> 'success'
				);

			// default
			default:
				return array(
					'message'	=> 'Mensaje de error <strong>' . $notification . '</strong> no definido',
					'type'		=> 'error'
				);
		}
	}
}