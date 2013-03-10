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
		$data->assigned			= Ticket::where_assigned_to(Session::get('id'))->where_status('open')->take(10)->order_by('id', 'desc')->get();
		$data->latest			= Ticket::take(10)->order_by('id', 'desc')->get();

		// numbers
		$data->totalAssigned	= Ticket::where_assigned_to(Session::get('id'))->where_status('open')->count();
		$data->total			= Ticket::count();
		$data->open				= Ticket::where_status('open')->count();

		// what badge should we display in assigned?
		if ($data->totalAssigned == 0): $data->badge = 'success'; else: $data->badge = 'important'; endif;

		// output view and send all the data
		return View::make('dashboard.index')->with('data', $data);
	}
}