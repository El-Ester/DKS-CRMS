<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <title>Manage Applicants</title>
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
            <h1>Manage Applicants for Job:</h1>
            <p><strong><u>{{ $job->title }}</u></strong></p>

            @if($candidates->isEmpty())
                <p>No applicants found for this job.</p>
            @else
                <div class="table-responsive">
                    <table id="applicantsTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Applicant Name</th>
                                <th>Application Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($candidates as $application)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $application->candidate->name }}</td>
                                <td>{{ $application->created_at->format('Y-m-d H:i') }}</td>
                                <td>
                                    <form action="{{ route('hrd.update_application_status', $application->id) }}" method="POST" id="statusForm-{{ $application->id }}">
                                        @csrf
                                        @method('PUT')
                                        <select name="application_status" class="form-select form-select-sm" onchange="showConfirmationModal('{{ $application->id }}')">
                                            @foreach (['pending', 'accepted', 'rejected', 'reviewed', 'schedule interview', 'interviewed', 'put on hold', 'not a fit', 'hire', 'hired'] as $status)
                                                <option value="{{ $status }}" {{ $application->application_status === $status ? 'selected' : '' }}>
                                                    {{ ucfirst($status) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </form>
                                </td>
                                <td>
                                    <a href="{{ route('hrd.manage_candidates.view', $application->candidate->id) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </section>

    <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationModalLabel">Confirm Action</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to update the application status?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" id="confirmButton" class="btn btn-primary">Confirm</button>
                </div>
            </div>
        </div>
    </div>

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

        let formToSubmit;

        // Function to show the confirmation modal
        function showConfirmationModal(applicationId) {
            formToSubmit = document.getElementById('statusForm-' + applicationId);
            // Show the confirmation modal
            $('#confirmationModal').modal('show');
        }

        // Function to confirm and submit the form
        document.getElementById('confirmButton').addEventListener('click', function() {
            // Submit the form
            formToSubmit.submit();
            // Close the modal
            $('#confirmationModal').modal('hide');
        });
    </script>
</body>
</html>

@include('components.private.footer')
