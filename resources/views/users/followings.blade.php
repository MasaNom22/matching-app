@extends('layouts.app')

@section('title', 'フォローユーザ一覧画面')

@section('content')
        <div>
        <h2>フォローユーザー一覧画面</h2>
        <h2>{{ $user->name}}さんのフォローユーザー数：{{ $user->followings_count }}名</h2>
        </div>

<div class=container>
    <div class=row>

        @foreach($users as $user)
        <div style="" class="col-md-3 mt-4 mb-4">
            <h4>名前: {{ $user->name }}</h4>
	        <h5>年齢: {{ $user->age }}</h5>
	        <h5>性別: {{ $user->gender_label }}</h5>
	        @if(isset($user->uploadimages))
	        <img src="{{ Storage::url($user->uploadimages->file_path) }}" style="width:100%;"　alt="写真"/>
            @else
            @endif
            @if (Auth::id() != $user->id)
                @if (Auth::user()->is_following($user->id))
                    {{-- アンフォローボタンのフォーム --}}
                    {!! Form::open(['route' => ['users.unfollow', $user->id], 'method' => 'delete']) !!}
                        {!! Form::submit('フォローを外す', ['class' => "btn btn-primary btn-block"]) !!}
                    {!! Form::close() !!}
                @else
                    {{-- フォローボタンのフォーム --}}
                    {!! Form::open(['route' => ['users.follow', $user->id]]) !!}
                        {!! Form::submit('フォローする', ['class' => "btn btn-primary btn-block"]) !!}
                    {!! Form::close() !!}
                @endif
            @endif
        </div>
        @endforeach
        <div style="" class="col-md-3 mt-4 mb-4">

        </div>
    </div>
</div>
@endsection