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
		$assigned	= new StdClass;
		$latest		= new StdClass;
		$total		= new StdClass;

		// data
		$assigned->tickets		= Ticket::where_assigned_to(Session::get('id'))->where_status('open')->take(13)->order_by('id', 'desc')->get();
		$latest->tickets		= Ticket::take(13)->order_by('id', 'desc')->get();

		// numbers
		$assigned->open			= Ticket::where_assigned_to(Session::get('id'))->where_status('open')->count();
		$assigned->total		= Ticket::where_assigned_to(Session::get('id'))->count();
		$total->amount			= Ticket::count();
		$total->open			= Ticket::where_status('open')->count();

		Asset::add('charts', 'js/charts/highcharts.js');
		Asset::add('charts-more','js/charts/highcharts-more.js');

		// chart: total of tickets
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

		// chart: tickets this week
		$week = new StdClass;
		
		// get current day and the 7 days before, then turn them into an array
		define('DAY_SECS', 86400);
		$days[]	= date('l');

		// get the 6 prior days of today
		for ($x = 1; $x <= 6; $x++) {
			$days[] = date('l', time() - (DAY_SECS * $x));
		}

		$days				= array_reverse($days);
		$days_translation	= array(
			'Monday'	=> 'Lunes',
			'Tuesday'	=> 'Martes',
			'Wednesday'	=> 'Miércoles',
			'Thursday'	=> 'Jueves',
			'Friday'	=> 'Viernes',
			'Saturday'	=> 'Sábado',
			'Sunday'	=> 'Domingo'
		);

		foreach ($days as &$d) {
			$d = $days_translation[$d];
		}

		$week->days	= json_encode($days);

		// now, get the 7 day ticket count
		$max = time();
		$min = time() - (DAY_SECS * 6);

		function sqltime($timestamp) {
			return date('Y-m-d', $timestamp);
		}
		
		$bindings		= array(sqltime($min), sqltime($max));
		$week->count	= DB::first('SELECT COUNT(`id`) as `total` FROM tickets WHERE created_at BETWEEN ? AND ?', $bindings)->total;

		$date = sqltime($min);

		for ($x = 1; $x <= 7; $x++) {
			$bindings		= array($date, $date);
			$day_tickets[]	= DB::first('SELECT COUNT(`id`) as `total` FROM tickets WHERE created_at BETWEEN ? AND DATE_ADD(?, INTERVAL 1 DAY)', $bindings)->total;
			$date			= sqltime($min + (DAY_SECS * $x));
		}

		$week->tickets = json_encode($day_tickets, JSON_NUMERIC_CHECK);

		// what badge should we display in assigned?
		if ($assigned->total == 0): $badge = 'success'; else: $badge = 'important'; endif;

		return View::make('dashboard.index')
		->with('assigned', $assigned)
		->with('latest', $latest)
		->with('total', $total)
		->with('tickets', $tickets)
		->with('week', $week)
		->with('badge', $badge)
		->with('title', 'Dashboard');
	}
}