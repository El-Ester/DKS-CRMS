<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/unissalogo.jpg') }}" type="image/jpeg">
    <title>Employments</title>
    <link rel="stylesheet" href="{{ asset('css/employments.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    @include('components.candidate.header')
    @include('components.candidate.sidebar')

    <section class="home-section bg-lightblue">
        <i class='bx bx-menu'></i>

        <div class="container py-4">
            <h1>Employments Detail</h1>
            <hr>
            <h2>Give particulars of all previous employments in chronological order</h2>

            <!-- ADD PREVIOUS EMPLOYMENT DETAIL MODAL -->
            <div class="modal fade" id="addPreviousEmploymentModal" tabindex="-1" aria-labelledby="addPreviousEmploymentLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addPreviousEmploymentLabel">Add Employment Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('previous-employments.store') }}" method="POST" enctype="multipart/form-data" novalidate>
                                @csrf

                                <div class="mb-3">
                                    <label for="post_name" class="form-label">Post Name:</label>
                                    <input type="text" class="form-control" id="post_name" name="post_name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="employer_name" class="form-label">Employer Name:</label>
                                    <input type="text" class="form-control" id="employer_name" name="employer_name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="employer_address" class="form-label">Employer Address:</label>
                                    <input type="text" class="form-control" id="employer_address" name="employer_address" required>
                                </div>
                                <div class="mb-3">
                                    <label for="commencement_date" class="form-label">Commencement Date:</label>
                                    <input type="date" class="form-control" id="commencement_date" name="commencement_date" required>
                                </div>
                                <div class="mb-3">
                                    <label for="termination_date" class="form-label">Termination Date:</label>
                                    <input type="date" class="form-control" id="termination_date" name="termination_date" required>
                                </div>
                                <div class="mb-3">
                                    <label for="employment_nature" class="form-label">Employment Nature:</label>
                                    <input type="text" class="form-control" id="employment_nature" name="employment_nature" required>
                                </div>
                                <div class="mb-3">
                                    <label for="reasons_for_leaving" class="form-label">Reason for Leaving:</label>
                                    <input type="text" class="form-control" id="reasons_for_leaving" name="reasons_for_leaving" required>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- PREVIOUS EMPLOYMENTS DETAIL DISPLAY -->
            <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#addPreviousEmploymentModal">
                <i class="bi bi-plus-circle"></i> Add
            </button>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Post Name</th>
                            <th>Employer Name</th>
                            <th>Employer Address</th>
                            <th>Commencement Date</th>
                            <th>Termination Date</th>
                            <th>Employment Nature</th>
                            <th>Reasons for Leaving</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($previousEmployments->isEmpty())
                            <tr>
                                <td colspan="9" class="text-center">Please add your previous employments.</td>
                            </tr>
                        @else
                        @foreach($previousEmployments as $previousEmployment)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $previousEmployment->post_name }}</td>
                                <td>{{ $previousEmployment->employer_name }}</td>
                                <td>{{ $previousEmployment->employer_address }}</td>
                                <td>{{ $previousEmployment->commencement_date }}</td>
                                <td>{{ $previousEmployment->termination_date }}</td>
                                <td>{{ $previousEmployment->employment_nature }}</td>
                                <td>{{ $previousEmployment->reasons_for_leaving }}</td>
                                <td>
                                    <div class="action-icons">
                                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editPreviousEmploymentModal{{ $previousEmployment->id }}" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <!-- EDIT MODAL -->
                                        <div class="modal fade" id="editPreviousEmploymentModal{{ $previousEmployment->id }}" tabindex="-1" aria-labelledby="editPreviousEmploymentModalLabel{{ $previousEmployment->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editPreviousEmploymentModalLabel{{ $previousEmployment->id }}">Edit Employment Details</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('previous-employments.update', $previousEmployment->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="mb-3">
                                                                <label for="post_name{{ $previousEmployment->id }}" class="form-label">Post Name:</label>
                                                                <input type="text" class="form-control" id="post_name{{ $previousEmployment->id }}" name="post_name" value="{{ $previousEmployment->post_name }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="employer_name{{ $previousEmployment->id }}" class="form-label">Employer Name:</label>
                                                                <input type="text" class="form-control" id="employer_name{{ $previousEmployment->id }}" name="employer_name" value="{{ $previousEmployment->employer_name }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="employer_address{{ $previousEmployment->id }}" class="form-label">Employer Address:</label>
                                                                <input type="text" class="form-control" id="employer_address{{ $previousEmployment->id }}" name="employer_address" value="{{ $previousEmployment->employer_address }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="commencement_date{{ $previousEmployment->id }}" class="form-label">Commencement Date:</label>
                                                                <input type="date" class="form-control" id="commencement_date{{ $previousEmployment->id }}" name="commencement_date" value="{{ $previousEmployment->commencement_date }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="termination_date{{ $previousEmployment->id }}" class="form-label">Termination Date:</label>
                                                                <input type="date" class="form-control" id="termination_date{{ $previousEmployment->id }}" name="termination_date" value="{{ $previousEmployment->termination_date }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="employment_nature{{ $previousEmployment->id }}" class="form-label">Employment Nature:</label>
                                                                <input type="text" class="form-control" id="employment_nature{{ $previousEmployment->id }}" name="employment_nature" value="{{ $previousEmployment->employment_nature }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="reasons_for_leaving{{ $previousEmployment->id }}" class="form-label">Reason for Leaving:</label>
                                                                <input type="text" class="form-control" id="reasons_for_leaving{{ $previousEmployment->id }}" name="reasons_for_leaving" value="{{ $previousEmployment->reasons_for_leaving }}" required>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-success">Update</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <form action="{{ route('previous-employments.destroy', $previousEmployment->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>

            <hr>

            <h2>Current Employment</h2>

            <!-- ADD CURRENT EMPLOYMENT DETAIL MODAL -->
            <div class="modal fade" id="addCurrentEmploymentModal" tabindex="-1" aria-labelledby="addCurrentEmploymentLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addCurrentEmploymentLabel">Add Employment Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('current-employment.store') }}" method="POST" enctype="multipart/form-data" novalidate>
                                @csrf
                                <div class="mb-3">
                                    <label for="post_name" class="form-label">Post Name:</label>
                                    <input type="text" class="form-control" id="post_name" name="post_name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="organisation_type" class="form-label">Organisation:</label>
                                    <input type="text" class="form-control" id="organisation_type" name="organisation_type" required>
                                </div>
                                <div class="mb-3">
                                    <label for="employer_name" class="form-label">Employer Name:</label>
                                    <input type="text" class="form-control" id="employer_name" name="employer_name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="employer_address" class="form-label">Employer Address:</label>
                                    <input type="text" class="form-control" id="employer_address" name="employer_address" required>
                                </div>
                                <div class="mb-3">
                                    <label for="commencement_date" class="form-label">Commencement Date:</label>
                                    <input type="date" class="form-control" id="commencement_date" name="commencement_date" required>
                                </div>
                                <div class="mb-3">
                                    <label for="employment_nature" class="form-label">Employment Nature:</label>
                                    <input type="text" class="form-control" id="employment_nature" name="employment_nature" required>
                                </div>
                                <div class="mb-3">
                                    <label for="monthly_salary" class="form-label">Monthly Salary:</label>
                                    <input type="number" class="form-control" id="monthly_salary" name="monthly_salary" required>
                                </div>
                                <div class="mb-3">
                                    <label for="allowance" class="form-label">Allowance:</label>
                                    <input type="number" class="form-control" id="allowance" name="allowance" required>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CURRENT EMPLOYMENTS DETAIL DISPLAY -->
            <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#addCurrentEmploymentModal">
                <i class="bi bi-plus-circle"></i> Add
            </button>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Post Name</th>
                            <th>Organisation Type</th>
                            <th>Employer Name</th>
                            <th>Employer Address</th>
                            <th>Commencement Date</th>
                            <th>Employment Nature</th>
                            <th>Monthly Salary</th>
                            <th>Allowance</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($currentEmployment->isEmpty())
                            <tr>
                                <td colspan="9" class="text-center">Please add your current employment.</td>
                            </tr>
                        @else
                        @foreach($currentEmployment as $currentEmployment)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $currentEmployment->post_name }}</td>
                                <td>{{ $currentEmployment->organisation_type }}</td>
                                <td>{{ $currentEmployment->employer_name }}</td>
                                <td>{{ $currentEmployment->employer_address }}</td>
                                <td>{{ $currentEmployment->commencement_date }}</td>
                                <td>{{ $currentEmployment->employment_nature }}</td>
                                <td>{{ $currentEmployment->monthly_salary }}</td>
                                <td>{{ $currentEmployment->allowance }}</td>
                                <td>
                                    <div class="action-icons">
                                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editCurrentEmploymentModal{{ $currentEmployment->id }}" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <!-- EDIT MODAL -->
                                        <div class="modal fade" id="editCurrentEmploymentModal{{ $currentEmployment->id }}" tabindex="-1" aria-labelledby="editCurrentEmploymentModalLabel{{ $currentEmployment->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editCurrentEmploymentModalLabel{{ $currentEmployment->id }}">Edit Employment Details</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('current-employment.update', $currentEmployment->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="mb-3">
                                                                <label for="post_name{{ $currentEmployment->id }}" class="form-label">Post Name:</label>
                                                                <input type="text" class="form-control" id="post_name{{ $currentEmployment->id }}" name="post_name" value="{{ $currentEmployment->post_name }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="organisation_type{{ $currentEmployment->id }}" class="form-label">Organisation Type:</label>
                                                                <input type="text" class="form-control" id="organisation_type{{ $currentEmployment->id }}" name="organisation_type" value="{{ $currentEmployment->organisation_type }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="employer_name{{ $currentEmployment->id }}" class="form-label">Employer Name:</label>
                                                                <input type="text" class="form-control" id="employer_name{{ $currentEmployment->id }}" name="employer_name" value="{{ $currentEmployment->employer_name }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="employer_address{{ $currentEmployment->id }}" class="form-label">Employer Address:</label>
                                                                <input type="text" class="form-control" id="employer_address{{ $currentEmployment->id }}" name="employer_address" value="{{ $currentEmployment->employer_address }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="commencement_date{{ $currentEmployment->id }}" class="form-label">Commencement Date:</label>
                                                                <input type="date" class="form-control" id="commencement_date{{ $currentEmployment->id }}" name="commencement_date" value="{{ $currentEmployment->commencement_date }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="employment_nature{{ $currentEmployment->id }}" class="form-label">Employment Nature:</label>
                                                                <input type="text" class="form-control" id="employment_nature{{ $currentEmployment->id }}" name="employment_nature" value="{{ $currentEmployment->employment_nature }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="monthly_salary{{ $currentEmployment->id }}" class="form-label">Monthly Salary:</label>
                                                                <input type="number" class="form-control" id="monthly_salary{{ $currentEmployment->id }}" name="monthly_salary" value="{{ $currentEmployment->monthly_salary }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="allowance{{ $currentEmployment->id }}" class="form-label">Allowance:</label>
                                                                <input type="number" class="form-control" id="allowance{{ $currentEmployment->id }}" name="allowance" value="{{ $currentEmployment->allowance }}" required>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-success">Update</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <form action="{{ route('current-employment.destroy', $currentEmployment->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    @include('components.candidate.footer')
</body>
</html>
