@extends('layouts.overlay')

@section('content')
	
	<div class="col-xs-10 col-xs-offset-1">
		@if($user->public || Auth::user()->id === $user->id)
			<div class="panel">
				<div class="panel-body">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<h2><strong class="media-heading">{{$user->name}}</strong></h2>
						</div>
					</div>
					<div>
						<div class="col-xs-3">
							
						</div>
						<div class="col-xs-9">
							<h4>Öffentliche Dateien:</h4>
						</div>
					</div>
				<div class="col-xs-3 text-justify">
					@if(Auth::user()->id === $user->id)
						<div class="profile-edit" style="position: relative;">
							<img src="{{$user->getProfilePic()}}" width="100%">
							<div style="position: absolute;bottom: 0;width: 100%;padding: 5px;padding-top: 10px;background: rgba(0, 0, 0, 0.2);"><a class="pull-right" href="/users/{{ $user->id }}/profile/edit"><i class="material-icons">create</i></a></div>
						</div>
					@else
						<img src="{{$user->getProfilePic()}}" width="100%">
					@endif
					

					<h4 style="margin-top: 35px;">Über mich:</h4>
					@if($user->description === "")
						<p>Ich bin etwas schüchtern, aber ich bin eine liebenswerte Person.</p>
					@else 
						<p>{{ $user->description }}</p>
					@endif
				</div>
				<div class="col-xs-9">
					<ul class="list-group inDashboard" style="height: 600px;overflow-y: auto;">
						@if(count($files))
						@foreach($files as $file)
							<li class="list-group-item">
			                    @if($file->type == 'image')
			                        <i class="material-icons" title="image">image</i>
			                    @elseif($file->type == 'compressed_file')
			                        <i class="material-icons" title="compressed file">folder</i>
			                    @elseif($file->type == 'code')
			                        <i class="material-icons" title="code">code</i>
			                    @elseif($file->type == 'audio')
			                        <i class="material-icons" title="audio/music">music_note</i>
			                    @elseif($file->type == 'video')
			                        <i class="material-icons" title="video">movie_creation</i>
			                    @else
			                        <i class="material-icons" title="unknown">attachment</i>
			                    @endif

			                    <a href="/files/{{ $file->id }}">{{ $file->name }}</a>
			                    <div class="list-group-button">
			                        @if($file->public) 
			                            <i class="material-icons" title="public">public</i>
			                        @endif
			                        <a  href="/cloud/download/{{ $file->id }}" 
			                            title="download {{ $file->name }}" 
			                            onclick="addToast('<i class=\'material-icons\'>file_download</i>  {{  $file->name  }}',4000,'success')"><i class="material-icons">cloud_download</i></a>
			                    </div>
			                </li>
						@endforeach
						@else
							Keine öffentlichen Dateien gefunden
						@endif
					</ul>
				</div>
				</div>
			</div>
		@else
			<div class="text-center">
				<h2>Sorry Diggi, aber ich hätte gerne Privatsphäre.</h2>
				<iframe src="https://giphy.com/embed/U79BWKYZm0ufC" width="480" height="320" frameBorder="0" class="giphy-embed" allowFullScreen></iframe><p>Dieses Meme passt zwar nicht perfekt, aber trotzdem ist es gut!</p>
			</div>
		@endif
		</div>

@endsection