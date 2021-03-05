@extends('layouts.app')

@section('title', 'ユーザー詳細画面')

@section('content')

<div class=container>
    <div class=row>
        <div class="col-md-4">
        @if(isset($image))
          <div>
            <!-- php artisan storage:linkが必要-->  
            <img src="{{ Storage::url($image->file_path) }}" style="width:100%;"　alt="写真"/>
          </div>
         @else
         @endif
        </div>
    

        <div class=" col-md-8">
            <h4>名前: {{ $user->name }}</h4>
	        <h5>年齢: {{ $user->age }}</h5>
	        <h5>性別: {{ $user->gender_label }}</h5>
	        {{-- ユーザー編集フォーム --}}
            {!! Form::model($user, ['route' => ['users.edit', $user->id], 'method' => 'get']) !!}
            {!! Form::submit('編集', ['class' => 'btn btn-success btn-sm']) !!}
            {!! Form::close() !!}
            
        </div>
    </div>
</div>

@endsection
