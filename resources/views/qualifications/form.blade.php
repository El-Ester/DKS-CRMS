<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/unissalogo.jpg') }}" type="image/jpeg">
    <title>Qualification</title>
    <link rel="stylesheet" href="{{ asset('css/qualification.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

@include('components.candidate.header')
@include('components.candidate.sidebar')

<body>
    <section class="home-section bg-lightblue">
        <i class='bx bx-menu'></i>

        <div class="container py-4">
            <h1>Qualifications Details</h1>
            <hr>
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>QUALIFICATIONS [SCHOOLS ATTENDED (UPPER SECONDARY) AND QUALIFICATIONS OBTAINED]</h2>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSchoolQualificationModal">
                    <i class="bi bi-plus-circle"></i> Add
                </button>
            </div>


            <!-- ADD SCHOOL QUALIFICATION MODAL -->
            <div class="modal fade" id="addSchoolQualificationModal" tabindex="-1" aria-labelledby="addSchoolQualificationModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addSchoolQualificationModalLabel">QUALIFICATIONS [SCHOOLS ATTENDED (UPPER SECONDARY) AND QUALIFICATIONS OBTAINED]</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('school-qualifications.store') }}" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate>
                                @csrf

                                <div class="form-group">
                                    <label for="school_qualification">QUALIFICATIONS OBTAINED: </label>
                                    <select class="form-control" id="school_qualification" name="school_qualification" required onchange="updateResultOptions()">
                                        <option value="">--select--</option>
                                        <option value="O_Level">ORDINARY LEVEL ('O' LEVEL) OR EQUIVALENT</option>
                                        <option value="SPUB">SIJIL PEPERIKSAAN UGAMA BRUNEI (SPUB) OR EQUIVALENT</option>
                                        <option value="A_Level">ADVANCED LEVEL ('A' LEVEL) OR EQUIVALENT</option>
                                        <option value="STPUB">SIJIL TINGGI PEPERIKSAAN UGAMA BRUNEI (STPUB) OR EQUIVALENT</option>
                                    </select>
                                </div>

                                <div id="qualification_details" class="mt-3">
                                    <!-- O' Level Details -->
                                    <div id="O_Level" class="qualification-section">
                                        <h3 id="qualification_title"><i>Qualification Obtained</i></h3>
                                        <div class="form-group">
                                            <label for="certificate_title">Certificate Title (if other than 'O' LEVEL or Equivalent):</label>
                                            <input type="text" class="form-control" id="certificate_title" name="certificate_title">
                                        </div>

                                        <div class="form-group">
                                            <label for="school_college_name">School/College:</label>
                                            <input type="text" class="form-control" id="school_college_name" name="school_college_name">
                                        </div>
                                        <div class="form-group">
                                            <label for="certificate_date">Certificate Date:</label>
                                            <input type="date" class="form-control" id="certificate_date" name="certificate_date">
                                        </div>

                                        <div class="form-group">
                                            <label for="college_result">Result:</label>
                                            <select class="form-control" id="college_result" name="college_result"></select>
                                        </div>

                                        <h4>Subject Taken and Result:</h4>
                                        <!-- Bahasa Melayu -->
                                        <div class="form-group">
                                            <label for="bahasa_melayu_result">Bahasa Melayu:</label>
                                            <select class="form-control" id="bahasa_melayu_result" name="bahasa_melayu_result"></select>
                                        </div>

                                        <!-- English -->
                                        <div class="form-group">
                                            <label for="english_result">English:</label>
                                            <select class="form-control" id="english_result" name="english_result"></select>
                                        </div>

                                        <!-- Mathematics -->
                                        <div class="form-group">
                                            <label for="mathematics_result">Mathematics:</label>
                                            <select class="form-control" id="mathematics_result" name="mathematics_result"></select>
                                        </div>

                                        <h4>Other Subjects Taken & Result:</h4>

                                        <div id="subject-fields">
                                            <div class="subject-entry">
                                                <label for="other_subjects">Other Subject:</label>
                                                <input type="text" name="other_subjects[]" class="form-control mb-2" placeholder="Enter subject">

                                                <label for="subjects_result">Subject Result:</label>
                                                <select name="subjects_result[]" class="form-control mb-2">
                                                    <option value="">Select result</option>
                                                    <option value="0">0</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                    <option value="7">7</option>
                                                    <option value="8">8</option>
                                                    <option value="A">A</option>
                                                    <option value="B">B</option>
                                                    <option value="C">C</option>
                                                    <option value="D">D</option>
                                                    <option value="E">E</option>
                                                    <option value="F">F</option>
                                                </select>
                                            </div>
                                        </div>

                                        <button type="button" class="btn btn-success mb-4" id="add_subject_button"><i class="bi bi-plus"></i>Add</button>
                                        <button type="button" class="btn btn-danger mb-4" id="remove_subject_button"><i class="bi bi-dash"></i>Remove</button>

                                        <div class="form-group">
                                            <label for="moe_accreditation">MOE Accreditation:</label>
                                            <input type="text" name="moe_accreditation" class="form-control mb-2" placeholder="Enter MOE Accreditation">
                                        </div>

                                        <!-- Dynamic Subject Fields -->
                                        <div id="other_subjects_container"></div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- QUALIFICATION DISPLAY -->
<div class="qualification-display">


    @if($qualifications->isNotEmpty())
        @foreach($qualifications as $qualification)
            <div class="mb-4">
                <p class="fw-bold">
                    <span class="text-uppercase">
                        @switch($qualification->school_qualification)
                            @case('O_Level')
                                GENERAL CERTIFICATE OF EDUCATION ORDINARY LEVEL ('O' LEVEL) OR EQUIVALENT
                                @break
                            @case('SPUB')
                                SIJIL PEPERIKSAAN UGAMA BRUNEI (SPUB) OR EQUIVALENT
                                @break
                            @case('A_Level')
                                GENERAL CERTIFICATE OF EDUCATION ADVANCED LEVEL ('A' LEVEL) OR EQUIVALENT
                                @break
                            @case('STPUB')
                                SIJIL TINGGI PEPERIKSAAN UGAMA BRUNEI (STPUB) OR EQUIVALENT
                                @break
                            @default
                                {{ $qualification->school_qualification ?? '' }}
                        @endswitch
                    </span>
                </p>
                <p class="text"><strong>Certificate Title:</strong> <span>{{ $qualification->certificate_title ?? '' }}</span></p>
                <p class="text"><strong>School / College Name:</strong> <span>{{ $qualification->school_college_name ?? '' }}</span></p>
                <p class="text"><strong>Certificate Date:</strong> <span>{{ $qualification->certificate_date ?? '' }}</span></p>
                <p class="text"><strong>Result:</strong> <span>{{ $qualification->college_result ?? '' }}</span></p>

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
                            <td>{{ $qualification->bahasa_melayu_result ?? '' }}</td>
                        </tr>
                        <tr>
                            <td>English</td>
                            <td>{{ $qualification->english_result ?? '' }}</td>
                        </tr>
                        <tr>
                            <td>Mathematics</td>
                            <td>{{ $qualification->mathematics_result ?? '' }}</td>
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
                                    <td>{{ $subjectsResults[$index] ?? '' }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>

                <!-- Delete Button -->
                <form action="{{ route('school-qualifications.destroy', $qualification->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
            <hr class="my-4">
        @endforeach
    @else
        <p class="text-center">No qualifications added yet. Please add your qualifications.</p>
    @endif
</div>


            <script>
    document.getElementById('add_subject_button').addEventListener('click', function () {
        const subjectFields = document.getElementById('subject-fields');
        const newEntry = document.createElement('div');
        newEntry.classList.add('subject-entry');
        newEntry.innerHTML = `
            <label for="other_subjects">Other Subject:</label>
            <input type="text" name="other_subjects[]" class="form-control mb-2" placeholder="Enter subject">

            <label for="subjects_result">Subject Result:</label>
            <select name="subjects_result[]" class="form-control mb-2">
                <option value="">Select result</option>
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
                <option value="E">E</option>
                <option value="F">F</option>
            </select>
        `;
        subjectFields.appendChild(newEntry);
    });

    document.getElementById('remove_subject_button').addEventListener('click', function () {
        const subjectFields = document.getElementById('subject-fields');
        const entries = subjectFields.getElementsByClassName('subject-entry');
        if (entries.length > 1) {
            subjectFields.removeChild(entries[entries.length - 1]);
        } else {
            alert('You need to have at least one subject entry.');
        }
    });

                // Change the heading based on the selected qualification
                document.getElementById('school_qualification').addEventListener('change', function() {
                    var selectedQualification = this.value;
                    var titleElement = document.getElementById('qualification_title');

                    switch (selectedQualification) {
                        case 'O_Level':
                            titleElement.textContent = "ORDINARY LEVEL ('O' LEVEL)";
                            break;
                        case 'SPUB':
                            titleElement.textContent = "SIJIL PEPERIKSAAN UGAMA BRUNEI (SPUB)";
                            break;
                        case 'A_Level':
                            titleElement.textContent = "ADVANCED LEVEL ('A' LEVEL)";
                            break;
                        case 'STPUB':
                            titleElement.textContent = "SIJIL TINGGI PEPERIKSAAN UGAMA BRUNEI (STPUB)";
                            break;
                        default:
                            titleElement.textContent = "Select";  // Default value
                    }
                });

                document.getElementById('higher_qualification').addEventListener('change', function() {
                    var selectedQualification = this.value;
                    var titleElement = document.getElementById('higher_education_qualification');

                    switch (selectedQualification) {
                        case 'ND':
                            titleElement.textContent = "ORDINARY NATIONAL DIPLOMA (ND) OR EQUIVALENT";
                            break;
                        case 'HND':
                            titleElement.textContent = "HIGHER NATIONAL DIPLOMA (HND) OR EQUIVALENT";
                            break;
                        case 'BA':
                            titleElement.textContent = "FIRST DEGREE (BA) OR EQUIVALENT";
                            break;
                        case 'MA':
                            titleElement.textContent = "MASTER DEGREE (MA) OR EQUIVALENT";
                            break;
                        default:
                            titleElement.textContent = "Select";  // Default value
                    }
                });

                function updateResultOptions() {
                    const qualification = document.getElementById('school_qualification').value;

                    // Get all the subject select elements
                    const bahasaMelayuSelect = document.getElementById('bahasa_melayu_result');
                    const englishSelect = document.getElementById('english_result');
                    const mathematicsSelect = document.getElementById('mathematics_result');
                    const collegeResultSelect = document.getElementById('college_result'); // New for college result dropdown

                    // Clear current options for all dropdowns
                    [bahasaMelayuSelect, englishSelect, mathematicsSelect, collegeResultSelect].forEach(select => {
                        select.innerHTML = ''; // Clear existing options
                    });

                    let resultOptions = [];
                    let subjectResultOptions = [];

                    // Logic for populating options based on qualification
                    if (qualification === 'O_Level') {
                        resultOptions = Array.from({ length: 10 }, (_, i) => `${9 - i} 'O' LEVEL`);
                        subjectResultOptions = Array.from({ length: 9 }, (_, i) => `${i}`);
                    } else if (qualification === 'A_Level') {
                        resultOptions = Array.from({ length: 10 }, (_, i) => `${9 - i} 'A' LEVEL`);
                        subjectResultOptions = ['A', 'B', 'C', 'D', 'E', 'F'];
                    } else if (qualification === 'SPUB') {
                        resultOptions = Array.from({ length: 64 }, (_, i) => `${i + 1}`);
                        subjectResultOptions = Array.from({ length: 9 }, (_, i) => `${i}`);
                    } else if (qualification === 'STPUB') {
                        resultOptions = ['Mumtaz', 'Jayyid Jiddan', 'Jayyid', 'Makbul', 'Rasib'];
                        subjectResultOptions = Array.from({ length: 9 }, (_, i) => `${i}`);
                    }

                    // Add result options to the college result dropdown
                    resultOptions.forEach(option => {
                        const opt = document.createElement('option');
                        opt.value = option;
                        opt.textContent = option;
                        collegeResultSelect.appendChild(opt);
                    });

                    // Add result options to each subject dropdown based on the selected qualification
                    const subjectSelectors = [bahasaMelayuSelect, englishSelect, mathematicsSelect];
                    subjectSelectors.forEach(select => {
                        subjectResultOptions.forEach(option => {
                            const opt = document.createElement('option');
                            opt.value = option;
                            opt.textContent = option;
                            select.appendChild(opt);
                        });
                    });
                }
            </script>
        </div>
    </section>
    @include('components.candidate.footer')
</body>
</html>
