@extends('layouts.app')

@section('title', 'ユーザー詳細画面')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mb-3">
            <div class="card">
                <div class="d-inline-flex">
                    <div class="p-5 d-flex flex-column">
                        @if(isset($image))
                        <img src="{{ Storage::url($image->file_path) }}" class="rounded-circle" width="100" height="100">
                        @else
                        <i class="fas fa-user-circle fa-9x mr-1"></i>
                        @endif
                        <div class="mt-3 d-flex flex-column">
                            <h4 class="mb-0 font-weight-bold">{{ $user->name }}</h4>
                            <span class="text-secondary">{{ $user->age }}歳</span>
                        </div>
                    </div>
                    <div class="p-5 d-flex flex-column justify-content-between">
                        <div class="d-flex">
                            <div>
                                @if ($user->id === Auth::user()->id)
                                    <a href="{{ url('users/' .$user->id .'/edit') }}" class="btn btn-primary">プロフィールを編集する</a>
                                @else
                                    @if (Auth::user()->is_following($user->id))
                                        <follow-button
                                          class="ml-auto"
                                          :initial-is-followed-by='@json($user->isFollowedBy(Auth::user()))'
                                          :authorized='@json(Auth::check())'
                                          endpoint="{{ route('users.follow', ['name' => $user->name]) }}"
                                        >
                                        </follow-button>
                                    @else
                                        <form action="{{ route('follow', ['id' => $user->id]) }}" method="POST">
                                            {{ csrf_field() }}

                                            <button type="submit" class="btn btn-primary">フォローする</button>
                                        </form>
                                    @endif
                                @endif
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <div class="p-2 d-flex flex-column align-items-center">
                                <p class="font-weight-bold">投稿数</p>
                                <span>{{ $user->articles_count }}</span>
                            </div>
                            <div class="p-2 d-flex flex-column align-items-center">
                                <p class="font-weight-bold">フォロー数</p>
                                <span><a href="{{ action('UserController@followings', $user->id) }}">{{ $user->followings_count }}</a></span>
                            </div>
                            <div class="p-2 d-flex flex-column align-items-center">
                                <p class="font-weight-bold">フォロワー数</p>
                                <span><a href="{{ action('UserController@followers', $user->id) }}">{{ $user->followers_count }}</a></span>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
