<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <title>Applicants Details</title>
    <link rel="stylesheet" href="{{ asset('css/manageCandidates.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

@include('components.private.header')
@include('components.private.sidebar')

<body>
    <section class="home-section bg-lightblue">

        <i class='bx bx-menu'></i>

        <div class="container">

            <button class="close" type="button" onclick="window.location.href='{{ route('hrd.manage_candidates.index', ['jobId' => $jobId]) }}';">
                <i class="fas fa-times"></i>
            </button>

        <h1>APPLICANTS DETAILS</h1>
        <div class="card">
            <div class="card-header">
                Personal Details
            </div>
            <div class="card-body">
                <!-- Candidate Picture -->
                {{-- <div class="candidate-picture mb-4">
                    @if($candidate->picture)
                        <img src="{{ asset('storage/' . $candidate->picture->image_url) }}" alt="Candidate Picture" class="img-fluid" style="max-width: 150px; height: auto;">
                    @else
                        <img src="{{ asset('images/default-profile.png') }}" alt="Default Candidate Picture" class="img-fluid" style="max-width: 150px; height: auto;">
                    @endif
                </div> --}}

                <!-- Personal Details -->
                <p><strong>Name:</strong> {{ $candidate->personalDetails->name ?? 'No Name Available' }}</p>
                <p><strong>Identity Card No.:</strong> {{ $candidate->personalDetails->identity_card_no ?? 'N/A' }}</p>
                <p><strong>Date of Issue:</strong> {{ $candidate->personalDetails->date_of_issue ?? 'N/A' }}</p>
                <p><strong>Date of Birth:</strong> {{ $candidate->personalDetails->date_of_birth ?? 'N/A' }}</p>
                <p><strong>Age:</strong> {{ $candidate->personalDetails->age ?? 'N/A' }}</p>
                <p><strong>Place of Birth:</strong> {{ $candidate->personalDetails->place_of_birth ?? 'N/A' }}</p>
                <p><strong>Gender:</strong> {{ $candidate->personalDetails->gender ?? 'N/A' }}</p>
                <p><strong>Marital Status:</strong> {{ $candidate->personalDetails->marital_status ?? 'N/A' }}</p>
                <p><strong>Race:</strong> {{ $candidate->personalDetails->race ?? 'N/A' }}</p>
                <p><strong>Religion:</strong> {{ $candidate->personalDetails->religion ?? 'N/A' }}</p>
                <p><strong>Citizenship:</strong> {{ $candidate->personalDetails->citizenship ?? 'N/A' }}</p>
                <p><strong>Email:</strong> {{ $candidate->personalDetails->email ?? 'N/A' }}</p>
                <p><strong>Tel. Mobile:</strong> {{ $candidate->personalDetails->tel_mobile ?? 'N/A' }}</p>
                <p><strong>Tel. House:</strong> {{ $candidate->personalDetails->tel_house ?? 'N/A' }}</p>
                <p><strong>Address:</strong>
                    {{ implode(', ', array_filter([
                        $candidate->personalDetails->permanent_address_line1 ?? 'N/A',
                        $candidate->personalDetails->permanent_address_line2 ?? '',
                        $candidate->personalDetails->permanent_country ?? '',
                        $candidate->personalDetails->permanent_province ?? '',
                        $candidate->personalDetails->permanent_postal_code ?? ''
                    ])) }}
                </p>
                <!-- Add other personal details here -->
            </div>
        </div>


        <div class="card mt-4">
            <div class="card-header">
                SCHOOLS ATTENDED (UPPER SECONDARY) AND QUALIFICATIONS OBTAINED
            </div>
            <div class="card-body">
                @if($candidate->schoolQualifications && $candidate->schoolQualifications->isNotEmpty())
                    @foreach($candidate->schoolQualifications as $qualification)
                        <p><strong>Qualification Obtained:</strong> {{ $qualification->school_qualification ?? 'N/A' }}</p>
                        <p><strong>Certificate Title:</strong> {{ $qualification->certificate_title ?? 'N/A' }}</p>
                        <p><strong>School/College Name:</strong> {{ $qualification->school_college_name ?? 'N/A' }}</p>
                        <p><strong>Certificate Date:</strong> {{ $qualification->certificate_date ?? 'N/A' }}</p>
                        <p><strong>Results:</strong> {{ $qualification->college_result ?? 'N/A' }}</p>
                        <p><strong>MOE accreadiation:</strong> {{ $qualification->moe_accreditation ?? 'N/A' }}</p>
                        <h5 class="mt-3">Subject Results:</h5>
                        <table class="table table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>Subject</th>
                                    <th>Result</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Bahasa Melayu</td>
                                    <td>{{ $qualification->bahasa_melayu_result ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td>English</td>
                                    <td>{{ $qualification->english_result ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td>Mathematics</td>
                                    <td>{{ $qualification->mathematics_result ?? 'N/A' }}</td>
                                </tr>

                                <!-- Loop through other subjects and their results -->
                                @if($qualification->other_subjects)
                                    @php
                                        $otherSubjects = explode(',', $qualification->other_subjects);
                                        $subjectsResults = explode(',', $qualification->subjects_result);
                                    @endphp
                                    @foreach($otherSubjects as $index => $subject)
                                        <tr>
                                            <td>{{ $subject }}</td>
                                            <td>{{ $subjectsResults[$index] ?? 'N/A' }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>

                        <hr>
                    @endforeach
                @else
                    <p>No qualifications found.</p>
                @endif
            </div>
        </div>


        <div class="card mt-4">
            <div class="card-header">
                HIGHER EDUCATION AND PROFESSIONAL QUALIFICATIONS
            </div>
            <div class="card-body">
                @if($candidate->higherEducationQualifications && $candidate->higherEducationQualifications->isNotEmpty())
                    @foreach($candidate->higherEducationQualifications as $qualification)
                        <p><strong>Qualification Obtained:</strong> {{ $qualification->qualification_type ?? 'N/A' }}</p>
                        <p><strong>University / College Name:</strong> {{ $qualification->university_name ?? 'N/A' }}</p>
                        <p><strong>University / College Country:</strong> {{ $qualification->university_country ?? 'N/A' }}</p>
                        <p><strong>Certificate Name:</strong> {{ $qualification->certificate_name ?? 'N/A' }}</p>
                        <p><strong>Certificate Date:</strong> {{ $qualification->certificate_date ?? 'N/A' }}</p>
                        <p><strong>Results:</strong> {{ $qualification->overall_result ?? 'N/A' }}</p>
                        <p><strong>MOE Accreditation:</strong> {{ $qualification->moe_accreditation ?? 'N/A' }}</p>

                        <h5 class="mt-3">Subject Results:</h5>
                        <table class="table table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>Subject</th>
                                    <th>Result</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Loop through courses and their results -->
                                @foreach($qualification->courses as $course)
                                    <tr>
                                        <td>{{ $course->course_name ?? 'N/A' }}</td>
                                        <td>{{ $course->course_result ?? 'N/A' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <hr>
                    @endforeach
                @else
                    <p>No qualifications found.</p>
                @endif
            </div>
        </div>



        <div class="card mt-4">
            <div class="card-header">
                Trainings
            </div>
            <div class="card-body">
                    @foreach($candidate->trainings as $training)
                        <p><strong>Training Name:</strong> {{ $training->training_name }}<br></p>
                        <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($training->date)->format('Y-m-d') }}<br></p>
                        <p><strong>Organiser:</strong> {{ $training->organiser }}</p>
                    @endforeach
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                Referees
            </div>
            <div class="card-body">
                <ul>
                    @foreach($candidate->referees as $referee)
                        <li>{{ $referee->name }} ({{ $referee->relation }})</li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                Previous Employment History
            </div>
            <div class="card-body">
                @if($candidate->previousEmployments->isNotEmpty())
                    <ul>
                        @foreach($candidate->previousEmployments as $previousEmployment)
                            <li>{{ $previousEmployment->employer_name }} - {{ $previousEmployment->post_name }}</li>
                        @endforeach
                    </ul>
                @else
                    <p>No previous employment history available.</p>
                @endif
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                Current Employment
            </div>
            <div class="card-body">
                @if($candidate->currentEmployment)
                    <ul>
                        <li>{{ $candidate->currentEmployment->employer_name }} - {{ $candidate->currentEmployment->post_name }}</li>
                    </ul>
                @else
                    <p>No current employment information available.</p>
                @endif
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                Family Details
            </div>
            <div class="card-body">
                        <div class="family-detail mb-3">
                            <p><strong>Name:</strong> {{ $candidate->familyDetails->name ?? 'N/A' }}</p>
                            <p><strong>Relation:</strong> {{ $candidate->familyDetails->relation ?? 'N/A' }}</p>
                            <p><strong>IC No.:</strong> {{ $candidate->familyDetails->ic_no ?? 'N/A' }}</p>
                            <p><strong>Date of Birth:</strong> {{ $candidate->familyDetails->d_o_b ?? 'N/A' }}</p>
                            <p><strong>Age:</strong> {{ $candidate->familyDetails->age ?? 'N/A' }}</p>
                            <p><strong>Occupation/Education:</strong> {{ $candidate->familyDetails->occupation_or_education ?? 'N/A' }}</p>
                            <p><strong>Address:</strong> {{ $candidate->familyDetails->address ?? 'N/A' }}</p>
                            <p><strong>Date of Demise:</strong> {{ $candidate->familyDetails->date_of_demise ?? 'N/A' }}</p>
                            <hr>
                        </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </section>
</body>
</html>

@include('components.private.footer')
