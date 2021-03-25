@extends('layouts.app')

@section('content')

<div class=container>
  <div class=row>
    <header class="header">
    <a href="{{route('users.matchs', ['user' => Auth::user()->id])}}" class="linkToMatching"></a>
      <div class="col-md-2">
        <div class=" center-block">
          @if(isset($chat_room_user->uploadimages))
  	        <img src="{{ Storage::url($chat_room_user->uploadimages->file_path) }}" style="width:100%;"　alt="写真"/>
          @else
              <i class="fas fa-user-circle fa-3x mr-1"></i>
          @endif
        </div>
        <div class="chatPartner_name">{{ $chat_room_user -> name }}</div>
      </div>
    </header>
    <div class="container">
      <div class="messagesArea messages">
      @foreach($chat_messages as $message)
      <div class="message">
        @if($message->user_id = Auth::id())
          <span>{{Auth::user()->name}}</span>
        @else
          <span>{{$chat_room_user_name}}</span>
        @endif
        
        <div class="commonMessage">
          <div>
          {{$message->message}}
          </div>
        </div>
      </div>
      @endforeach
      </div>
    </div>
  </div>
  <form class="messageInputForm">
    <div class='container'>
      <input type="text" data-behavior="chat_message" class="messageInputForm_input" placeholder="メッセージを入力...">
    </div>
  </form>
</div>

<script>
var chat_room_id = {{ $chat_room_id }};
var user_id = {{ Auth::user()->id }};
var current_user_name = "{{ Auth::user()->name }}";
var chat_room_user_name = "{{ $chat_room_user_name }}";
</script>

@endsection