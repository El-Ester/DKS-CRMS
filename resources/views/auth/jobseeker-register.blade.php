<body>
    <div class="container">
        <h1>Job Seeker Registration</h1>
        <form id="candidates-register-form" action="{{ route('candidates.register.submit') }}" method="post">
            @csrf

            <label>Fullname</label>
            <div><input type="text" class="form-control" name="fullname" placeholder="Your Fullname" required></div>

            <label>Username</label>
            <div><input type="text" class="form-control" name="username" placeholder="Username" required></div>

            <label>Email</label>
            <div><input type="email" class="form-control" name="email" placeholder="Your Email" required></div>

            <label>Password</label>
            <div><input type="password" class="form-control" name="password" placeholder="Password" required></div>

            <label>Confirm Password</label>
            <div><input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required></div>

            <button type="submit" class="btn-primary">Register</button>
        </form>

        @if ($errors->any())
        <div class="alert alert-danger mt-4">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
</body>
