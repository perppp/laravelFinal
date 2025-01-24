@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Admin Dashboard</h1>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Jobs</h5>
                        <p class="card-text">{{ $totalJobs }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Users</h5>
                        <p class="card-text">{{ $totalUsers }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Employers</h5>
                        <p class="card-text">{{ $totalEmployers }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
