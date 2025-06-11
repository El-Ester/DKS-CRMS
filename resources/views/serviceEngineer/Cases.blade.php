<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cases</title>

    <link rel="icon" href="{{ asset('images/DKS_Logo_no.bg.png') }}" type="image/png">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/Cases.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    @include('components.engineer.header')
    @include('components.engineer.sidebar')

    <section class="home-section">
        <div class="container-fluid px-4 py-4">
            <h2>Cases</h2>

            <div class="table-responsive">
                <table id="casesTable">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Case No.</th>
                            <th>Status</th>
                            <th>Customer Name</th>
                            <th>Company</th>
                            <th>Contact No.</th>
                            <th>Customer Email</th>
                            <th>Last Modified By</th>
                            <th>Last Modified Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cases as $index => $case)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $case->issue_number }}</td>
                                <td>
                                    <span class="badge {{ $case->status->status_title === 'Completed' ? 'bg-success' : 'bg-info text-dark' }}">
                                        {{ $case->status->status_title }}
                                    </span>
                                </td>
                                <td>{{ $case->customer_name }}</td>
                                <td>{{ $case->company }}</td>
                                <td>{{ $case->contact_no }}</td>
                                <td>{{ $case->customer_email }}</td>
                                <td>{{ $case->user->user_name ?? 'N/A' }}</td>
                                <td>{{ \Carbon\Carbon::parse($case->updated_at)->format('d M Y') }}</td>
                                <td>
                                    <div>
                                    <a href="{{ route('cases.show', $case->issue_id) }}" title="View">
                                        <i class="fas fa-eye"></i>View
                                    </a>
                                    </div>
                                    <div>
                                    <a href="{{ route('cases.edit', $case->issue_id) }}" title="Edit">
                                        <i class="fas fa-edit"></i>Edit
                                    </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    @include('components.engineer.footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#casesTable').DataTable({
                pageLength: 10,
                lengthMenu: [10, 25, 50, 100],
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search..."
                }
            });

            @if(session('success'))
                toastr.success("{{ session('success') }}");
            @endif

            @if(session('error'))
                toastr.error("{{ session('error') }}");
            @endif

            @if(session('info'))
                toastr.info("{{ session('info') }}");
            @endif

            @if(session('warning'))
                toastr.warning("{{ session('warning') }}");
            @endif
        });
    </script>
</body>
</html>
