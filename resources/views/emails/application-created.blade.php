<div>
    <div>
        <i><b>Application ID:</b> {{ $application->id }}</i>
        <span><b>Created At:</b> {{ $application->created_at }}</span>
    </div>
    <p><b>User:</b> {{ $application->user->name }}</p>
    <p><b>Email:</b> {{ $application->user->email }}</p>
    <h1><b>Subject:</b> {{ $application->subject }}</h1>
    <p><b>Message:</b> {{ $application->message }}</p>

    <a href="{{ route('applications.show', $application->id) }}">View Application</a>

    <a href="{{ $application->file_url }}">Download file</a>
</div>
