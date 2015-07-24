<?php

class EventController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$client = new Google_Client();
		if (!Cache::has('google_calendarId')){
			if (!Cache::has('google_accessToken')){
				App::abort(404, 'Missing Google AccessToken.');
			}

			$client->setClientId(Config::get('app.google.ClientId'));
			$client->setClientSecret(Config::get('app.google.ClientSecret'));
			$client->setRedirectUri(Config::get('app.google.RedirectUri'));
			$client->setAccessToken(Cache::get('google_accessToken'));
			$client->setAccessType('offline');

			if(Input::get('calendarId')) {

				Cache::put('google_calendarId', Input::get('calendarId'), 20140);

			} else {

				$calendar = new Google_Service_Calendar($client);
				$list = $calendar->calendarList->listCalendarList();
				return View::make('select_calendar')->with("list", $list->items);

			}
		}

		$client->setDeveloperKey(Config::get('app.google.ApiKey'));
		$calendar = new Google_Service_Calendar($client);
		$feed = $calendar->events->listEvents(Cache::get('google_calendarId'), array('orderBy' => 'startTime', 'singleEvents' => true));
		$next_feed = $calendar->events->listEvents(Cache::get('google_calendarId'), array('orderBy' => 'startTime', 'singleEvents' => true, 'timeMin' => date("c"), 'maxResults' => 5));
		$locations = array();

		foreach($feed->items as $event){
			$locations[$event->location][] = $event;
		}

		return Response::json($locations);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
