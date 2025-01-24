<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <title>Not Qualified Applicants</title>
    <link rel="stylesheet" href="{{ asset('css/manageCandidates.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

@include('components.private.header')
@include('components.private.sidebar')

<body>
    <section class="home-section bg-lightblue">
        <i class='bx bx-menu'></i>

        <div class="container py-4">
            <button class="close" type="button" onclick="window.location.href='{{ route('hrd.manage_hiring.index') }}';">
                <i class="fas fa-times"></i>
            </button>
            <h1>Not Qualified Applicants for Job:</h1>
            <p><strong><u>{{ $job->title }}</u></strong></p>

            @if($rejectedApplicants->isEmpty())
                <p>Nothing is here!</p>
            @else
                <div class="table-responsive">
                    <table id="applicantsTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="title">Applicant Name</th>
                                <th>Status</th>
                                <th>Applied On</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rejectedApplicants as $application)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $application->candidate->name }}</td>
                                    <td>{{ ucfirst($application->application_status) }}</td>
                                    <td>{{ $application->created_at->format('Y-m-d') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </section>

    <script>
        $(document).ready(function() {
            $('#applicantsTable').DataTable({
                "order": [[2, "desc"]], // Sort by Application Date by default
                "columnDefs": [
                    { "orderable": false, "targets": [3, 4] } // Disable sorting for Status and Actions columns
                ],
                "paging": true,
                "searching": true,
                "lengthChange": true,
                "info": true
            });
        });
    </script>
</body>
</html>

@include('components.private.footer')
