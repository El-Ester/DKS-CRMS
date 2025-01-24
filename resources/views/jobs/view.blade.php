<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/unissalogo.jpg') }}" type="image/jpeg">
    <title>Job Ads</title>
    <link rel="stylesheet" href="{{ asset('css/hiringView.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

@include('components.candidate.header')
@include('components.candidate.sidebar')

<body>

    <section class="home-section bg-lightblue">
            <i class='bx bx-menu'></i>

        <div class="container">
            <h2 class="title">{{ $job->title }}</h2>
            <div class="close-date">Closing Date: {{ $job->close_date ?? 'N/A' }}</div>

            <div class="vacancy-details">
                <p><strong>Job Description:</strong></p>
                <p class="desc">{{ $job->description }}</p>
            </div>

            <div class="requirements">
                <p><strong>Minimum Requirements</strong></p>
                <ul class="desc">
                    @foreach ([
                        $job->education ?? 'N/A',
                        $job->skills ?? 'N/A',
                        ($job->experience ?? 'N/A') . ' years in related field'
                    ] as $item)
                        <li>{{ trim($item) }}</li>
                    @endforeach
                </ul>
            </div>



            <div class="docs">
                <p><strong>Documents Required</strong></p>
                <ul class="desc">
                    @foreach (explode("\n", $job->document_required ?? 'N/A') as $item)
                        <li>{{ trim($item) }}</li>
                    @endforeach
                </ul>
            </div>


            <div class="payment-period">
                <div><strong>Payment:</strong> BND {{ $job->payment_amount ?? 'N/A' }} {{ ucfirst(str_replace('_', ' ', $job->payment_type ?? 'N/A')) }}</div>
                <div><strong>Working Period:</strong> {{ $job->working_period ?? 'N/A' }}</div>
            </div>

            <div class="actions">
                {{-- <a href="{{ url('/') }}" class="btn btn-secondary">Back</a> --}}
                <a href="{{ route('jobs.index') }}" class="btn btn-secondary">Back</a>
                {{-- <a href="{{ route('candidate.login') }}" class="btn btn-primary">Apply</a> --}}
            </div>
        </div>
</body>
</html>

@include('components.candidate.footer')
