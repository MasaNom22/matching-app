@extends('layouts.app')

@section('title', 'ユーザー詳細画面')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mb-1">
            <div class="card">
                <div class="d-inline-flex">
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
                    <div class="p-5 d-flex flex-column justify-content-start">
                        <div class="d-flex">
                            <div>
                                @if ($user->id === Auth::user()->id)
                                    <a href="{{ route('users.edit', ['user' => $user]) }}" class="btn btn-primary">プロフィールを編集する</a>
                                @else
                                        <follow-button
                                          class="ml-auto"
                                          :initial-is-followed-by='@json($user->isFollowedBy(Auth::user()))'
                                          :authorized='@json(Auth::check())'
                                          endpoint="{{ route('users.follow', ['name' => $user->name]) }}"
                                        >
                                        </follow-button>
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
                        <div class="mt-2 d-flex justify-content-start">
                            <p class="font-weight-bold">趣味</p>
                            <span>
                                @foreach($user->tags as $tag)
                                @if($loop->first)
                                  <div class="card-body pt-0 pb-4 pl-3">
                                    <div class="card-text line-height">
                                @endif
                                      <a href="" class="border p-1 mr-1 mt-1 text-muted">
                                        {{ $tag->hashtag }}
                                      </a>
                                @if($loop->last)
                                    </div>
                                  </div>
                                @endif
                              @endforeach</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">@foreach($articles as $article)
            @include('articles.card')
            @endforeach</div>
    </div>
</div>

@endsection
