@extends('layouts.master')

{{-- Web site Title --}}
@section('title')
	Logo - Home
@stop

{{-- Sidebar --}}
@section('sidebar')
    @parent

    <!-- <p>This is appended to the master sidebar.</p> -->
@stop

{{-- Content --}}
@section('content')
    <div class="container">
		<h2><small>Welcome Back {{Sentry::getUser()->first_name}}</small></h2>
		
	</div>
	
	


@stop