<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <link rel="stylesheet" href="{{ asset('css/jobsIndex.css') }}">
        <title>Job Applications</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    </head>

    @include('components.candidate.header')
    @include('components.candidate.sidebar')

    <body>
        <section class="home-section bg-lightblue">
            <i class='bx bx-menu'></i>

            <div class="container">

                <h1>Available Jobs</h1>
                <hr>
                <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Closing Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jobs as $job)
                            <tr>
                                <td>{{ $job->title }}</td>
                                <td>{{ $job->close_date }}</td>
                                <td>
                                    <div class="action-icons">
                                        <!-- View Icon -->
                                        <a href="{{ route('jobs.view', $job->id) }}" class="text-secondary" title="View">
                                            <i class="fas fa-eye fa-lg"></i>
                                        </a>

                                        <!-- Apply Icon -->
                                        <a href="javascript:void(0)" onclick="confirmApply({{ $job->id }})" class="text-primary" title="Apply">
                                            <i class="fas fa-paper-plane fa-lg"></i>
                                        </a>
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>

                <br>
                <br>
                <br>
                <hr>

                <h1>Applied Jobs</h1>
                <div class="table-responsive">

                    <table class="table table-bordered" id="appliedJobsTable">
                        <thead>
                            <tr>
                                <th>Job Title</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($appliedJobs as $application)
                                <tr>
                                    <td>{{ $application->job->title ?? 'Job Not Found' }}</td>
                                    <td>
                                        @switch($application->application_status)
                                            @case('pending')
                                                <span class="text-warning">{{ ucfirst($application->application_status) }}</span>
                                                @break
                                            @case('accepted')
                                                <span class="text-success">{{ ucfirst($application->application_status) }}</span>
                                                @break
                                            @case('rejected')
                                                <span class="text-danger">{{ ucfirst($application->application_status) }}</span>
                                                @break
                                            @case('reviewed')
                                                <span class="text-primary">{{ ucfirst($application->application_status) }}</span>
                                                @break
                                            @case('schedule interview')
                                                <span class="text-info">{{ ucfirst($application->application_status) }}</span>
                                                @break
                                            @case('interviewed')
                                                <span class="text-secondary">{{ ucfirst($application->application_status) }}</span>
                                                @break
                                            @case('put on hold')
                                                <span class="text-muted">{{ ucfirst($application->application_status) }}</span>
                                                @break
                                            @case('not a fit')
                                                <span class="text-dark">{{ ucfirst($application->application_status) }}</span>
                                                @break
                                            @case('hire')
                                                <span class="text-success">{{ ucfirst($application->application_status) }}</span>
                                                @break
                                            @case('hired')
                                                <span class="text-success">{{ ucfirst($application->application_status) }}</span>
                                                @break
                                            @default
                                                <span class="text-muted">No Status</span>
                                        @endswitch
                                    </td>
                                    <td>
                                        <!-- Delete Button -->
                                        <form action="{{ route('jobApplication.destroy', $application->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-center">No jobs applied yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>


                </div>



                        <script>
                            function confirmApply(jobId) {
                                if (confirm("Do you want to apply for this job?")) {
                                    window.location.href = `/job-applications/apply/${jobId}`;
                                }
                            }

                            $(document).ready(function() {
                            $('#appliedJobsTable').DataTable({
                                // Optional DataTables settings
                                paging: true,       // Enable pagination
                                searching: true,    // Enable search bar
                                ordering: true,     // Enable sorting
                                info: true          // Show info text like "Showing 1 to 10 of 50 entries"
                            });
                        });
                        </script>
            </div>

        </section>
    </body>
</html>
@include('components.candidate.footer')
