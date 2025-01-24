<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Hiring</title>
    <link rel="stylesheet" href="{{ asset('css/hiringIndex.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
</head>

@include('components.private.header')
@include('components.private.sidebar')

<body>
    <section class="home-section bg-lightblue">
        <i class='bx bx-menu'></i>

        <div class="container">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                <a class="nav-link active" href="{{ route('hrd.manage_hiring.index') }}">Job Openings</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="hrd.manage_interview.index">Manage Interview</a>
                </li>
                {{-- <li class="nav-item">
                <a class="nav-link" href="#">Manage Candidates</a>
                </li> --}}
            </ul>

            <a class="btn btn-primary1" href="{{ route('hrd.manage_hiring.create') }}">
                <i class="bi bi-plus-lg"></i> Add Job
            </a>


            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="title">Title</th>
                        <th>Status</th>
                        <th>Created On</th>
                        {{-- <th>Edited On</th> --}}
                        {{-- <th>Edited By</th> --}}
                        <th>Actions</th>
                    </tr>
                </thead>
                    <tbody>
                        @foreach($jobs as $job)
                            <tr>
                                <td><br><strong>{{ $job->title }}</strong></td>
                                <td><br>{{ ucfirst($job->status) }}</td>

                                <!-- Displaying created_at with formatting -->
                                <td>
                                    <div>
                                        {{ $job->created_at ? $job->created_at->format('Y-m-d') : 'N/A' }}
                                    </div>
                                    <br>
                                    <div>
                                        {{ $job->created_at ? $job->created_at->format('H:i') : 'N/A' }}
                                    </div>

                                </td>

                                <!-- Displaying edited_at with formatting, checking for null -->
                                {{-- <td>{{ $job->edited_at ? $job->edited_at->format('Y-m-d H:i') : 'N/A' }}</td> --}}

                                {{-- <td>{{ $job->editor->name }}</td> <!-- Display HRD user's name --> --}}

                                <td>
                                    <!-- View Job -->
                                    <a href="{{ route('hrd.manage_hiring.view', $job->id) }}" class="btn btn-primary">View</a>

                                    <!--Edit Job -->
                                    <a href="{{ route('hrd.manage_hiring.edit', $job->id) }}" class="btn btn-warning">Edit</a>

                                    <!-- Delete Form -->
                                    <form action="{{ route('hrd.manage_hiring.destroy', $job->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>

                                    <!-- Manage Candidates -->
                                    <a href="{{ route('hrd.manage_candidates.index', $job->id) }}" class="btn btn-secondary">Manage Applicants</a>
                                    <a href="{{ route('hrd.manage_candidates.rejected', $job->id) }}" class="btn btn-danger">Not Qualified Applicants</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
            </table>
        </div>
    </section>
</body>
</html>
@include('components.private.footer')
