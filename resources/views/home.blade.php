@extends('layout.app')

@section('title', 'Home')

@section('content')
    <div class="card">
        <h1>Welcome to the Dashboard</h1>
        <p>This is the central hub for managing your activities and accessing role-specific features.</p>
    </div>

    <div class="card">
        <h2>Features</h2>
        <ul>
            <li>Role-specific dashboards tailored to your needs</li>
            <li>Manage employees, attendance, performance, and more</li>
            <li>Stay updated with the latest news and announcements</li>
        </ul>
    </div>

    <div class="card">
        <h2>Quick Links</h2>
        <ul>
            @if(Auth::check())
                @if(Auth::user()->role === 'hrd')
                    <li><a href="/hrd-dashboard">Go to HRD Dashboard</a></li>
                @elseif(Auth::user()->role === 'jppstm')
                    <li><a href="/jppstm-dashboard">Go to JPPSTM Dashboard</a></li>
                @elseif(Auth::user()->role === 'applicant')
                    <li><a href="/applicant-dashboard">Go to Applicant Dashboard</a></li>
                @elseif(Auth::user()->role === 'faculty/centre')
                    <li><a href="/facultyCentre-dashboard">Go to Faculty/Centre Dashboard</a></li>
                @elseif(Auth::user()->role === 'department/unit')
                    <li><a href="/departmentUnit-dashboard">Go to Department/Unit Dashboard</a></li>
                @elseif(Auth::user()->role === 'board members')
                    <li><a href="/boardMembers-dashboard">Go to Board Members Dashboard</a></li>
                @elseif(Auth::user()->role === 'assistant registrar')
                    <li><a href="/assistantRegistrar-dashboard">Go to Assistant Registrar Dashboard</a></li>
                @endif
            @else
                <li><a href="/login">Login to your account</a></li>
            @endif
        </ul>
    </div>
@endsection
