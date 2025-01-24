<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Jobs</title>
</head>
<body>
    <h1>Available Jobs</h1>

    <!-- Button to go to Admin Dashboard (only visible to admins) -->
    @auth
        @can('view-admin-dashboard') <!-- Only show if user is an admin -->
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mb-3">Go to Admin Dashboard</a>
        @endcan
    @endauth

    <!-- Display available jobs -->
    <ul>
        @foreach ($jobs as $job)
            <li>
                <strong>{{ $job->title }}</strong><br>
                {{ $job->description }}<br>
                <a href="{{ route('jobseeker.apply-job', $job->id) }}" class="btn btn-primary">Apply</a>
            </li>
        @endforeach
    </ul>
</body>
</html>
