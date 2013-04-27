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
		// add required assets
		Asset::add('charts', 'js/charts/highcharts.js');
		Asset::add('charts-more','js/charts/highcharts-more.js');

		// prevent errors creating default objects
		$assigned	= new StdClass;
		$latest		= new StdClass;
		$total		= new StdClass;

		// tickets
		$assigned->tickets		= Ticket::where_assigned_to(Session::get('id'))->where_status('open')->take(13)->order_by('id', 'desc')->get();
		$latest->tickets		= Ticket::take(13)->order_by('id', 'desc')->get();

		// stats
		$assigned->open			= Ticket::where_assigned_to(Session::get('id'))->where_status('open')->count();
		$assigned->total		= Ticket::where_assigned_to(Session::get('id'))->count();
		$total->amount			= Ticket::count();
		$total->open			= Ticket::where_status('open')->count();

		$tickets	= $this->chartTotalTickets();
		$week		= $this->chartWeeklyTickets();
		

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

	/**
	* Generates data for a "tickets in the last 7 days" graph
	*
	* @return	object	- days, tickets per day and total tickets in week in json format
	* @access	private
	*/
	private function chartWeeklyTickets() {
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
		
		$bindings		= array(Helper::sqltime($min), Helper::sqltime($max));
		$week->count	= DB::first('SELECT COUNT(`id`) as `total` FROM tickets WHERE created_at BETWEEN ? AND ?', $bindings)->total;

		$date = Helper::sqltime($min);

		for ($x = 1; $x <= 7; $x++) {
			$bindings		= array($date, $date);
			$day_tickets[]	= DB::first('SELECT COUNT(`id`) as `total` FROM tickets WHERE created_at BETWEEN ? AND DATE_ADD(?, INTERVAL 1 DAY)', $bindings)->total;
			$date			= Helper::sqltime($min + (DAY_SECS * $x));
		}

		$week->tickets = json_encode($day_tickets, JSON_NUMERIC_CHECK);

		return $week;
	}

	/**
	* Generates the data for a "total tickets per user" graph
	*
	* @return	object	- users and the amount of tickets they've made in json format
	* @access	private
	*/
	private function chartTotalTickets() {
		$tickets		= new StdClass;
		$tickets->users	= User::all(); 

		foreach($tickets->users as $user) {
			$ticket_amount	= Ticket::where_reported_by($user->id)->count();

			if (!empty($ticket_amount)) {
				$json_tickets[]	= $ticket_amount;
				$json_users[]	= $user->firstname;
			}
		}

		$tickets->users = json_encode($json_users);
		$tickets->total = json_encode($json_tickets, JSON_NUMERIC_CHECK);

		return $tickets;
	}
}