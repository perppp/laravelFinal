@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Edit Job</h1>

        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mb-3">Back to Dashboard</a>

        <form action="{{ route('admin.update-job', $job->id) }}" method="POST">
            @csrf
            @method('POST')
            
            <div class="form-group">
                <label for="title">Job Title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $job->title) }}" required>
            </div>
            
            <div class="form-group">
                <label for="description">Job Description</label>
                <textarea name="description" class="form-control" required>{{ old('description', $job->description) }}</textarea>
            </div>
            
            <div class="form-group">
                <label for="category_id">Category</label>
                <input type="text" name="category_id" class="form-control" value="{{ old('category_id', $job->category_id) }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update Job</button>
        </form>
    </div>
@endsection
