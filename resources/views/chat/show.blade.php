@extends('layouts.layout')

@section('content')

<div id="chat">
        <textarea v-model="message"></textarea>
        <br>
        <button type="button">送信</button>
</div>

@endsection