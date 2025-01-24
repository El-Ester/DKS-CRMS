@include('components.jppstm.header')
@include('components.jppstm.sidebar')

<section class="home-section bg-lightblue">
    <div class="home-content">
        <i class='bx bx-menu'></i>
        <span class="text text-black">Manage Hiring</span>
    </div>

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

        h1, h3 {
            color: #565656;
        }

        .form-label {
            font-weight: bold;
        }

        .btn-primary1 {
            background-color: #13dc31;
            border-color: #449f52;
            margin-top: 20px;
            border-radius: 50px; /* Makes the button oval */
            padding: 5px 20px; /* Adds some padding to make it bigger and more oval */
            color: rgb(0, 0, 0); /* Text color */
            display: inline-flex; /* Ensures the icon and text align horizontally */
            align-items: center; /* Vertically center the icon and text */
            justify-content: center; /* Horizontally center the icon and text */
        }

        .btn-primary1 i {
            margin-right: 8px; /* Adds some space between the icon and text */
        }


        .btn-primary1:hover {
            background-color: #449f52;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #000000;
            margin-bottom: 5px;
            margin-top: 5px;
            padding: 4px 10px;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
            padding: 4px 10px;
            margin-bottom: 5px;
            margin-top: 5px;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #333;
            margin-bottom: 5px;
            margin-top: 5px;
            padding: 4px 10px;
        }

        .btn-danger:hover {
            background-color: #bd2130;
        }

        .btn-warning {
            background-color: #ffc107;
            border-color: #333;
            margin-bottom: 5px;
            margin-top: 5px;
            padding: 4px 10px;
        }

        .btn-secondary{
            background-color: rgb(5, 144, 0);
            border-color: #333;
            margin-bottom: 5px;
            margin-top: 5px;
        }

        .btn-secondary:hover{
            background-color: #155724
        }

        .btn-warning:hover {
            background-color: #e0a800;
        }

        table {
            margin-top: 20px;
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

<div class="container">
    {{-- <h1>Manage Hiring</h1> --}}

    <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link active" href="{{ route('jppstm.manage_hiring.index') }}">Job Openings</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="jppstm.manage_interview.index">Manage Interview</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Manage Candidates</a>
        </li>

      </ul>


      <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Title</th>
                <th>Status</th>
                <th>Created On</th>
                <th>Edited On</th>
                <th>Edited By</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jobs as $job)
                <tr>
                    <td>{{ $job->title }}</td>
                    <td>{{ ucfirst($job->status) }}</td>
                    <!-- Displaying created_at with formatting -->
                    <td>{{ $job->created_at ? $job->created_at->format('Y-m-d H:i') : 'N/A' }}</td>

                    <!-- Displaying edited_at with formatting, checking for null -->
                    <td>{{ $job->edited_at ? $job->edited_at->format('Y-m-d H:i') : 'N/A' }}</td>

                    <td>{{ $job->editor ? $job->editor->name : 'N/A' }}</td>

                    <td>
                        <a href="{{ route('jppstm.manage_hiring.view', $job->id) }}" class="btn btn-primary">View Job</a>
                        <a href="{{ route('jppstm.manage_hiring.edit', $job->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('jppstm.manage_hiring.destroy', $job->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                        <a href="{{ route('jppstm.manage_hiring.candidates', $job->id) }}" class="btn btn-secondary">Manage Candidates</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@include('components.jppstm.footer')
