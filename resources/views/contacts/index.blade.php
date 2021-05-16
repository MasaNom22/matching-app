@extends('layouts.app')

@section('title', 'お問い合わせ画面')

@section('content')

<h1 class="text-center mt-2 mb-5">お問い合わせ</h1>
<div class="container">
    {!! Form::open(['route' => 'contacts.confirm', 'method' => 'POST']) !!}
        {{ csrf_field() }}
        <div class="form-group row">
            <p class="col-sm-4 col-form-label">お名前（10文字以内）<span class="badge badge-danger ml-1">必須</span></p>
            <div class="col-sm-8">
                {{ Form::text('name', null, ['class' => 'form-control']) }}
            </div>
        </div>
        @if ($errors->has('name'))
            <p class="alert alert-danger">{{ $errors->first('name') }}</p>
        @endif

        <div class="form-group row">
            <p class="col-sm-4 col-form-label">メールアドレス<span class="badge badge-danger ml-1">必須</span></p>
            <div class="col-sm-8">
                {{ Form::text('email', null, ['class' => 'form-control']) }}
            </div>
        </div>
        @if ($errors->has('email'))
            <p class="alert alert-danger">{{ $errors->first('email') }}</p>
        @endif

        <div class="form-group row">
            <p class="col-sm-4 col-form-label">お問い合わせ内容<span class="badge badge-danger ml-1">必須</span></p>
            <div class="col-sm-8">
                {{ Form::textarea('contents', null, ['class' => 'form-control']) }}
            </div>
        </div>
        @if ($errors->has('contents'))
            <p class="alert alert-danger">{{ $errors->first('contents') }}</p>
        @endif
        
        <div class="text-center">
            {{ Form::submit('確認画面へ', ['class' => 'btn btn-primary']) }}
        </div>
    {!! Form::close() !!}
</div>
@endsection