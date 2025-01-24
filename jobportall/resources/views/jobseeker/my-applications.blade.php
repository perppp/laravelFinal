@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>My Job Applications</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Job Title</th>
                    <th>Employer</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($applications as $application)
                    <tr>
                        <td>{{ $application->job->title }}</td>
                        <td>{{ $application->job->employer->name }}</td>
                        <td>{{ $application->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
