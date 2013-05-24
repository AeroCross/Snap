<?php

class Add_System_Message {

	/**
	 * Add the system message field
	 *
	 * @return void
	 */
	public function up()
	{
		$settings = new Setting();
		$settings->name	= 'system-message';
		$settings->value	= null;

		$settings->save();

		$settings = new Setting();
		$settings->name	= 'system-message-title';
		$settings->value	= null;

		$settings->save();
	}

	/**
	 * Remove the new fields
	 *
	 * @return void
	 */
	public function down()
	{
		DB::table('settings')->where_name('system-message-title')->delete();
		DB::table('settings')->where_name('system-message')->delete();
	}

}