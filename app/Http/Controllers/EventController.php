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
					'color' => $event->backgroundColor,
					
				] //optionally, you can specify an event ID
			);
		}
		// dump($eventsCalendar);die; 
		$calendar   = \Calendar::addEvents($eventsCalendar)
				->setOptions([ //set fullcalendar options
					'header'      => array('left' => 'prev,next today', 'center' => 'title', 'right' => ''),
		            'editable'    => true,
		            'navLinks'    => true,
		            'selectable'  => false,
		            'defaultView' => 'month',
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
    	$event->categorie 	 	= $request->input('categorie');


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

	public function updateView($id)
	{

		$event = EventModel::find($id);
		
		return view('createEvent', ['event' => $event]);
	}

	public function update($id, Request $request)
	{
		$event = EventModel::find($id);
		$event->title   = $request->input('title');
    	$event->content = $request->input('content');
    	$event->start_time      = Carbon::createFromFormat('d/m/Y H:i', $request->input('startTime'))->format('Y-m-d H:i');
    	$event->end_time        = Carbon::createFromFormat('d/m/Y H:i', $request->input('endTime'))->format('Y-m-d H:i');
    	$event->backgroundColor = $request->input('color');
    	$event->save();	
		return redirect('/agenda');
	}


}
