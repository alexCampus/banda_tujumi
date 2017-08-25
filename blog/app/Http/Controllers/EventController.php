<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EventModel;
class EventController extends Controller
{
	public function index() {
		$events = [];

		$events[] = \Calendar::event(
		    'Event One', //event title
		    false, //full day event?
		    '2017-07-31T1000', //start time (you can also use Carbon instead of DateTime)
		    '2017-07-31T1200', //end time (you can also use Carbon instead of DateTime)
			0 //optionally, you can specify an event ID
		);

		$events[] = \Calendar::event(
		    "Valentine's Day", //event title
		    true, //full day event?
		    new \DateTime('2017-07-14'), //start time (you can also use Carbon instead of DateTime)
		    new \DateTime('2017-07-14'), //end time (you can also use Carbon instead of DateTime)
			1,
			[
				'url' => 'http://google.com'
			] //optionally, you can specify an event ID
		);

		$eloquentEvent = $events; //EventModel implements MaddHatter\LaravelFullcalendar\Event

		$calendar = \Calendar::addEvents($events)
				->setOptions([ //set fullcalendar options
			'header' => array('left' => 'prev,next today', 'center' => 'title', 'right' => ''),
            'editable'=> true,
            'navLinks'=> true,
            'selectable'  => true,
            'defaultView' => 'month'
	])->setCallbacks([ //set fullcalendar callback options (will not be JSON encoded)
        'viewRender' => 'function() {alert("Callbacks!");}'
    ]);  //add an array with addEvents
		    


		return view('agenda', array('calendar' => $calendar, 'imageUrl' => 'img/event.JPG'));
	}
}
