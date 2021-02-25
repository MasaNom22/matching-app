@extends('layouts.app')

@section('title', 'ユーザー詳細画面')

@section('content')

<div class=container>
    <div class=row>
        <div class="col-md-4">
          <div>
            <!-- php artisan storage:linkが必要-->  
            <img src="{{ Storage::url($image->file_path) }}" style="width:100%;"　alt="写真"/>
          </div>
          
        </div>
    

        <div class=" col-md-8">
            <h4>名前: {{ $user->name }}</h4>
	        <h5>年齢: {{ $user->age }}</h5>
	        <h5>性別: {{ $user->gender }}</h5>
        </div>
    </div>
</div>

@endsection
