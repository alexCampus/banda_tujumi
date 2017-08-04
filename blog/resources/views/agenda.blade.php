@extends('layout.app')

@section('content')
	<h1>Agenda</h1>
	{!! $calendar->calendar() !!}
    {!! $calendar->script() !!}
@endsection