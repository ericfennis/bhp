<?php

namespace App\Http\Controllers;

use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Google_Service_Calendar_EventDateTime;
use Illuminate\Http\Request;

class gCalendarController extends Controller
{
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
}	