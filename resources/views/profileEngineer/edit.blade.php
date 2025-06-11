<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/DKS_Logo_no.bg.png') }}" type="image/jpeg">
    <title>Update Password</title>
    <link rel="stylesheet" href="{{ asset('css/AddCases.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

@include('components.engineer.header')
@include('components.engineer.sidebar')

<body>
    <section class="home-section">
        <div class="card p-4 shadow-sm mt-4">
            <h4 class="mb-3">Update Password</h4>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if(session('status'))
                <div class="alert alert-info">{{ session('status') }}</div>
            @endif

            <form action="{{ route('profileEngineer.edit') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="current_password" class="form-label">Current Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="current_password" name="current_password" required>
                        <button type="button" class="btn btn-outline-secondary" onclick="togglePassword()">
                            <i id="toggleIcon" class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="new_password" class="form-label">New Password</label>
                    <input type="password" class="form-control" id="new_password" name="new_password" required>
                </div>

                <div class="mb-3">
                    <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                    <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
                </div>

                <button type="submit" class="btn btn-primary">Update Password</button>
            </form>

            <!-- Forgot Password Button -->
            <div class="text-end mt-3">
                <button class="btn btn-link" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal">Forgot Password?</button>
            </div>

            <!-- Forgot Password Modal -->
            <div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="forgotPasswordModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content shadow">
                        <div class="modal-header">
                            <h5 class="modal-title" id="forgotPasswordModalLabel">Reset Password</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('password.email') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <p>Enter your email to receive a password reset link.</p>
                                <div class="mb-3">
                                    <label for="reset_email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="reset_email" name="email" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Send Reset Link</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
            <script>
                function togglePassword() {
                    const input = document.getElementById('current_password');
                    const icon = document.getElementById('toggleIcon');
                    const isPassword = input.type === 'password';

                    input.type = isPassword ? 'text' : 'password';
                    icon.classList.toggle('fa-eye');
                    icon.classList.toggle('fa-eye-slash');
                }


                @if (session('success'))
                    toastr.success("{{ session('success') }}");
                @endif

                @if ($errors->any())
                    toastr.error("{{ $errors->first() }}");
                @endif
            </script>
        </div>
    </section>
</body>
</html>

@include('components.engineer.footer')
