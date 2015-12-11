@extends('layouts.master')

@section('styles')
	<link rel="stylesheet" href="/css/chosen.min.css"/>
@endsection

@section('js')
	$(".chosen-select").chosen();
@endsection

@section('css')
form {
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
	display:lock
}
@endsection

@section('scripts')
	<script src="/js/chosen.jquery.min.js"></script>
@endsection
@section('content')
<form action="{{ action('CredentialsController@update', [$credential->id]) }}" method="PUT">
	@include('partials.organization_chooser')
	<input type="text" name="credential" value="{{ $credential->credential }}">
	<input type="text" name="date_start" value="{{ $credential->date_start }}">
	<input type="text" name="date_end" value="{{ $credential->date_end }}">
	<button type="submit">Save Changes</button>
</form>
@endsection