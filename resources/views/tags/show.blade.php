@extends('layouts.app')

@section('title', $tag->hashtag)

@section('content')

  <div class="container">
    <div class="card mt-3">
      <div class="card-body">
        <h2 class="h4 card-title m-0">{{ $tag->hashtag }}</h2>
        <div class="card-text text-right">
          {{ $tag->users->count() }}件
        </div>
      </div>
    </div>
    @foreach($tag->users as $user)
    <div class="p-5 d-flex flex-column">
      @if(isset($user->uploadimages))
      <img src="{{ Storage::url($user->uploadimages->file_path) }}" class="rounded-circle" width="100" height="100">
      @else
      <i class="fas fa-user-circle fa-9x mr-1"></i>
      @endif
      <div class="mt-3 d-flex flex-column">
          <h4 class="mb-0 font-weight-bold">{{ $user->name }}</h4>
          <span class="text-secondary">{{ $user->age }}歳</span>
      </div>
  </div>
    @endforeach
  </div>
@endsection