<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Register Account</title>
        <link rel="stylesheet" href="{{ asset('css/candidateRegister.css') }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    </head>
        <body>
            <div class="container">

                @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


                <div class="header"></div>

                <div class="content-container">
                    <div class="form-section">
                        <img src="{{ asset('images/unissalogo1.png') }}" alt="Logo" class="logo">
                    </div>
                    <div class="text1">
                        <h2>
                            Online Job Application
                        </h2>
                    </div>
                    <div class="text2">
                        <h2>
                            Daftar Pengguna Baru
                            <div><i>Register New User</i></div>
                        </h2>
                    </div>

                        @if(session('success'))
                            <p>{{ session('success') }}</p>
                        @endif

                    <form id="registration-form" action="{{ route('candidate.register') }}" method="POST">
                        @csrf

                        <label for="fullname">Nama Penuh <i>Fullname</i></label>
                        <input type="text" name="name" placeholder="Fullname" required>

                        <label for="username">Nama Pengguna <i>Username</i></label>
                        <input type="text" name="username" placeholder="Username" required>

                        <label for="email">Email <i>Email</i></label>
                        <input type="email" name="email" placeholder="Email" required>

                        <label for="phone_number">Nombor Telefon <i>Phone Number</i></label>
                        <input type="number" name="phone_number" placeholder="Phone Number" required>

                        <label for="password">Kata Laluan <i>Password</i></label>
                        <input type="password" name="password" placeholder="Password" required>

                        <label for="confirm_password">Sahkan Kata Laluan <i>Confirm Password</i></label>
                        <input type="password" name="password_confirmation" placeholder="Confirm Password" required>

                        <button type="submit" class="btn-register">Register</button>

                    </form>

                </div><div class="footer"></div>
            </div>

        </body>
</html>
