<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="{{ asset('images/DKS_Logo_no.bg.png') }}" type="image/jpeg">
        <title>View Case</title>
        <link rel="stylesheet" href="{{ asset('css/AddCases.css') }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    </head>

    @include('components.admin.header')
    @include('components.admin.sidebar')

    <body>
        <section class="home-section">
            <div class="container">
                <h2>Create New User</h2>

                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>User Name:</label>
                        <input type="text" name="user_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Full Name:</label>
                        <input type="text" name="user_full_name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Email:</label>
                        <input type="email" name="user_email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Password:</label>
                        <input type="password" name="user_password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Role:</label>
                        <select name="user_role" class="form-control" required>
                            <option value="">-- Select a role --</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->role_id }}">{{ $role->role_title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button class="btn btn-success">Create</button>
                </form>
            </div>
        </section>
    </body>
</html>
@include('components.admin.footer')
