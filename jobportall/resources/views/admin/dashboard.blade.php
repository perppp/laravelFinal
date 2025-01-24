@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Admin Dashboard</h1>
        <p>Welcome to your admin dashboard! From here, you can manage job listings, employers, and more.</p>
        
        <a href="{{ route('admin.jobs') }}" class="btn btn-primary">Manage Jobs</a>
    </div>
@endsection
