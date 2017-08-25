<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EventModel;
use Carbon\Carbon;
use Auth;

class EventController extends Controller
{
	public function index() {
		$eventsCalendar = [];

		// $events[] = \Calendar::event(
		//     'Event One', //event title
		//     false, //full day event?
		//     '2017-07-31T1000', //start time (you can also use Carbon instead of DateTime)
		//     '2017-07-31T1200', //end time (you can also use Carbon instead of DateTime)
		// 	0 //optionally, you can specify an event ID
		// );

		// $events[] = \Calendar::event(
		//     "Valentine's Day", //event title
		//     true, //full day event?
		//     new \DateTime('2017-07-14'), //start time (you can also use Carbon instead of DateTime)
		//     new \DateTime('2017-07-14'), //end time (you can also use Carbon instead of DateTime)
		// 	1,
		// 	[
		// 		'url' => 'http://google.com'
		// 	] //optionally, you can specify an event ID
		// );

		// $eloquentEvent = $events; //EventModel implements MaddHatter\LaravelFullcalendar\Event
		$eventModel = new EventModel;
		$events     = $eventModel->getAllEvents();
		foreach ($events as $event) {
			$eventsCalendar[] = \Calendar::event(
			    $event->title, //event title
			    $event->isDay, //full day event?
			    $event->start_time, //start time (you can also use Carbon instead of DateTime)
			    $event->end_time, //end time (you can also use Carbon instead of DateTime)
				$event->id,
				[
					'url'   => '/agenda/' . $event->id,
					'color' => $event->backgroundColor
				] //optionally, you can specify an event ID
			);
		}
		// dump($eventsCalendar);die; 
		$calendar   = \Calendar::addEvents($eventsCalendar)
				->setOptions([ //set fullcalendar options
			'header' => array('left' => 'prev,next today', 'center' => 'title', 'right' => ''),
            'editable'=> true,
            'navLinks'=> true,
            'selectable'  => true,
            'defaultView' => 'month'
	]);  //add an array with addEvents
		    


		return view('agenda', array('calendar' => $calendar, 'imageUrl' => 'img/event.JPG'));
	}

	public function formCreate() 
	{
		return view('createEvent');
	}

	public function store(Request $request) 
	{
		$event = new EventModel;
    	$event->title   = $request->input('title');
    	$event->content = $request->input('content');
    	if ($request->input('fullDay')) {
    		$event->isDay = $request->input('fullDay');
    	}
    	$event->start_time      = Carbon::createFromFormat('d/m/Y H:i', $request->input('startTime'))->format('Y-m-d H:i');
    	$event->end_time        = Carbon::createFromFormat('d/m/Y H:i', $request->input('endTime'))->format('Y-m-d H:i');
    	$event->backgroundColor = $request->input('color');
    	$event->save();	
		return redirect('/agenda');
	}

	public function show($id)
	{
		$eventModel = new EventModel;
		$event = $eventModel->getOneEvent($id);
		$user  = Auth::user();
		if ($event->users->contains($user))
		{
  			$bool = true;

		} else {
			$bool = false;
		}
		return view('oneEvent', ['event' => $event, 'bool' => $bool]);
	}

	public function participe($id)
	{
		$saveEvent = EventModel::find($id);
		$user      = Auth::user();
		$saveEvent->users()->save($user);
		return redirect('/agenda/' . $id);
	}

	public function desinscription($id)
	{
		$saveEvent = EventModel::find($id);
		$user      = Auth::user();
		$saveEvent->users()->detach($user);
		return redirect('/agenda/' . $id);
	}


}
