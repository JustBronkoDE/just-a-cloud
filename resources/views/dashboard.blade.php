@extends('layouts.overlay')

@section('content')
<div class="col-xs-12">
	<div class="col-xs-12">
		<div class="panel panel-primary">
			<div class="panel-heading" data-toggle="collapse" data-target="#demo">
				<h2>Willkommen bei deiner Cloud!</h2>
			</div>
			<div class="panel-body collapse" id="demo">
				Moini!
			</div>
		</div>
	</div>
</div>
<div class="col-xs-6">
	<div class="col-xs-12">
		<div class="panel panel-default panel-dashboard">
			<div class="panel-heading">
				Deine Dateien
			</div>
			<div class="panel-body">
				<ul class="list-group">
					@if(count($files))
						@foreach($files as $file)
							<li class="list-group-item"><a href="/files/{{$file->id}}">{{ $file->name }}@if($file->public)<i class="material-icons pull-right">public</i>@endif</a></li>
						@endforeach
					@else
						Es wurden noch keine Dateien hochgeladen, wenn du eine hochladen willst: <a href="/files">hier</a>
					@endif
					
				</ul>
			</div>
			<div class="panel-footer">
				<a href="/files"><i class="material-icons">add</i></a>
			</div>
		</div>
	</div>
	<div class="col-xs-6">
		<div class="panel panel-primary">
			<div class="panel-heading">
				Hochgeladene Dateien
			</div>
			<div class="panel-body" style="text-align: center;">
				<span style="font-size: 32px;font-weight: bold;">{{count($files)}}</span>
			</div>
		</div>
	</div>
	<div class="col-xs-6">
		<div class="panel panel-success">
			<div class="panel-heading">
				Öffentliche Dateien
			</div>
			<div class="panel-body" style="text-align: center;">
				<span style="font-size: 32px;font-weight: bold;">{{count($public_files)}}</span>
			</div>
		</div>
	</div>
</div>
<div class="col-xs-6">
	<div class="col-xs-12">
		<div class="panel panel-default panel-dashboard">
			<div class="panel-heading">
				Alle öffentlichen Benutzer
			</div>
			<div class="panel-body">
				<ul class="list-group">
					@if(count($users))
						@foreach($users as $user)
							<li class="list-group-item"><a href="/users/{{$user->id}}">{{$user->name}}</a></li>
						@endforeach
					@else
						Es wurden keine Benutzer gefunden.
					@endif
					
				</ul>
			</div>
			<div class="panel-footer">
				<a href="#">Lad deine Freunde zu unserer File-Sharing Community ein ...</a>
			</div>
		</div>
	</div>
</div>
@stop