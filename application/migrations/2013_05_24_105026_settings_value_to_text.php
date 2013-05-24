<?php

class Settings_Value_To_Text {

	/**
	 * Since settings can now be long, we need a text type value
	 *
	 * @return void
	 */
	public function up()
	{
		DB::query("ALTER TABLE settings MODIFY COLUMN value TEXT");
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::query("ALTER TABLE settings MODIFY COLUMN value VARCHAR(255)");
	}

}