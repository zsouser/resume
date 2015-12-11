<html>
<head>
	<style>

body {
	font-size:12px;
	font-family: "Trebuchet MS", Helvetica, sans-serif;
	width:8in;
	padding:0in .25in 0in .25in;
}

header {
	border-bottom:1px solid black;
	text-align:center;
}
h3 {
	border-bottom:1px solid black;
	page-break-after: avoid;
	clear:both;
}

.objective {
	padding: 10px;
}
.job {
	display: block;
}
.block {
	position:relative;
	display:block;
	page-break-inside: avoid;
}
.project {
	display: block;
}

.company {
	font-style: italic;
	display: block;
}

.title {
	font-weight: bold;
	display: block;
}

.qualification {
	padding-bottom: 10px;
	display:block;
}

.education {
	display:block;
}

.skills {
	display: inline-table;
	padding-bottom: 15px;
}

.skill {
	float:left;
	padding: 15px;
}

.descriptions {
	clear: both;
}

.date {
	float:right;
}

	</style>
</head>
<body>
	<div class="resume">
		<header>
			<h1>Zach Souser</h1>
			{!! !empty($phone) ? "<b>720.422.0119</b> - " : "" !!}<b>zach.souser@gmail.com</b>
		</header>
		<p class="objective section">{{ $objective->text }}</p>
		<h3>Experience</h3>
		<div class="jobs">
			@foreach ($jobs as $job)
			<div class="job block">
				<span class="header">
					<b>{{ $job->title }}</b> - <i>{{ $job->organization->name }}</i> 
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
		<div class="projects section">
			@foreach ($projects as $project)
			<div class="project block">
				<span class="header">
					{{ $project->name }} - <i> {{ $project->organization->name }} </i>
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
		<div class="education section">
			@foreach ($credentials as $qualification)
			<div class="qualification block">
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
</body>
</html>