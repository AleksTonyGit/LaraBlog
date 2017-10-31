@extends('layouts.app')
@section('content')



@if(count(session('errors')) > 0)
	<div class="alert alert-danger">
		@foreach(session('errors')->all() as $er)
			{{$er}}<br/>
		@endforeach
	</div>
@endif

@if(session('message'))
	<div class="alert alert-success" >
		{{session('message')}}
	</div>
@endif

{!! Form::model($topic, array('action'=>'TopicController@store')) !!}
	<div class='form-group'>
		{!! Form::label('topicname','Topic name')!!}
		{!! Form::text('topicname', '', array('class'=>'form-control'))!!}
	</div>
	<button class="btn btn-success" type="submit">Add Topic</button>
{!! Form::close() !!}

@endsection