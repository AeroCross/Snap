<?php

/**
* Shows the dashboard
*
* @package		SAAV
* @subpackage	Controllers
* @author		Mario Cuba <mario@mariocuba.net>
*/
class Dashboard_Controller extends Base_Controller {

	public $restful	= true;

	public function get_index() {
		$assigned		= Ticket::where_assigned_to(Session::get('id'))->where_status('open')->take(10)->order_by('id', 'desc')->get();
		$totalAssigned	= Ticket::where_assigned_to(Session::get('id'))->where_status('open')->count();
		$latest			= Ticket::take(10)->order_by('id', 'desc')->get();

		// what badge should we display in assigned?
		if ($totalAssigned == 0): $badge = 'success'; else: $badge = 'important'; endif;

		return View::make('dashboard.index')
		->with('assigned', $assigned)
		->with('latest', $latest)
		->with('totalAssigned', $totalAssigned)
		->with('badge', $badge);
	}
}