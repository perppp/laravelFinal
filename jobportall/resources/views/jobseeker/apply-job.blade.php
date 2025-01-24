@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Apply for Job: {{ $job->title }}</h1>
        <form action="{{ route('jobseeker.submit-application', $job->id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="cover_letter" class="form-label">Cover Letter</label>
                <textarea class="form-control" id="cover_letter" name="cover_letter" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit Application</button>
        </form>
    </div>
@endsection
