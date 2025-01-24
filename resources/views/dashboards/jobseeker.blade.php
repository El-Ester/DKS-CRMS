@include('components.candidates.header')
@include('components.candidates.sidebar')

@section('content')
<section class="home-section bg-lightblue">
    <div class="home-content">
        <i class='bx bx-menu'></i>

        <span class="text text-black">
            @if(auth()->check())
                Welcome, {{ Auth::user()->username }}!
            @else
                Welcome, Guest!
            @endif
        </span>

    </div>

    <div class="container mt-5">
        <h1>Job Seeker Dashboard</h1>

        <!-- Display all available jobs -->
        <h3>Available Job </h3>
        @if($jobs->count() > 0)
            <div class="job-listings">
                @foreach($jobs as $job)
                    <div class="job-post mb-4 p-4 border border-gray-300 rounded">
                        <h4>{{ $job->title }}</h4>
                        <p><strong>Description:</strong> {{ $job->description }}</p>
                        {{-- <p><strong>Location:</strong> {{ $job->location ?? 'Not specified' }}</p> --}}
                        <p><strong>Salary:</strong> ${{ number_format($job->payment_amount, 2) }} / {{ $job->working_period_type ?? 'Not specified' }}</p>
                        <p><strong>Working Period:</strong> {{ $job->working_period_amount ?? 'Not specified' }} {{ $job->working_period_type ?? '' }}</p>
                        <p><strong>Minimum Requirements:</strong> {{ $job->min_requirements ?? 'No requirements listed' }}</p>
                        <p><strong>Documents Required:</strong> {{ $job->document_required ?? 'No documents listed' }}</p>
                        <a href="{{ route('job.apply', $job->id) }}" class="btn btn-primary">Apply Now</a>
                    </div>
                @endforeach
            </div>
        @else
            <p>No job postings available at the moment.</p>
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
        padding: 20px;
        background: #ffffff;
        border-radius: 8px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }

    h1, h3, h4 {
        color: #565656;
    }

    .quick-links ul {
        list-style: none;
        padding-left: 0;
    }

    .quick-links ul li {
        margin: 10px 0;
    }

    .quick-links ul li a {
        color: #007bff;
        text-decoration: none;
    }

    .quick-links ul li a:hover {
        text-decoration: underline;
    }

    .contribution-areas {
        display: flex;
        gap: 20px;
        margin-top: 30px;
    }

    .feature {
        flex: 1;
        background-color: #f9f9f9;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .feature h4 {
        font-size: 1.2rem;
        margin-bottom: 10px;
    }

    .feature p {
        font-size: 1rem;
        margin-bottom: 15px;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }
</style>

    @include('components.candidates.footer')
