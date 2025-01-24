@include('components.private.header')
@include('components.private.sidebar')

<section class="home-section bg-lightblue">
    <div class="home-content">
        <i class='bx bx-menu'></i>
        <h1>Manage Candidates</h1>
    </div>


    <div class="container">
        <h2>Candidates applied for: {{ $job->title }}</h2>

        @if($applications->isEmpty())
            <p>No candidates have applied for this job yet.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email Address</th>
                        <th>Status</th>
                        <th>Applied On</th>
                        <th>Action</th> <!-- Optional: For actions like viewing application details -->
                    </tr>
                </thead>
                <tbody>
                    @foreach($applications as $application)
                        <tr>
                            <td>{{ $application->name }}</td>
                            <td>{{ $application->email_address }}</td>
                            <td>{{ ucfirst($application->status) }}</td>
                            <td>{{ $application->created_at->format('Y-m-d H:i') }}</td>
                            <td>
                                <!-- Optional: Add actions like viewing application details -->
                                {{-- <a href="{{ route('application.view', $application->id) }}" class="btn btn-info">View Details</a> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

</section>

    <style>
        .home-section {
            background-color: #d2d2d2;
            padding: 20px;
        }

        .home-content {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.5rem;
            color: #333;
        }

        .container {
            margin-top: 20px;
            padding: 20px;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #000000;
            font-size: 30px:
        }

        h2 {
            color: #2a2a2a;
            font-size: 20px;
            font-weight: bold;
        }

        .form-label {
            font-weight: bold;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            margin-bottom: 20px;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #333;
            margin-bottom: 20px;
        }

        .btn-danger:hover {
            background-color: #bd2130;
        }

        .btn-warning {
            background-color: #ffc107;
            border-color: #333;
            margin-bottom: 20px;
        }

        .btn-secondary{
            background-color: rgb(5, 144, 0);
            border-color: #333;
            margin-bottom: 20px;
        }

        .btn-secondary:hover{
            background-color: #155724
        }

        .btn-warning:hover {
            background-color: #e0a800;
        }

        table {
            margin-top: 20px;
            border: #000000;
        }

        table th {
            background-color: #007bff;
            color: white;
            text-align: left;
        }

        table td {
            text-align: left;
        }

        .alert-success {
            margin-top: 10px;
            padding: 10px;
            color: #155724;
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            border-radius: 4px;
        }
    </style>

@include('components.private.footer')
