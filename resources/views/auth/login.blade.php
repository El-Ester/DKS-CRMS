<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - DKS_CRMS</title>
    <link rel="icon" type="image/png" href="{{ asset('images/DKS_Logo_no.bg.png') }}">
    <link rel="icon" href="data:,">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-header">
                        <h4>CRMS Login</h4>
                    </div>
                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                    <form id="login-form" action="{{ route('auth') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="user_email" class="form-label">Email</label>
                            <input type="email" name="user_email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="user_password" class="form-label">Password</label>
                            <input type="password" name="user_password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </form>

                    </div>
                    <div class="card-footer text-muted text-center">
                        &copy; {{ date('Y') }} Drones Kaki Sabah
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
