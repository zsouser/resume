@extends('layouts.master')

@section('js')
	$(".chosen-select").chosen();
@endsection

@section('styles')
	<link rel="stylesheet" href="/css/chosen.min.css"/>
@endsection

@section('scripts')
	<script src="/js/chosen.jquery.min.js"></script>
@endsection

@section('css')
	fieldset {
		width: 40%;
		margin: 0 auto;
		display: block;
	}

	select {
		width: 100%;
		margin: 15px;
	}
@endsection

@section('content')
<h1>Print Custom PDF</h1>
<fieldset>
	<legend>Options</legend>
	<form action="{{ action('ResumeController@postPrint') }}" method="POST">
		<select name="objectives[]" data-placeholder="Select one objective to include in the PDF." class="chosen-select">
			@foreach ($objectives as $objective) 
				<option value="{{ $objective->id }}">{{ $objective->text }}</option>
			@endforeach
		</select>
		<select name="projects[]" multiple="multiple" data-placeholder="Select one or more projects to include in the PDF." class="chosen-select">
			@foreach ($projects as $project) 
				<option value="{{ $project->id }}">{{ $project->name }}</option>
			@endforeach
		</select>
		<select name="skills[]" multiple="multiple" data-placeholder="Select one or more skills to include in the PDF." class="chosen-select">
			@foreach ($skills as $skill) 
				<option value="{{ $skill->id }}">{{ $skill->name }}</option>
			@endforeach
		</select>
		<select name="jobs[]" multiple="multiple" data-placeholder="Select one or more jobs to include in the PDF." class="chosen-select">
			@foreach ($jobs as $job) 
				<option value="{{ $job->id }}">{{ $job->title }} at {{ $job->organization->name }}</option>
			@endforeach
		</select>
		<select name="credentials[]" multiple="multiple" data-placeholder="Select one or more credentials to include in the PDF." class="chosen-select">
			@foreach ($credentials as $credential) 
				<option value="{{ $credential->id }}">{{ $credential->credential }}</option>
			@endforeach
		</select>
		{{ csrf_field() }}
		<button type="submit">Print Resume</button>
	</form>
</fieldset>
@endsection