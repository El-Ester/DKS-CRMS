<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status</title>

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
            @include('components.admin.header')
            @include('components.admin.sidebar')
        <section class="home-section">

            <div class="container-fluid px-4 py-4">
                <h2>View Case Status</h2>

                <div class="table-responsive">
                    <table id="statusTable">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Case No.</th>
                                <th>Customer Name</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                    </table>

                    <tbody>
                        @foreach ($statuses as $index => $status)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $status->issue_number }}</td>
                                <td>{{ $status->customer_name }}</td>
                                <td>
                                        <span class="badge {{ $case->status->status_title === 'Completed' ? 'bg-success' : 'bg-info text-dark' }}">
                                            {{ $case->status->status_title }}
                                        </span>

                                </td>
                                <td>
                                    <a href="#" title="View">
                                        <span>View</span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </div>
            </div>
        </section>

        @include('components.admin.footer')

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

        <script>
            $(document).ready(function () {
                $('#statusTable').DataTable({
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


