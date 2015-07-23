<?php

class CalendarController extends \BaseController {

	public function weather()
	{
		$yr = Yr\Yr::create("Norge/Østfold/Fredrikstad/Gamlebyen", "/tmp");
		$forecast = $yr->getCurrentForecast();
		return View::make('weather')->with("forecast", $forecast);
	}

	public function other_stages()
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

		foreach($locations as $id => $events){
			asort($locations[$id]);
		}

		return View::make('other_stages')->with("locations", $locations)->with("items", $next_feed->items);
	}

	public function index()
	{
		return View::make('reveal')->with("md5sum", md5_file(app_path().'/views/reveal.blade.php'));
	}

	public function __index()
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

		foreach($locations as $id => $events){
			asort($locations[$id]);
		}

		return View::make('display')->with("locations", $locations)->with("items", $next_feed->items);
	}

	public function authenticate()
	{

		$client = new Google_Client();
		$client->setClientId(Config::get('app.google.ClientId'));
		$client->setClientSecret(Config::get('app.google.ClientSecret'));
		$client->setRedirectUri(Config::get('app.google.RedirectUri'));
		#$client->addScope(Google_Service_Calendar::CALENDAR);

		$client->setScopes('https://www.googleapis.com/auth/calendar.readonly');
		$client->setAccessType('offline');

		$authUrl = $client->createAuthUrl();
		return Redirect::to($authUrl);
	}

	public function oauth2callback(){
		if (isset($_GET['code'])) {
			$client = new Google_Client();
			$client->setClientId(Config::get('app.google.ClientId'));
			$client->setClientSecret(Config::get('app.google.ClientSecret'));
			$client->setRedirectUri(Config::get('app.google.RedirectUri'));
			$client->authenticate($_GET['code']);
		  	Cache::put('google_accessToken', $client->getAccessToken(), 20160); // Two weeks
 			return Redirect::to('/');
		}
		
	}

}
