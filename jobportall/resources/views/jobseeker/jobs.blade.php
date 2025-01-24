<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Jobs</title>
</head>
<body>
    <h1>Available Jobs</h1>

    <ul>
        @foreach ($jobs as $job)
            <li>
                <strong>{{ $job->title }}</strong><br>
                {{ $job->description }}
            </li>
        @endforeach
    </ul>
</body>
</html>
