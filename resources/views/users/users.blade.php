@extends('layouts.overlay')

@section('content')
	<div class="col-xs-12" style="margin-top: 50px;">
 		<div class=" panel panel-primary" style="text-align: center;">
 			<div class="panel-heading">
 				<h2>Unsere Community</h2>
 			</div>
 			<div class="panel-body">
				<span style="font-size: 16px;"> Öffentliche Benutzer: <strong>{{count($users)}}</strong></span><br>
				<span style="font-size: 16px;"> Hochgeladene öffentliche Dateien: <strong>{{$public_count}}</strong></span>
				@if(count($users))
					<div class="search col-xs-12">
						<input type="text" class="search" id="user_search" name="search" placeholder="suchen...">
						<i class="material-icons">search</i>
					</div>
				@endif
			</div>
 		</div>
 	</div>
	@if(!count($users))
		<div class="col-xs-12" style="text-align: center;">
			<div class="row">
				<!-- Spongebob coffee alone -->
				<iframe src="https://giphy.com/embed/ISOckXUybVfQ4" width="480" height="324" frameBorder="0" class="giphy-embed" allowFullScreen></iframe>
			</div>
			<div class="row">
				<strong>Entschuldigung, aber es gibt keine öffentlichen Nutzer.</strong><br>
				Ich würde sagen du bist recht einsam :(
			</div>
		</div>
	@else
		
		<div class="user_list col-xs-12">
		  	<table class="table table-hover">
		    	<thead>
			      	<tr>
				        <th></th>
				        <th>Name</th>
				        <th>Dateien</th>
				        <th>Mitglied seit</th>
			    	</tr>
		    	</thead>
		    	<tbody class="users" id="users" style="background-color: #fff;">
				 	@foreach($users as $user)
				 		<tr class='clickable-row' data-href='/users/{{$user->id}}'>
				 			<td><img class="img-circle" style="height: 50px" src="{{ url($user->getProfilePic()) }}"></td>
							<td class="name">{{$user->name}}</td>
							<td>{{count($user->publicFiles())}}</td>
							<td><span class="badge">Seit: {{ $user->created_at }}</span></td>
						</tr>
				 	@endforeach
		 		</tbody>
		 	</table>
	 	</div>
 	@endif
@endsection