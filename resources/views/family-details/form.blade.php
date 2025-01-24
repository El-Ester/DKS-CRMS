<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/unissalogo.jpg') }}" type="image/jpeg">
    <title>Family Details</title>
    <link rel="stylesheet" href="{{ asset('css/familyDetails.css') }}">
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
                <h1>Family Details</h1>

                <hr>

                <!-- ADD FAMILY DETAILS MODAL -->
                <div class="modal fade" id="addFamilyDetailsModal" tabindex="-1" aria-labelledby="addFamilyDetailsLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addFamilyDetailsLabel">Add Family Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('family-details.store') }}" method="POST" enctype="multipart/form-data" novalidate>
                                    @csrf

                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name: </label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="relation" class="form-label">Relation: </label>
                                        <select name="relation" id="relation" required>
                                            <option value="Select">--select--</option>
                                            <option value="Husband">Husband</option>
                                            <option value="Wife">Wife</option>
                                            <option value="Father">Father</option>
                                            <option value="Mother">Mother</option>
                                            <option value="Children">Children</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="ic_no" class="form-label">Identity Card No.: </label>
                                        <input type="number" class="form-control" id="ic_no" name="ic_no" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="d_o_b" class="form-label">Date of Birth: </label>
                                        <input type="date" class="form-control" id="d_o_b" name="d_o_b" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="age" class="form-label">Age: </label>
                                        <input type="number" class="form-control" id="age" name="age" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="occupation_or_education" class="form-label">Occupation / Education:</label>
                                        <input type="text" class="form-control" id="occupation_or_education" name="occupation_or_education" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="address" class="form-label">Full Address: </label>
                                        <input type="text" class="form-control" id="address" name="address" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="date_of_demise" class="form-label">Date of Demise (if applicable):</label>
                                        <input type="date" class="form-control" id="date_of_demise" name="date_of_demise" required>
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

                <!-- FAMILY DETAILS DISPLAY -->
                <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#addFamilyDetailsModal">
                    <i class="bi bi-plus-circle"></i> Add
                </button>

                <div class="table responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Relation</th>
                                <th>IC No.</th>
                                <th>D.O.B.</th>
                                <th>Age</th>
                                <th>Occupation</th>
                                <th>Address</th>
                                <th>Date of Demise</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($familyDetails as $familyDetails)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $familyDetails->name }}</td>
                                <td>{{ $familyDetails->relation }}</td>
                                <td>{{ $familyDetails->ic_no }}</td>
                                <td>{{ $familyDetails->d_o_b }}</td>
                                <td>{{ $familyDetails->age }}</td>
                                <td>{{ $familyDetails->occupation_or_education }}</td>
                                <td>{{ $familyDetails->address }}</td>
                                <td>{{ $familyDetails->date_of_demise }}</td>
                                <td>
                                    <div class="action-icons">
                                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editFamilyDetailsModal{{ $familyDetails->id }}" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <!-- EDIT MODAL -->
                                        <div class="modal fade" id="editFamilyDetailsModal{{ $familyDetails->id }}" tabindex="-1" aria-labelledby="editFamilyDetailsModalLabel{{ $familyDetails->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editFamilyDetailsModalLabel{{ $familyDetails->id }}">Edit Family Details</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('family-details.update', $familyDetails->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')

                                                            <div class="mb-3">
                                                                <label for="name{{ $familyDetails->id }}" class="form-label">Name: </label>
                                                                <input type="text" class="form-control" id="name{{ $familyDetails->id }}" name="name" value="{{ $familyDetails->name }}" required>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="relation{{ $familyDetails->id }}" class="form-label">Relation: </label>
                                                                <select name="relation" id="relation{{ $familyDetails->id }}" required>
                                                                    <option value="Default">--select--</option>
                                                                    <option value="Husband" {{ (isset($familyDetails) && $familyDetails->relation == 'Husband') ? 'selected' : '' }}>Husband</option>
                                                                    <option value="Wife" {{ (isset($familyDetails) && $familyDetails->relation == 'Wife') ? 'selected' : '' }}>Wife</option>
                                                                    <option value="Father" {{ (isset($familyDetails) && $familyDetails->relation == 'Father') ? 'selected' : '' }}>Father</option>
                                                                    <option value="Mother" {{ (isset($familyDetails) && $familyDetails->relation == 'Mother') ? 'selected' : '' }}>Mother</option>
                                                                    <option value="Children" {{ (isset($familyDetails) && $familyDetails->relation == 'Children') ? 'selected' : '' }}>Children</option>
                                                                </select>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="ic_no{{ $familyDetails->id }}" class="form-label">Identity Card No.: </label>
                                                                <input type="number" class="form-control" id="ic_no{{ $familyDetails->id }}" name="ic_no" value="{{ $familyDetails->ic_no }}" required>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="d_o_b{{ $familyDetails->id }}" class="form-label">Date of Birth: </label>
                                                                <input type="date" class="form-control" id="d_o_b{{ $familyDetails->id }}" name="d_o_b" value="{{ $familyDetails->d_o_b }}" required>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="age{{ $familyDetails->id }}" class="form-label">Age: </label>
                                                                <input type="number" class="form-control" id="age{{ $familyDetails->id }}" name="age" value="{{ $familyDetails->age }}" required>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="occupation_or_education{{ $familyDetails->id }}" class="form-label">Occupation / Education:</label>
                                                                <input type="text" class="form-control" id="occupation_or_education{{ $familyDetails->id }}" name="occupation_or_education" value="{{ $familyDetails->occupation_or_education }}" required>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="address{{ $familyDetails->id }}" class="form-label">Full Address: </label>
                                                                <input type="text" class="form-control" id="address{{ $familyDetails->id }}" name="address" value="{{ $familyDetails->address }}" required>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="date_of_demise{{ $familyDetails->id }}" class="form-label">Date of Demise (if applicable):</label>
                                                                <input type="date" class="form-control" id="date_of_demise{{ $familyDetails->id }}" name="date_of_demise" value="{{ $familyDetails->date_of_demise }}">
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

                                        <!-- DELETE FORM -->
                                        <form action="{{ route('family-details.destroy', $familyDetails->id) }}" method="POST" style="display:inline-block;">
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
                        </tbody>
                    </table>
                </div>

            </div>
        </section>
</body>
</html>
@include('components.candidate.footer')
