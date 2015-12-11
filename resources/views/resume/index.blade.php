@extends('layouts.master')

@section('styles')
	<link rel="stylesheet" href="/css/resume.css" />
	<link rel="stylesheet" href="/css/splash.css" />
@endsection

@section('js')
	$(".scroll").on('click', function() {
		$('body').animate({
			scrollTop: $("div.resume").offset().top
		}, '500', 'swing');
	});
@endsection

@section('content')
	<div id="splash">
        <h1>Zach Souser</h1>
        <h2>Computer Scientist, Web Developer, Software Engineer</h2>
        <a href="#" class="scroll">Check out my resume &raquo;</a>
    </div>
	<div class="resume">
		<p class="objective">{{ $objective->text }}</p>
		<h3>Experience</h3>
		<div class="jobs">
		@foreach ($jobs as $job)
			<div class="job">
				<span class="header">
					<b>{{ $job->title }}</b>
					<br/>
					<i>{{ $job->organization->name }}</i> 
				</span>
				<span class="date">
					{{ date('F Y', strtotime($job->date_start)) }}
					-
					{{ empty($job->date_end) ? 'Present' : date('F Y', strtotime($job->date_end)) }}
				</span>
				<ul class="descriptions">
					@foreach ($job->descriptions as $description)
						<li class="description">{{ $description->text }}</li>
					@endforeach
				</ul>
			</div>
		@endforeach
		</div>
		<h3>Skills</h3>
		<div class="skills">
		@foreach ($skills as $skill)
			<span class="skill">{{ $skill->name }}</span>
		@endforeach
		</div>
		<h3>Projects</h3>
		<div class="projects">
		@foreach ($projects as $project)
			<div class="project">
				<span class="header">
					{{ $project->name }}
					<br/>
					<i> {{ $project->organization->name }} </i>
				</span>
				<span class="date">
					{{ date('F Y', strtotime($project->date_start)) }}
					-
					{{ empty($project->date_end) ? 'Present' : date('F Y', strtotime($project->date_end)) }}
				</span>
				<ul class="descriptions">
					@foreach ($project->descriptions as $description)
						<li class="description">{{ $description->text }}</li>
					@endforeach
				</ul>
			</div>
		@endforeach
		</div>
		<h3>Education</h3>
		<div class="education">
		@foreach ($credentials as $qualification)
			
			<div class="qualification">
				<span class="header">
					<b>{{ $qualification->credential }}</b>
					<br/>
					<i>{{ $qualification->organization->name }}</i>
				</span>
				<span class="date">
					@if (!empty($qualification->date_start)) 
						{{ date('F Y', strtotime($qualification->date_start)) }}
						-
					@endif
					{{ empty($qualification->date_end) ? 'Present' : date('F Y', strtotime($qualification->date_end)) }}
				</span>
			</div>

		@endforeach
		</div>
	</div>
@endsection