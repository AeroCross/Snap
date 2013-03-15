<?php

class Update_Tables_With_Timestamps {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('messages', function($table) {
			// create timestamps
			$table->timestamps();
		});

		// move the data from date to created_at
		DB::table('messages')->update(array('created_at' => DB::raw('`date`')));

		// delete the remaining table
		Schema::table('messages', function($table) {
			$table->drop_column('date');
		});

		// rename the fields of the tickets table
		DB::query('ALTER TABLE `tickets` CHANGE `date_created` `created_at` DATETIME');
		DB::query('ALTER TABLE `tickets` CHANGE `date_modified` `updated_at` DATETIME');
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down() {
		// revert changes to the messages table
		DB::query('ALTER TABLE `messages` CHANGE `created_at` `date` DATETIME');

		Schema::table('messages', function($table) {
			$table->drop_column('updated_at');
		});

		// rename back the tickets table time fields
		DB::query('ALTER TABLE `tickets` CHANGE `created_at` `date_created` DATETIME');
		DB::query('ALTER TABLE `tickets` CHANGE `updated_at` `date_modified` DATETIME');
	}

}