@extends('layout.app')

@section('content')
    <div class="container">
        <h1>Board Members Dashboard</h1>
        <p>Welcome, {{ Auth::user()->name }}! This is the Board Members dashboard.</p>

        <!-- Example: Feature widgets -->
        <div>
            <h3>Quick Links</h3>
            <ul>
                <li><a href="#">Manage Recruitment</a></li>
                <li><a href="#">View Reports</a></li>
                <li><a href="#">Employee Onboarding</a></li>
            </ul>
        </div>
    </div>
@endsection
