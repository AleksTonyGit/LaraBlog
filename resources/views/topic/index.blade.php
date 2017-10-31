@extends('layouts.app')
@section('content')
<div class="row-fluid">

	<div class="col-sm-3 col-md-3 col-lg-3 pull-left">
	{!! Form::open(array('action'=>'TopicController@search','class'=>'form')) !!}
	<div class="input-group">
		{!! Form::text('searchform', '', array('class'=>'form-control','placeholder'=>'Enter topic'))!!}
		<span class="input-group-btn">
		<button class="btn btn-basic glyphicon glyphicon-search"
type="submit"></button>
		</span>
	</div>
	{!! Form::close() !!}
	<ul style="list-style-type:none">
	@foreach($topics as $t)
		<li>
			<div class="topic_title">
				<a href="{{url('topic/'.$t->id)}}">{{$t->topicname}}</a>
			</div>

			<div class="del">
				{!! Form::open(array('route'=>['topic.destroy',$t->id],'onsubmit' => 'return ConfirmDelete()')) !!}
				{{ Form::hidden('_method','DELETE')}}
				<button class="btn btn-xs btn-danger  glyphicon glyphicon-trash"  type="submit"></button>
				{!! Form::close() !!}
			</div>

		</li>
	@endforeach
	</ul>
</div>


	<div class="col-sm-6 col-md-9 col-lg-9">
		@if($id !=0)
		@foreach($blocks as $b)
			<div class="block">
				<div class="topic_name">
					<h1> {{$b->title}}</h1>
				</div>
				@if($b->imagepath !="")
					<div class="gallery-item-wrapper">
						<div class="hovergallery">

								<img src="{{asset($b->imagepath)}}" class="image">

						</div>
					</div>
				@endif
				<div class="content">
					{{$b->content }}
				</div>
				<div class="buttons">
					{!! Form::open(['route'=>['block.destroy',$b->id]])  !!}
					{{ Form::hidden('_method','DELETE')}}
					<button class="btn btn-md btn-danger glyphicon glyphicon-trash" type="submit"></button>
					{!! Form::close() !!}

					{!! Form::model($b,['route'=>['block.update',$b->id]]) !!}
					{{ Form::hidden('_method','PUT')}}
					<a class="btn btn-md btn-info glyphicon glyphicon-pencil" href="{{url('block/'.$b->id.'/edit')}}"></a>
					{!! Form::close() !!}
				</div>
			</div>
		
		@endforeach
		@endif
	</div>
</div>
@endsection