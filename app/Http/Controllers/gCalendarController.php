<?php

namespace App\Http\Controllers;

use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Google_Service_Calendar_EventDateTime;
use Illuminate\Http\Request;

class gCalendarController extends Controller
{
    protected $client;

    // public function __construct()
    // {
    //     $client = new Google_Client();
    //     $client->setAuthConfig('client_secret.json');
    //     $client->addScope(Google_Service_Calendar::CALENDAR_READONLY);

    //     $guzzleClient = new \GuzzleHttp\Client(array('curl' => array(CURLOPT_SSL_VERIFYPEER => false)));
    //     $client->setHttpClient($guzzleClient);
    //     $this->client = $client;
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Google_Service_Calendar $client)
    {
            $calendarId = 'primary';

            $optParams = array(
			  'maxResults' => 3,
			  'orderBy' => 'startTime',
			  'singleEvents' => TRUE,
			  'timeMin' => date('c'),
			);
			$results = $client->events->listEvents($calendarId,$optParams);

            //return $results->getItems(); //get items array

            if (count($results->getItems()) == 0) {
			  print "No upcoming events found.\n";
			} else {
			  print "Upcoming events:\n";
			  foreach ($results->getItems() as $event) {
			    $start = $event->start->dateTime;
			    if (empty($start)) {
			      $start = $event->start->date;
			    }
			    printf("%s (%s)\n", $event->getSummary(), $start);
			  }
			}

            // $calendarList = $client->calendarList->listCalendarList();
            // dd($calendarList->getItems());

    }

    public function getEvents(Google_Service_Calendar $client)
    {
            date_default_timezone_set('Europe/Amsterdam');
			$calendarId = 'primary';

			$optParams = array(
			  'maxResults' => 3,
			  'orderBy' => 'startTime',
			  'singleEvents' => true,
			  'timeMin' => date('c'),
			);

			$gCalendar = $client->events->listEvents($calendarId,$optParams);
			$results = array();
			foreach ($gCalendar as $ev) {

				$start = $ev->start->dateTime;
			    if (empty($start)) {
			      $start = $ev->start->date;
			    }
			    $timestamp = strtotime($start);

				$event = array(
					'title' => $ev->getSummary(),
					'desc'	=> $ev->getDescription(),
					'date' => date('d M',$timestamp),
					'time' => date('H.i',$timestamp),
					);
				array_push($results, $event);
			}
           
            return $results;


    }

    public function oauth()
    {
        session_start();

        $rurl = action('gCalendarController@oauth');
        $this->client->setRedirectUri($rurl);
        if (!isset($_GET['code'])) {
            $auth_url = $this->client->createAuthUrl();
            $filtered_url = filter_var($auth_url, FILTER_SANITIZE_URL);
            return redirect($filtered_url);
        } else {
            $this->client->authenticate($_GET['code']);
            $_SESSION['access_token'] = $this->client->getAccessToken();
            return redirect()->route('calendar.index');
        }
    }
    /**
     * Display the specified resource.
     *
     * @param $eventId
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function show($eventId)
    {
        session_start();
        if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
            $this->client->setAccessToken($_SESSION['access_token']);

            $service = new Google_Service_Calendar($this->client);
            $event = $service->events->get('primary', $eventId);

            if (!$event) {
                return response()->json(['status' => 'error', 'message' => 'Something went wrong']);
            }
            return response()->json(['status' => 'success', 'data' => $event]);

        } else {
            return redirect()->route('oauthCallback');
        }
    }

}	