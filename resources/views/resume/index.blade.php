<style>
.job {
	display:block;
}

.company {
	font-style:italic;
	display:block;
}

.title {
	font-weight:bold;
	display:block;
}

.date {
	float:right;
}

.skills {
	display:inline-table;
}

.skill {
	float:left;
	padding:5px;
}

.job-header {
	float:left;
	display:block;
}

.descriptions {
	clear:both;
}
</style>
<h1>Zach Souser</h1>
<b>720.422.0119</b> - <b>zach.souser@gmail.com</b>
<hr/>
@foreach ($objective as $line) 
	<p class="objective">{{ $line->text }}</p>
@endforeach
<hr/>
<h3>Skills</h3>
<div class="skills">
@foreach ($skills as $skill)
	<span class="skill">{{ $skill->name }}</span>
@endforeach
</div>
<h3>Experience</h3>
<div class="jobs">
@foreach ($jobs as $job)
	<div class="job">
		<span class="date">
			{{ date('F Y', strtotime($job->date_start)) }}
			-
			{{ empty($job->date_end) ? 'Present' : date('F Y', strtotime($job->date_end)) }}
		</span>
		<span class="job-header">
			<b>{{ $job->title }}</b>
			<br/>
			<i>{{ $job->company }}</i> 
		</span>
		<ul class="descriptions">
			@foreach ($job->descriptions as $description)
				<li class="description">{{ $description->text }}</li>
			@endforeach
		</ul>
	</div>
@endforeach
</div>
<h3>Education</h3>
<div class="education">
@foreach ($education as $qualification)
	<div class="qualification">
		<span class="date">
			@if (!empty($qualification->date_start)) 
				{{ date('F Y', strtotime($qualification->date_start)) }}
				-
			@endif
			{{ empty($qualification->date_end) ? 'Present' : date('F Y', strtotime($qualification->date_end)) }}
		</span>
		<b>{{ $qualification->credential }}</b>
		<br/> 
		<i>{{ $qualification->authority }}</i>
	</div>
@endforeach
</div>