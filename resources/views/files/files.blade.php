@extends('layouts.overlay')

@section('content')

<div class="col-xs-12">
    <div class="panel panel-default">
        <div class="panel-heading">{{ Auth::user()->name }} - Dateien</div>
        <div class="panel-body">
            <ul class="list-group inDashboard">
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
                        <form action="/cloud/delete/{{ $file->id }}" method="POST">
                            {{ csrf_field() }}
                            <input type="submit" class="list-group-button material-icons" value="clear">
                        </form>
                    </div>
                </li>
                @endforeach
            </ul>
            <form class="well" action="/cloud/store" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <label for="file">Datei hochladen</label>
                <input type="file" style="margin: 15px 0 20px 0;" name="files[]" multiple>
                <input type="submit" name="btn[upload]" class="button material-icons" value="cloud_upload">
            </form>
        </div>
    </div>
</div>
@endsection
