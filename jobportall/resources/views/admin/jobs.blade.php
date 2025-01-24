@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Job Listings</h1>

        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mb-3">Back to Dashboard</a>

        <a href="{{ route('admin.create-job') }}" class="btn btn-primary">Post New Job</a>

        <table class="table">
            <thead>
                <tr>
                    <th>Job Title</th>
                    <th>Category</th>
                    <th>Employer</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jobs as $job)
                    <tr>
                        <td>{{ $job->title }}</td>
                        <td>{{ $job->category->name }}</td>
                        <td>{{ $job->user->name }}</td> <!-- Assuming 'user' is the employer -->
                        <td>
                            <a href="{{ route('admin.edit-job', $job->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('admin.delete-job', $job->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
