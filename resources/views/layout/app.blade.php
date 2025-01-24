<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">


</head>
<body>
    <nav>
        <ul>
            {{-- <li><a href="{{ route('home') }}">Home</a></li> --}}
                {{-- Role-specific links as previously defined --}}
            @if(Auth::user()->role === 'hrd')
                {{-- <li><a href="/hrd-dashboard">HRD Dashboard</a></li> --}}
            @elseif(Auth::user()->role === 'jppstm')
                {{-- <li><a href="/jppstm-dashboard">JPPSTM Dashboard</a></li> --}}
            @elseif(Auth::user()->role === 'applicant')
                {{-- <li><a href="/applicant-dashboard">Applicant Dashboard</a></li> --}}
            @elseif(Auth::user()->role === 'faculty/centre')
                {{-- <li><a href="/facultyCentre-dashboard">Faculty/Centre Dashboard</a></li> --}}
            @elseif(Auth::user()->role === 'department/unit')
                {{-- <li><a href="/departmentUnit-dashboard">Department/Unit Dashboard</a></li> --}}
            @elseif(Auth::user()->role === 'board members')
                {{-- <li><a href="/boardMembers-dashboard">Board Members Dashboard</a></li> --}}
            @elseif(Auth::user()->role === 'assistant registrar')
                {{-- <li><a href="/assistantRegistrar-dashboard">Assistant Registrar Dashboard</a></li> --}}
            @endif
        </ul>
    </nav>

    <main>
        @yield('content')
    </main>
</body>
</html>
