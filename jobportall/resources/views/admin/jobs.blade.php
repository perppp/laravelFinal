@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Job Listings</h1>
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
                @forelse($jobs as $job)
                    <tr>
                        <td>{{ $job->title }}</td>
                        <td>{{ $job->category->name ?? 'Uncategorized' }}</td>
                        <td>{{ $job->employer->name ?? 'Unknown Employer' }}</td>
                        <td>
                            <a href="{{ route('admin.edit-job', $job->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('admin.delete-job', $job->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('POST')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">No jobs available.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
