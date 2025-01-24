<body>

    <!-- Logo -->
    <img src="{{ asset('images/unissalogo.png') }}" alt="Logo" class="logo">


    <!-- OBE Titles -->
    <div class="obe1-title">
        JOB OPPORTUNITIES
    </div>
    <div class="obe-title">
        UNISSA Human Resource Department
    </div>


    <div class="container">
        <h1>Job Seeker Login</h1>
        <form id="-login-form" action="{{ route('.auth') }}" method="post">
            @csrf

            <label>Username</label>
            <div><input type="text" class="form-control" name="username" placeholder="Username" required></div>

            <label>Password</label>
            <div><input type="password" class="form-control" name="password" placeholder="Password" required></div>

            <button type="submit" class="btn-primary">Login</button>
        </form>

        <div class="job-seeker-register">
            <p>Don't have an account? <a href="{{ route('candidates.register') }}">Register here</a></p>
        </div>


        @if(session('error'))
        <div class="alert alert-danger">
            <strong>Error!</strong> {{ session('error') }}
        </div>
        @endif
    </div>
</body>

<style>
    label {
        display: block; /* Makes the label take up the full width */
        text-align: left; /* Aligns the text to the left */
        margin-bottom: 5px; /* Adds space between the label and input field */
        font-size: 14px; /* Adjust font size for readability */
        font-weight: bold; /* Makes the text bold */
        color: #333; /* Optional: Sets the label color */
        width: 80%; /* Matches the input width */
        margin-left: auto; /* Centers the label with input */
        margin-right: auto; /* Centers the label with input */
    }

    .form-control {
        width: 80%; /* Matches the width of the "Sign In" button */
        border: 1px solid #ccc;
        border-radius: 25px;
        height: 45px;
        padding: 10px 15px;
        margin-bottom: 20px; /* Adds consistent spacing between input fields */
    }

    .btn-primary {
        background: #f08a5d;
        border: none;
        border-radius: 25px;
        padding: 12px;
        color: white;
        font-size: 16px;
        cursor: pointer;
        width: 100%; /* Keeps it the same width as the input fields */
        transition: background 0.3s;
    }

    .logo {
        position: absolute;
        top: 20px;  /* Adjust based on your preference */
        left: 20px;  /* Adjust to position it on the left side */
        width: 250px;  /* Adjust logo size */
        height: auto;
    }


    .obe1-title {
        font-size: 40px;  /* Larger font size */
        text-align: center;
        font-weight: bold;
        color: #000000;
        margin-bottom: 20px;  /* Reduced margin to keep it closer to the next title */
        position: absolute;
        top: 20px;  /* Positions the title a little further up */
        width: 100%;
    }

    .obe-title {
        font-size: 20px;  /* Smaller font size */
        text-align: center;
        font-weight: bold;
        color: #2c2c2c;
        margin-bottom: 20px;
        position: absolute;
        top: 80px;  /* Adjusted to ensure it's placed below the .obe1-title */
        width: 100%;
    }

    .alert-danger {
        font-size: 40px;
        text-align: center;
        font-weight: bold;
        color:#ff4f4f;
        margin-bottom: 20px;
        position: absolute;
        bottom: 80px;
        width: 100%;

    }



    body {
        background: url('{{ asset('images/unissa.jpg') }}') no-repeat center center fixed;
        background-size: cover;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .container {
        background: rgba(255, 255, 255, 0.605);
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        width: 400px;
        padding: 30px;
        text-align: center;
        margin-top: 50px;
    }



    h1 {
        font-size: 28px;
        font-weight: bold; /* Makes the text bold */
        color: #333;
        margin-bottom: 20px;
        margin-top: 5px;
    }

    .form-control {
        border: 1px solid #ccc;
        border-radius: 25px;
        height: 45px;
        padding: 10px 15px;
        margin-bottom: 15px;
    }

    .form-control:focus {
        outline: none;
        border-color: #f08a5d;
        box-shadow: 0 0 10px rgba(240, 138, 93, 0.3);
    }

    .btn-primary {
        background: #13982e;
        border: none;
        border-radius: 25px;
        padding: 12px;
        color: white;
        font-size: 16px;
        cursor: pointer;
        width: 80%; /* Matches input field width */
        margin-left: auto; /* Centers the button horizontally */
        margin-right: auto; /* Centers the button horizontally */
        display: block; /* Ensures it takes up the full available space horizontally */
        transition: background 0.3s;
    }

    .btn-primary:hover {
        background: #2cd44e;
    }

    .social-buttons {
        display: flex;
        justify-content: space-around;
        margin-top: 20px;
    }

    .social-buttons button {
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 25px;
        width: 48%;
        padding: 10px;
        font-size: 14px;
        cursor: pointer;
        transition: box-shadow 0.3s;
    }

    .social-buttons button:hover {
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .remember-forgot {
        display: flex;
        justify-content: space-between;
        font-size: 14px;
        margin-top: 10px;
    }

    .remember-forgot a {
        color: #f08a5d;
        text-decoration: none;
    }

    .remember-forgot a:hover {
        text-decoration: underline;
    }
</style>
