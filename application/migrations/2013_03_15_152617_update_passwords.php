<?php

class Update_Passwords {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up() {
		$users = User::all();

		// use the usernames as bcrypted passwords
		foreach($users as $user) {
			$user->password = Hash::make($user->username);
			$user->save();
		}
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down() {
		$users = User::all();

		// reset users passwords to sha256 username
		foreach($users as $user) {
			$user->password = hash('sha256', $user->username);
			$user->save();
		}
	}

}