@extends('layouts.app')

@section('title', 'トップページ')

@section('content')

<div class="container mt-4">
  <div class="row d-flex justify-content-center">
    <div class="row col-md-12">
      <aside class="col-3 d-none d-md-block position-fixed">
        <div style="" class="">
          @if(isset(Auth::user()->uploadimages))
          <a href="{{ route('users.show', ['user' => Auth::user()]) }}" class="text-dark">
	        <img class="user-icon rounded-circle" src="{{ Storage::url(Auth::user()->uploadimages->file_path) }}" style="width:100%;"　alt="写真"/>
	        </a>
            @else
            <a href="{{ route('users.show', ['user' => Auth::user()]) }}" class="text-dark">
            <i class="fas fa-user-circle fa-9x mr-1"></i>
            </a>
            @endif
            <h4>{{ Auth::user()->name }}  さん</h4>
	        <h5>年齢: {{ Auth::user()->age }}</h5>
	        <h5>性別: {{ Auth::user()->gender_label }}</h5>
        </div>
      </aside>
      <main class="col-md-7 offset-md-5">
          @foreach($articles as $article)
            @include('articles.card')
            @endforeach

        </main>
    </div>
  </div>
</div>	                    

@endsection