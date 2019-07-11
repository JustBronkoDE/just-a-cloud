@extends('layouts.overlay')

@section('content')
	@if(Auth::user()->id === $user->id)
		<div class="col-xs-10 col-xs-offset-1">
			<div class="panel">
				<div class="panel-body">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-3">
							<h2><strong class="media-heading">{{$user->name}} - Bearbeiten</strong></h2>
						</div>
					</div>
				</div>
				
				<form action="/users/{{$user->id}}/profile/update" id="submit_user_edit" method="POST" enctype="multipart/form-data">
					{{ csrf_field() }}
					<div class="col-xs-12">
						<h3>Wie heißt du?</h3>
						<input type="text" name="username" value="{{$user->name}}">

						<h3>Schreib etwas über dich,<br> wir würden gerne mehr über dich erfahren!</h3>
						<textarea name="description" style="width: 70%;height: 250px;resize: none;">{{$user->description}}</textarea>
						
						<h3>Möchtest du dein Profil veröffentlichen?</h3>
						<!-- Rounded switch -->
			            @if($user->public)
                                <label class="switch">
                                  <input type="checkbox" name="profile_public" checked="TRUE">
                                  <span class="slider round"></span>
                                </label>
                            @else
                                <label class="switch">
                                  <input type="checkbox" name="profile_public">
                                  <span class="slider round"></span>
                                </label>
                            @endif 
					</div>
					<div class="col-xs-12">
						<h3>Lade ein schickes Bild von dir hoch.</h3>
						<div class="col-xs-12 well">
			                <label for="file">Datei hochladen</label>
			                <input type="file" id="upload_pic" name="profile_pic">
			                <img src="#" id="profile_pic_preview" class="pull-right" height="100px">
			            
						</div>
					</div>
 					<div class="col-xs-12">
 						<input type="submit" class="button success" name="submit">
 						<a class="button danger pull-right" href="/users/{{$user->id}}">Abbrechen</a>
					</div>
 					
				</form>
				</div>
			</div>
		</div>
		@else
			<div style="width: 100%;text-align: center;">
				<h1>Error: 403</h1>
				<iframe src="https://giphy.com/embed/njYrp176NQsHS" width="480" height="200" frameBorder="0" class="giphy-embed" allowFullScreen></iframe>
			</div>
		@endif

@endsection