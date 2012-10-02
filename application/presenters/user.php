<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UserPresenter {
	public function avatar($user_id, $width = 200, $height = null) {
		$file = FCPATH . 'files/avatars/' . $user_id . '/avatar.jpg';

		if (empty($height)) {
			$height = $width;
		}

		if (!file_exists($file)) {
			return '<img src="http://placehold.it/' . $width . 'x' . $height . '" alt="" width="' . $width . '" height ="' . $height . '" />';
		}else {
			return '<img src="' . base_url('files/avatars/' . $user_id . '/avatar.jpg') . '" alt="" width="' . $width . '" height="' . $height . '" />';
		}
	}
}

/* End of file user.php */
/* Location: ./application/presenters/user.php */