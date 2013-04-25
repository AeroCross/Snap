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
		$data = new StdClass;

		// data
		$data->assigned		= Ticket::where_assigned_to(Session::get('id'))->where_status('open')->take(10)->order_by('id', 'desc')->get();
		$data->latest			= Ticket::take(10)->order_by('id', 'desc')->get();

		// numbers
		$data->totalAssigned	= Ticket::where_assigned_to(Session::get('id'))->where_status('open')->count();
		$data->total			= Ticket::count();
		$data->open				= Ticket::where_status('open')->count();

		Asset::add('charts', 'js/charts/highcharts.js');
		Asset::add('charts-more','js/charts/highcharts-more.js');

		$tickets				= new StdClass;
		$tickets->users	= User::all(); 

		foreach($tickets->users as $user) {

			$ticket_amount	= Ticket::where_reported_by($user->id)->count();

			if (!empty($ticket_amount)) {
				$json_tickets[]	= $ticket_amount;
				$json_users[]		= $user->firstname;
			}
		}

		$tickets->users = json_encode($json_users);
		$tickets->total = json_encode($json_tickets, JSON_NUMERIC_CHECK);


		// what badge should we display in assigned?
		if ($data->totalAssigned == 0): $data->badge = 'success'; else: $data->badge = 'important'; endif;

		return View::make('dashboard.index')
		->with('data', $data) // split!
		->with('title', 'Dashboard')
		->with('tickets_users', $tickets->users)
		->with('tickets_total', $tickets->total);
	}
}