<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventModel extends model implements \MaddHatter\LaravelFullcalendar\Event
{

    protected $dates = ['start', 'end'];
    public $timestamps = false;

    /**
     * Get the event's id number
     *
     * @return int
     */
    public function getId() {
		return $this->id;
	}

    /**
     * Get the event's title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Is it an all day event?
     *
     * @return bool
     */
    public function isAllDay()
    {
        return (bool)$this->all_day;
    }

    /**
     * Get the start time
     *
     * @return DateTime
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Get the end time
     *
     * @return DateTime
     */
    public function getEnd()
    {
        return $this->end;
    }

    public function getAllEvents()
    {
        $events = EventModel::all()->sortByDesc("start_time");
        return $events;
    }

    public function getOneEvent($id)
    {
        $event = EventModel::find($id);
        return $event;
    }

    public function users()
    {
        return $this->belongsToMany('App\User')->withPivot('participe');
    }
}