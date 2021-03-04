@extends('layouts.app')

@section('title', 'ユーザ一覧画面')

@section('content')

<div class=container>
    <div class=row>
        @foreach($users as $user)
        <div style="" class="col-md-3 mt-4 mb-4">
            <h4>名前: {{ $user->name }}</h4>
	        <h5>年齢: {{ $user->age }}</h5>
	        <h5>性別: {{ $user->gender }}</h5>
	        @if(isset($user->uploadimages))
	        <img src="{{ Storage::url($user->uploadimages->file_path) }}" style="width:100%;"　alt="写真"/>
            @else
            @endif
        </div>
        @endforeach
    </div>
</div>
@endsection