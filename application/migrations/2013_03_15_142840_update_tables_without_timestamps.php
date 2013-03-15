<?php

class Update_Tables_Without_Timestamps {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('companies', function($table) {
			$table->timestamps();
		});

		Schema::table('company_users', function($table) {
			$table->timestamps();
		});

		Schema::table('department_members', function($table) {
			$table->timestamps();
		});

		Schema::table('departments', function($table) {
			$table->timestamps();
		});

		Schema::table('role_assignments', function($table) {
			$table->timestamps();
		});

		Schema::table('roles', function($table) {
			$table->timestamps();
		});

		Schema::table('settings', function($table) {
			$table->timestamps();
		});

		Schema::table('users', function($table) {
			$table->timestamps();
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('companies', function($table) {
			$table->drop_column(array('created_at', 'updated_at'));
		});

		Schema::table('company_users', function($table) {
			$table->drop_column(array('created_at', 'updated_at'));
		});

		Schema::table('department_members', function($table) {
			$table->drop_column(array('created_at', 'updated_at'));
		});

		Schema::table('departments', function($table) {
			$table->drop_column(array('created_at', 'updated_at'));
		});

		Schema::table('role_assignments', function($table) {
			$table->drop_column(array('created_at', 'updated_at'));
		});

		Schema::table('roles', function($table) {
			$table->drop_column(array('created_at', 'updated_at'));
		});

		Schema::table('settings', function($table) {
			$table->drop_column(array('created_at', 'updated_at'));
		});

		Schema::table('users', function($table) {
			$table->drop_column(array('created_at', 'updated_at'));
		});
	}

}