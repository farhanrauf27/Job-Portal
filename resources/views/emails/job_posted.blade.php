<!-- resources/views/emails/job_posted.blade.php -->

<h1>New Job Posted: {{ $job->title }}</h1>
<p>{{ $job->description }}</p>
<p>Click <a href="{{ route('allJobs', $job->id) }}">here</a> to apply.</p>
