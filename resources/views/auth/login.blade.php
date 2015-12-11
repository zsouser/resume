@extends('layouts.master')

@section('styles')
	<link rel="stylesheet" href="/css/login.css">
@endsection

@section('css')
.login {
	width:500px;
	margin:0 auto;
	margin-top:150px;
}

.content {
	width:100%;
}

input,
button {
	line-height:24px;
	width:500px;
	margin: 0 auto;
}
@endsection

@section('content')
	<div class="login">
		<form action="{{ action('Auth\AuthController@postLogin') }}" method="POST">
		<input type="text" name="email" placeholder="email address">
		<input type="password" name="password" placeholder="password">
		<button type="submit" name="submit">Log In</button>
		{{ csrf_field() }}
		</form>
	</div>
@endsection