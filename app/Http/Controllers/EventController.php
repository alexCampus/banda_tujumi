<?php

namespace App\Http\Controllers;



use App\Services\MailGenerator;
use Illuminate\Http\Request;
use App\EventModel;
use Carbon\Carbon;
use Auth;

class EventController extends Controller
{
    protected $eventModel;

    public function __construct(EventModel $eventModel)
    {
        $this->eventModel = $eventModel;
    }

    public function index()
    {
		$eventsCalendar = [];
		$events         = $this->eventModel->getAllEvents();

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
		$calendar   = \Calendar::addEvents($eventsCalendar)
				->setOptions([ //set fullcalendar options
					'header'      => array('left' => 'prev,next today', 'center' => 'title', 'right' => ''),
		            'editable'    => true,
		            'navLinks'    => true,
		            'selectable'  => false,
		            'defaultView' => 'month',
				]);  //add an array with addEvents

		return view('FO.agenda', array('calendar' => $calendar, 'imageUrl' => 'img/event.JPG'));
	}

	public function formCreate() 
	{
		return view('BO.Event.createEvent');
	}

	public function store(Request $request) 
	{
    	$this->eventModel->title   = $request->input('title');
        $this->eventModel->content = $request->input('content');
    	if ($request->input('fullDay')) {
            $this->eventModel->isDay = $request->input('fullDay');
    	}
        $this->eventModel->start_time      = Carbon::createFromFormat('d/m/Y H:i', $request->input('startTime'))->format('Y-m-d H:i');
        $this->eventModel->end_time        = Carbon::createFromFormat('d/m/Y H:i', $request->input('endTime'))->format('Y-m-d H:i');
        $this->eventModel->backgroundColor = $request->input('color');
        $this->eventModel->categorie 	 	= $request->input('categorie');

    	$this->eventModel->save();

    //	MailGenerator::prestationMail($this->eventModel, $request);

		return redirect('/agenda');
	}

	public function show($id)
	{
		$event       = $this->eventModel->getOneEvent($id);
		$user        = Auth::user();
		$currentDate = Carbon::now();


		if ($event->users->contains($user))
		{
		    if ($user->events->first()->pivot->participe === 1) {
                $bool = 1;
            } else {
		        $bool = 2;
            }

		} else {
			$bool = 0;
		}
		return view('FO.oneEvent', ['event' => $event, 'bool' => $bool, 'currentDate' => $currentDate]);
	}

	public function participe($id, Request $request)
	{
		$saveEvent = $this->eventModel->find($id);
		$user      = Auth::user();

        $saveEvent->users()->save($user, ['participe' => $request->input('participe')]);

		return redirect('/agenda/' . $id);
	}

	public function desinscription($id, Request $request)
	{
		$saveEvent = $this->eventModel->find($id);
		$user      = Auth::user();
		$saveEvent->users()->sync([$user->id =>['participe' => $request->input('participe')]]);
		return redirect('/agenda/' . $id);
	}

	public function updateView($id)
	{
		$event = $this->eventModel->find($id);
		
		return view('BO.Event.createEvent', ['event' => $event]);
	}

	public function update($id, Request $request)
	{
		$event = $this->eventModel->find($id);
		$event->title   = $request->input('title');
    	$event->content = $request->input('content');
    	$event->start_time      = Carbon::createFromFormat('d/m/Y H:i', $request->input('startTime'))->format('Y-m-d H:i');
    	$event->end_time        = Carbon::createFromFormat('d/m/Y H:i', $request->input('endTime'))->format('Y-m-d H:i');
    	$event->backgroundColor = $request->input('color');
    	$event->save();

//        MailGenerator::prestationMail($event, $request);

		return redirect('/admin/adminPrestation');
	}

	public function delete($id, Request $request)
	{
        $event = $this->eventModel->find($id);
        $event->delete();
      //  MailGenerator::prestationMail($event, $request);
        return redirect('/admin/adminPrestation');
	}

}
