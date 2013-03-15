<?php

class Delete_Old_Tables {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up() {
		// useless codeigniter-only tables
		Schema::drop('sessions');
		Schema::drop('version');
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down() {
		Schema::create('sessions', function($table) {
			$table->engine = 'InnoDB';
			$table->string('session_id', 40)->default('0');
			$table->string('ip_address', 16)->default('0.0.0.0');
			$table->string('user_agent', 120);
			$table->integer('last_activity');
			$table->text('user_data');

			// indexes
			$table->primary('session_id');
			$table->index('last_activity');
		});

		Schema::create('version', function($table) {
			$table->integer('version');
		});
	}

}