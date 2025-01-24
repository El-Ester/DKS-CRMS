<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Job Application</title>
    <link rel="stylesheet" href="{{ asset('css/userLogin.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<!-- "OBE System" Title Above the Login Container -->

<body>
    <!-- Logo -->
    <img src="{{ asset('images/unissalogo.png') }}" alt="Logo" class="logo">


    <!-- OBE Titles -->
    <div class="obe1-title">
        Human Resource e-Recruitment System
    </div>
    <div class="obe-title">
        Human Resource Department
    </div>

    <!-- Login Form Container -->
    <div class="container">
        <h1>Login</h1>
        <form action="{{ url('login') }}" method="POST">
            @csrf

            <label>Username</label>
            <div><input type="text" class="form-control" id="username" name="username" placeholder="Username" required></div>

            <label>Password</label>
            <div><input type="password" class="form-control" id="password" name="password" placeholder="Password" required></div>

            <button type="submit" class="btn-primary">Login</button>

            <!-- Job Seeker Login Link -->
            <div class="job-seeker-login">
                <p>Are you a Job Seeker? <a href="{{ route('candidate.login') }}">Login here</a></p>
            </div>

            <p><a href="{{ route('frontpage.frontpage') }}">Office of Human Resources</a></p>

        </form>

        @if ($errors->has('credentials'))
        <div class="alert alert-danger mt-4">
            {{ $errors->first('credentials') }}
        </div>
    @endif
    </div>

    @if(session('error'))
    <div class="alert alert-danger">
        <strong>Error!</strong> {{ session('error') }}
    </div>
@endif


</div>
</body>
</html>
