<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/DKS_Logo_no.bg.png') }}" type="image/jpeg">
    <title>View Case</title>
    <link rel="stylesheet" href="{{ asset('css/ViewCases.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

@include('components.admin.header')
@include('components.admin.sidebar')

<body>
    <section class="home-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Case Number:</strong> {{ $case->issue_number }}</p>
                    <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($case->issue_date)->format('Y-m-d') }}</p>
                    <p><strong>Status:</strong> {{ $case->status->status_title ?? '-' }}</p>
                    <p><strong>Current DKS Staff:</strong> {{ $case->user->user_name ?? '-' }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Customer Name:</strong> {{ $case->customer_name }}</p>
                    <p><strong>Company/Organisation:</strong> {{ $case->company }}</p>
                    <p><strong>Contact Number:</strong> {{ $case->contact_no }}</p>
                    <p><strong>Customer Email:</strong> {{ $case->customer_email }}</p>
                </div>
            </div>

            <div class="mt-4 bg-secondary text-white p-2">
                <strong>Collected Item(s) (Model & S/N)</strong>
            </div>
            <ul class="list-group mb-3">
                @forelse($case->items as $item)
                    <li class="list-group-item">{{ $item->items_name }}</li>
                @empty
                    <li class="list-group-item text-muted">No items listed</li>
                @endforelse
            </ul>

            <div class="row">
                <div class="col-md-6">
                    <p><strong>Problem Statement (Customer):</strong> {{ $case->problem_statement }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Problem Verification (DKS Staff):</strong> {{ $case->problem_verification }}</p>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-4"><p><strong>Diagnostic Date:</strong> {{ $case->diagnostic_date ?? '-' }}</p></div>
                <div class="col-md-4"><p><strong>Completion Date:</strong> {{ $case->completion_date ?? '-' }}</p></div>
                <div class="col-md-4"><p><strong>Service Engineer:</strong> {{ $case->service_engineer ?? '-' }}</p></div>
            </div>

            <p><strong>Repair Cost:</strong>
                {{ $case->repair_cost !== null ? 'RM ' . number_format((float) $case->repair_cost, 2, '.', '') : '-' }}
            </p>

            <p><strong>Work Description:</strong> {{ $case->work_description ?? '-' }}</p>

            <div class="d-flex gap-2 mt-4">
                <a href="{{ route('cases.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i>
                </a>

                <a href="{{ route('cases.generateCaseReport', $case->issue_id) }}" class="btn btn-primary">
                    <i class="fas fa-file-alt"></i> Generate New Case Report
                </a>

                <a href="{{ route('cases.generateFinalDiagnosticReport', $case->issue_id) }}" class="btn btn-success">
                    <i class="fas fa-file-medical-alt"></i> Generate Final Diagnostic Report
                </a>
            </div>
        </div>
    </section>
</body>
</html>
@include('components.admin.footer')
