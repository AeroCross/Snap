<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Add_email_and_general_settings extends CI_Migration {

	public function up() {
		$settings = array(
			array(
				'name'	=> 'smtp_name',
				'value'	=> 'Ingenium: Desarrollo Virtual'
			),

			array(
				'name'	=> 'smtp_enabled',
				'value'	=> 1
			),

			array(
				'name'	=> 'per_page',
				'value'	=> 50
			),
		);

		$this->db->insert_batch('settings', $settings);
	}

	public function down() {
		$settings = array(
			'smtp_name',
			'smtp_enabled',
			'per_page'
		);

		$this->db->where_in('name', $settings);
		$this->db->delete('settings');
	}
}

/* End of file 001_add_email_and_general_settings.php */
/* Location: ./application/migrations/001_add_email_and_general_settings.php */