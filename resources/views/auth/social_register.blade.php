@extends('layouts.app')

@section('title', 'ユーザー登録')

@section('content')
  <div class="container">
    <div class="row">
      <div class="mx-auto col col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6">
        <h1 class="text-center"><a class="text-dark" href="/">memo</a></h1>
        <div class="card mt-3">
          <div class="card-body text-center">
            <h2 class="h3 card-title text-center mt-2">ユーザー登録</h2>
            
            <div class="card-text">
              <form method="POST" 
                action="{{ route('register.{provider}', ['provider' => $provider]) }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="md-form">
                  <label for="name">ユーザー名</label>
                  <input class="form-control @error('name') is-invalid @enderror" type="text" id="name" name="name" required >
                  <small>英数字3〜16文字(登録後の変更はできません)</small>
                  @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                </div>                
                <div class="md-form">
                  <label for="email">メールアドレス</label>
                  <input class="form-control" type="text" id="email" name="email" value="{{ $email }}" disabled>
                </div>
                <div class="form-group row">
                  <label for="gender" class="col-md-4 col-form-label text-md-right">性別</label>
                  <div class="col-md-6">
                      <div class="form-check form-check-inline">
                          <input class="form-check-input" name="gender" value="male" type="radio" id="inlineRadio1">
                          <label class="form-check-label" for="inlineRadio1">男</label>
                      </div>
                      <div class="form-check form-check-inline">
                          <input class="form-check-input" name="gender" value="female" type="radio" id="inlineRadio2">
                          <label class="form-check-label" for="inlineRadio2">女</label>
                      </div>
                      @error('gender')
                              <span style="display:inline"class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                      @enderror
                  </div>
              </div>
              
              <div class="form-group row">
                  <label for="age" class="col-md-4 col-form-label text-md-right">{{ __('年齢') }}</label>

                  <div class="col-md-6">
                      <input id="age" type="number" min="18" class="form-control @error('age') is-invalid @enderror" name="age" value="{{ old('age') }}" required autocomplete="age" autofocus>

                      @error('age')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
              </div>
                <button class="btn btn-block blue-gradient mt-2 mb-2" type="submit">ユーザー登録</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection