<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon -->
    <link rel="icon"
            type="image/ico"
            href="media/cloud.ico" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- Icons -->
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <link href="{{ asset('css/collection.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    @yield('css')
</head>
<body class="overlay">
    <nav class="dashboard-nav">
        <div class="top">
            <div class="user">
                <span class="name">
                    <a href="/users/{{ Auth::user()->id }}">{{ Auth::user()->name }}</a>
                </span>
                <a href="/users/{{ Auth::user()->id }}" class="img-circle" style="overflow: hidden;width: 50px;height: 50px;">
                    <img src="{{Auth::user()->getProfilePic()}}">
                </a>
            </div>
        </div>
        <div class="left">
            <div class="header">
                <div id="nav-toggle" style="padding: 10px;">
                    <img src="/media/cloud.ico">
                    Productive
                </div>
            </div>
            <div class="active">
                <img src="/media/background.jpg">
                <div class="activeSite">
                    Übersicht
                </div>
            </div>
            <ul>
                <li class="nav-heading">Cloud Services</li>
                <li>
                    <ul class="nav-group">
                        <li {{ URL::current() === URL::to('/home') ? 'class=active' : '' }}><a href="/home" class="wave"><i class="glyphicon glyphicon-home"></i><span>Übersicht</span></a></li>
                        <li {{ URL::current() === URL::to('/files') ? 'class=active' : '' }}><a href="/files" class="wave"><i class="glyphicon glyphicon-cloud"></i><span>Dateien</span></a></li>
                        <li {{ URL::current() === URL::to('/users') ? 'class=active' : '' }}><a href="/users" class="wave"><i class="glyphicon glyphicon-heart"></i><span>Sozial</span></a></li>
                        <li><a data-toggle="modal" data-target="#myModal" class="wave"><i class="glyphicon glyphicon-cog"></i><span>Einstellungen</span></a></li>
                    </ul>
                </li>
                <li class="divider"></li>
                <li class="nav-heading">Applications</li>
                <li>
                    <ul class="nav-group">
                        <li><a data-toggle="modal" data-target="#myModal" class="wave"><i class="glyphicon glyphicon-info-sign"></i><span>Information</span></a></li>
                        <li><a  href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                <i class="glyphicon glyphicon-log-out"></i><span>Abmelden</span>
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

    <main class="container-fluid">
        <div class="col-xs-12">

            @yield('content')
        
        </div>
    </main>

    <!-- Chatbox -->
    <div class="chatbox hide-chat" id="chatBox" data-lastChatUpdate="{{ $date }}">
        <button id="hide-button"><i class="material-icons">chat</i></button>
        <div class="left">
            <div class="top">
                <input id="chatUsersSearch" type="text" name="newChat" placeholder="John Doe" data-toggle="dropdown">
                <ul class="dropdown-menu" id="chatUsersList">
                    <!-- CHAT USERS -->
                    <li><a disabled style="color:#e7e7e7;">Keine Suchergebisse</a></li>
                </ul>
            </div>
            <ul class="people" id="peopleBox">
                @foreach($chats as $chat)
                    <li class="person" data-chat="{{ $chat->id }}">
                        @if(1 === count($chat->getMembers()))
                            <img src="{{$chat->getMembers()[0]->getProfilePic()}}" alt="" />
                            <span class="name">{{$chat->getMembers()[0]->name}}</span>
                        @endif
                        @if(1 > count($chat->getMembers()))
                            <!-- loop @todo implement group chats -->
                        @endif
                        <span class="time">{{count($chat->messages) ? date_format($chat->messages->last()->created_at, 'H:i') : '-:-'}}</span>
                        <span class="preview"> {{count($chat->messages) ? $chat->messages->last()->content : 'Neuer Chat...'}} </span>
                    </li> 
                @endforeach
            </ul>
        </div>
        <div class="right">
            <div class="top"><span>To: <span class="name"> No One</span></span></div>
            <div id="chattingBox">
               @foreach($chats as $chat)
                    <div class="chat" data-chat="{{$chat->id}}">
                        <div class="conversation-start">
                                <span>Heute</span>
                        </div>
                        @if(count($chat->messages))
                            @foreach($chat->messages as $message)
                                @if (Auth::user()->id === $message->user_id)
                                    <div class="bubble me">
                                        {{ $message->content }}
                                    </div>
                                @else
                                    <div class="bubble you">
                                        {{ $message->content }}
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    </div>
                @endforeach 
            </div>
            

            <div class="write">
                <form name="chat" action="">
                    <a class="write-link attach"><i></i></a>
                    <input type="text" name="message" id="chatMessage" autocomplete="off"/>
                    <input type="hidden" name="chat"  id="chat" value="">
                    <a class="write-link smiley" id="test"><i></i></a>
                    <a class="write-link send" id="chatSubmit"></a>
                </form>
            </div>
        </div>
    </div>

    <!-- Settings Modal -->
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Settings-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Cloud Einstellungen</h4>
          </div>
          <div class="modal-body">
            <!-- Rounded switch -->
            <label class="switch">
                <input type="checkbox">
                <span class="slider round"></span>
            </label>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
          </div>
        </div>

      </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <!-- Bootstrap -->
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- Own Javascript -->
    <script type="text/javascript" src="{{ asset('js/collection.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/chat.js') }}"></script>
    @yield('javascript')
    <script type="text/javascript" src="{{ asset('js/custom.js')}} "></script>
</body>
</html>