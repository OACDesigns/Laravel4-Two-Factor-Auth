@extends('layouts.master')

{{-- Web site Title --}}
@section('title')
Log In
@stop

{{-- Content --}}
@section('content')
<div class="container">
    <div class="col-md-4 col-md-offset-4 well">
        {{ Form::open(array('action' => 'LoginController@login')) }}

            <h2>Sign In</h2>
			
			<!-- if there are any general login errors, show them here -->
			@if ( $errors->has('general') )
			<div class="alert alert-danger">{{ ($errors->has('general') ? $errors->first('general') : '') }}</div>
			@endif

            <div class="form-group {{ ($errors->has('email')) ? 'has-error' : '' }}">
                {{ Form::text('email', null, array('class' => 'form-control', 'placeholder' => 'Email', 'autofocus')) }}
                {{ ($errors->has('email') ? $errors->first('email') : '') }}
            </div>

            <div class="form-group {{ ($errors->has('password')) ? 'has-error' : '' }}">
                {{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Password'))}}
                {{ ($errors->has('password') ?  $errors->first('password') : '') }}
            </div>
			
            <div class="form-group {{ ($errors->has('password2')) ? 'has-error' : '' }}">
				<label>Two-Stage Auth</label>
                {{ Form::password('password2', array('class' => 'form-control', 'placeholder' => 'Password 2'))}}
                {{ ($errors->has('password2') ?  $errors->first('password2') : '') }}
            </div>
            
            <label class="checkbox">
                {{ Form::checkbox('rememberMe', 'rememberMe') }} Remember me
            </label>
            {{ Form::submit('Sign In', array('class' => 'btn btn-primary'))}}
            <a class="btn btn-link" href="{{ route('login') }}">Forgot Password</a>
        {{ Form::close() }}
    </div>
</div>

@stop