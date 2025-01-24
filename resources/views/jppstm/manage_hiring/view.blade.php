@include('components.jppstm.header')
@include('components.jppstm.sidebar')

<section class="home-section bg-lightblue">
    <div class="home-content">
        <i class='bx bx-menu'></i>
        <span class="text text-black">Job Advertisement</span>
    </div>

<!-- Styling for the Job Poster -->
<style>
    .job-poster {
        position: relative;
        background-image: url('{{asset('images/pic2.jpeg')}}');
        /* background-image: url('{{ asset('images/pic1.jpeg') }}'); You can use an image */
        background-size: cover; /* Cover the entire poster */
        background-position: center; /* Center the background */
        width: 80%;
        margin: 0 auto;
        padding: 20px;
        background-color: #dedede;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .job-poster::before {
    content: ''; /* Empty content for the pseudo-element */
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: url('{{ asset('images/background.jpg') }}'); /* Path to your background image */
    background-size: cover; /* Ensures the image covers the entire poster area */
    background-position: center; /* Centers the image */
    opacity: 0.5; /* Set the opacity for the image (0 is fully transparent, 1 is fully opaque) */
    z-index: -1; /* Ensures the background image is behind the content */
}
    .job-poster h2 {
        font-weight: bolder;
        font-size: 3rem;
        color: #007bff;
        margin-bottom: 15px;
    }

    .job-poster p {
        font-size: 1.5rem;
        color: #333;
        margin-bottom: 10px;
        line-height: 1.6;
    }

    .th{
        font-size: 10px;
    }

    .job-poster .status {
        font-size: 2rem;
        font-weight: bold;
        color: #00bd0d;
        background-color: #ffffff8a;
        padding: 3px 30px;
        border-radius: 4px;
        margin-top: 20px;
        text-align: center;
    }

    .job-poster .status.draft {
        background-color: #ffbf00;
    }

    .job-poster .status.closed {
        background-color: #d02637;
    }

    .job-poster .actions {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    .job-poster .actions a {
        background-color: #0055af;
        color: white;
        padding: 10px 20px;
        margin: 0 10px;
        border-radius: 5px;
        text-decoration: none;
        font-weight: bold;
    }

    .job-poster .actions a:hover {
        background-color: #007bff;
    }

    .job-poster .table1 {
    width: 100%; /* Make the table take the full width of the container */
    border-collapse: collapse; /* Remove space between table cells */
    margin-top: 20px; /* Add space above the table */
    background-color: rgba(0, 0, 0, 0.1); /* Set a transparent black background */
    border: 1px solid black; /* Set a black border around the table */
}

.job-poster .table1 th,
.job-poster .table1 td {
    padding: 10px; /* Add padding inside each table cell */
    text-align: left; /* Align text to the left by default */
    border: 1px solid black; /* Add a black border around each cell */
}

.job-poster .table1 th {
    background-color: rgba(255, 255, 255, 0); /* Set a slightly darker transparent black background for headers */
    font-weight: bold; /* Make header text bold */
    text-align: center; /* Center align text in table headers */
}

.job-poster .table1 td {
    background-color: rgba(255, 255, 255, 0.6); /* Set a slightly transparent white background for cells */
}

.job-poster .table1 tr:nth-child(even) {
    background-color: rgba(255, 255, 255, 0.4); /* Alternating row colors for better readability */
}

.job-poster .table1 td p {
    font-size: 14px; /* Adjust the font size as needed */
    margin: 0; /* Remove extra margins */
    padding-left: 10px; /* Add space before the dash */
}

.job-poster .table1 td{
    padding: 8px; /* Adds padding to table cells for better spacing */
    text-align: left; /* Align text to the left */
}

.job-poster .table1 th {
    font-size: 16px; /* Adjust the header size */
    font-weight: bold; /* Ensure headers stand out */
}

.job-poster .table1 td {
    font-size: 14px; /* Ensure the content text is readable and not too large */
    line-height: 1.5; /* Adjust line height for readability */
}

.job-poster .table1 p {
    margin: 0;
}
</style>

<div class="container">

<!-- Job Advertisement Poster -->
<div class="job-poster">
    <div class="status {{ $job->status }}">
        {{ ucfirst($job->status) }}
    </div>

    <h2>{{ $job->title }}</h2>

    <p><strong>Job Description:</strong></p>
    <p>{{ $job->description }}</p>

    <!-- Payment -->
    <p><strong>Payment:</strong></p>
    <p> BND
        {{ $job->payment_amount ?? 'N/A' }}
        {{ ucfirst(str_replace('_', ' ', $job->payment_type ?? 'N/A')) }}
    </p>

    <!-- Working Period -->
    <p><strong>Working Period:</strong></p>
    <p>
        {{ $job->working_period_amount ?? 'N/A' }}
        {{ ucfirst($job->working_period_type ?? 'N/A') }}
    </p>

    <table class="table1">
        <thead>
            <tr>
                <th><strong>Minimum Requirements</strong></th>
                <th><strong>Documents Required</strong></th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>
                    @foreach (explode("\n", $job->min_requirements ?? 'N/A') as $item)
                        <p>- {{ trim($item) }}</p>
                    @endforeach
                </td>
                <td>
                    @foreach (explode("\n", $job->document_required ?? 'N/A') as $item)
                        <p>- {{ trim($item) }}</p>
                    @endforeach
                </td>

            </tr>
        </tbody>
    </table>

       <!-- Open and Closing Date -->
       <p><strong>Open Date:</strong></p>
       <p>
           {{ $job->open_date ?? 'N/A' }}
           {{-- {{ ucfirst($job->working_period_type ?? 'N/A') }} --}}
       </p>

       <p><strong>Close on:</strong></p>
       <p>
        {{ $job->close_date ?? 'N/A' }}
       </p>


    <div class="actions">
        <a href="{{ route('jppstm.manage_hiring.index') }}">Go Back</a>
        <a href="{{ route('jppstm.manage_hiring.edit', $job->id) }}">Edit Job</a>
    </div>
</div>


</div>
@include('components.jppstm.footer')
