@extends('layouts.app')

@section('title', '送信完了画面')

@section('content')

<h1>{{ __('送信完了') }}</h1>
<a href="{{ route('articles.index') }}" class="btn btn-primary text-center  text-white">トップページへ</a>
@endsection