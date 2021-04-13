@extends('layouts.app1')

@section('title', 'チャット画面')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card">
        <div class="card-header">
            @if(isset($chat_room_user->uploadimages))
            <img src="{{ Storage::url($chat_room_user->uploadimages->file_path) }}" style="width:10%;"　alt="写真">
            @else
            <i class="fas fa-user-circle fa-3x mr-1"></i>
            @endif
            {{ $chat_room_user -> name }}さん
        </div>
          <div class="card-body">
            <div class="messagesArea messages">
              @foreach($chat_messages as $message)
                  @if($message->user_id == Auth::id())
                  <div class="" style="text-align:left">
                    <p>
                      @if(isset(Auth::user()->uploadimages))
                      <img src="{{ Storage::url(Auth::user()->uploadimages->file_path) }}" style="width:10%;" class="iconImgTalk" alt="写真">
                      @else
                      <i class="fas fa-user-circle fa-3x mr-1"></i>
                      @endif
                      {{Auth::user()->name}}さん</p>
                    <p>{{$message->message}}</p>
                  </div>
                  @else
                    <div class="" style="text-align:right">
                      <p>
                        @if(isset($chat_room_user->uploadimages))
                        <img src="{{ Storage::url($chat_room_user->uploadimages->file_path) }}" style="width:10%;" class="iconImgTalk" alt="写真">　{{$chat_room_user_name}}さん</p>
                        @else
                        <i class="fas fa-user-circle fa-3x mr-1"></i>
                        @endif
                      <p>{{$message->message}}</p>
                    </div>
                  @endif
              @endforeach
            </div>
            <form class="messageInputForm" style="text-align:center">
            <div class='container'>
              <input type="text" data-behavior="chat_message" class="messageInputForm_input" style="width:50%;" placeholder="メッセージを入力... (Enter key please)">
              <i class="fas fa-paper-plane fa-x "></i>
            </div>
          </form>
          </div>
      </div>
    </div>
  </div>
</div>

<script>
var chat_room_id = {{ $chat_room_id }};
var user_id = {{ Auth::user()->id }};
var current_user_name = "{{ Auth::user()->name }}";
var chat_room_user_name = "{{ $chat_room_user_name }}";
</script>

@endsection