@extends('layouts.overlay')

@section('content')

<div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default">
        <div class="panel-heading">{{ Auth::user()->name }} - {{ $file->name }}</div>
        <div class="panel-body">
            <ul class="list-group">
                <li class="list-group-item">
                    <h2>{{ $file->name }}</h2>
                </li>
                <li class="list-group-item">
                    <h4>Besitzer</h4>
                    <p> <strong>Name: </strong>{{ $file->user->name }}<br>
                    <strong>E-Mail: </strong>{{ $file->user->email }}</p>
                </li>
                <li class="list-group-item">
                    <h4>Datei herunterladen:</h4>
                    <a  href="/cloud/download/{{ $file->id }}" 
                            title="download {{ $file->name }}" 
                            onclick="addToast('<i class=\'material-icons\'>file_download</i>  {{  $file->name  }}',4000,'success')">https://cloud.productive-music.de/cloud/download/{{ $file->id }}</a>
                <li class="list-group-item">
                    <h4>Inhalt:</h4>
                    @if($file->type === 'image')
                        <img src="/cloud/download/{{$file->id}}" width="500px">
                    @endif
                    @if($file->type === 'video')
                        <video width="320" height="240" controls>
                            <source src="/cloud/download/{{$file->id}}" type="video/mp4"></video>
                        </video>
                    @endif
                    @if($file->type === 'audio')
                        <audio width="320" height="240" controls>
                            <source src="/cloud/download/{{$file->id}}" type="audio/mp3"></video>
                        </audio>
                    @endif
                    @if($file->type === 'code')
                        <pre>{{ print_r($code) }}</pre>
                    @endif
                </li>
                @if(Auth::user()->id === $file->user->id)
                    <li class="list-group-item"> 
                        <form id="public" method="POST" action="/files/{{ $file->id }}/public/toggle"">
                            {{ csrf_field() }}
                            <h4>Öffentlich:</h4>
                            @if($file->public)
                                <label class="switch">
                                  <input id='public_toggle' type="checkbox" name="public" checked="TRUE">
                                  <span class="slider round"></span>
                                </label>
                            </form>
                            @else
                                <label class="switch">
                                  <input id='public_toggle' type="checkbox" name="private">
                                  <span class="slider round"></span>
                                </label>
                            @endif 
                        </form>
                    </li>
                    <li class="list-group-item">
                        <form action="/cloud/delete/{{ $file->id }}" method="POST">
                            {{ csrf_field() }}
                            <button class="button danger" type="submit">Löschen</button>
                        </form>
                    </li>
                @endif
            </ul>
            <a href="{{ url()->previous() }}" class="button pull-right"><i class="glyphicon glyphicon-chevron-left"></i>Zurück</a>
        </div>
    </div>
</div>
@endsection
