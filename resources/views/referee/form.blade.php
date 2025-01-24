<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/unissalogo.jpg') }}" type="image/jpeg">
    <title>Referee</title>
    <link rel="stylesheet" href="{{ asset('css/referee.css') }}">
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
            <h1>Referee Details</h1>

            <hr>

            <!--ADD REFEREE MODAL-->
            <div class="modal fade" id="addRefereeModal" tabindex="-1" aria-labelledby="addRefereeModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addRefereeModalLabel">Add Referee</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('referee.store') }}" method="POST" enctype="multipart/form-data" >
                                @csrf

                                <div class="mb-3">
                                    <label for="name" class="form-label">Name: </label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="occupation" class="form-label">Occupation: </label>
                                    <input type="text" class="form-control" id="occupation" name="occupation" required>
                                </div>
                                <div class="mb-3">
                                    <label for="years_known" class="form-label">Years Known:</label>
                                    <input type="number" class="form-control" id="years_known" name="years_known" required>
                                </div>
                                <div class="mb-3">
                                    <label for="relation" class="form-label">Relation: </label>
                                    <input type="text" class="form-control" id="relation" name="relation" required>
                                </div>
                                <div class="mb-3">
                                    <label for="address_line1" class="form-label">Address Line 1: </label>
                                    <input type="text" class="form-control" id="address_line1" name="address_line1" required>
                                </div>
                                <div class="mb-3">
                                    <label for="address_line2" class="form-label">Address Line 2: </label>
                                    <input type="text" class=
                                    "form-control" id="address_line2" name="address_line2">
                                </div>
                                <div class="mb-3">
                                    <label for="address_line3" class="form-label">Address Line 3: </label>
                                    <input type="text" class="form-control" id="address_line3" name="address_line3">
                                </div>
                                <div class="mb-3">
                                    <label for="country" class="form-label">Country: </label>
                                    <input type="text" class="form-control" id="country" name="country" required>
                                </div>
                                <div class="mb-3">
                                    <label for="province" class="form-label">Province: </label>
                                    <input type="text" class="form-control" id="province" name="province" required>
                                </div>
                                <div class="mb-3">
                                    <label for="postal_code" class="form-label">Postal Code: </label>
                                    <input type="text" class="form-control" id="postal_code" name="postal_code" required>
                                </div>
                                <div class="mb-3">
                                    <label for="telephone" class="form-label">Telephone: </label>
                                    <input type="number" class="form-control" id="telephone" name="telephone" required>
                                </div>
                                <div class="mb-3">
                                    <label for="fax" class="form-label">Fax No.: </label>
                                    <input type="text" class="form-control" id="fax" name="fax">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email: </label>
                                    <input type="email" class="form-control" id="email" name="email" required>
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

                            <!-- REFEREE DISPLAY -->
                            <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#addRefereeModal">
                                <i class="bi bi-plus-circle"></i> Add
                            </button>

                            <div class="table responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Occupation</th>
                                            <th>Years Known</th>
                                            <th>Relation</th>
                                            <th>Address</th>
                                            <th>Contact Information</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($referees as $referee)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $referee->name }}</td>
                                            <td>{{ $referee->occupation }}</td>
                                            <td>{{ $referee->years_known }}</td>
                                            <td>{{ $referee->relation }}</td>
                                            <td>
                                                {{ $referee->address_line1 }}
                                                {{ $referee->address_line2 }}
                                                {{ $referee->address_line3 }}
                                                {{ $referee->country }},
                                                {{ $referee->province }},
                                                {{ $referee->postal_code }}
                                            </td>
                                            <td>
                                                <strong>Phone No.:</strong>  {{ $referee->telephone }}<br>
                                                <strong>Fax:</strong> {{ $referee->fax }}<br>
                                                <strong>Email:</strong> {{ $referee->email }}<br>
                                            </td>
                                            <td>
                                                <div class="action-icons">
                                                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editRefereeModal{{ $referee->id }}" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </button>

                                                    <!-- EDIT REFEREE MODAL -->
                                                    <div class="modal fade" id="editRefereeModal{{ $referee->id }}" tabindex="-1" aria-labelledby="editRefereeModalLabel{{ $referee->id }}" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="editRefereeModalLabel{{ $referee->id}}">Edit Referee Details</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="{{ route('referee.update', $referee->id) }}" method="POST">
                                                                        @csrf
                                                                        @method('PUT')

                                                                        <div class="mb-3">
                                                                            <label for="name{{ $referee->id }}" class="form-label">Name: </label>
                                                                            <input type="text" class="form-control" id="name{{ $referee->id }}" name="name" value="{{ $referee->name }}" required>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="occupation{{ $referee->id }}" class="form-label">Occupation: </label>
                                                                            <input type="text" class="form-control" id="occupation{{ $referee->id }}" name="occupation" value="{{ $referee->occupation }}" required>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="years_known{{ $referee->id }}" class="form-label">Years Known:</label>
                                                                            <input type="number" class="form-control" id="years_known{{ $referee->id }}" name="years_known" value="{{ $referee->years_known }}" required>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="relation{{ $referee->id }}" class="form-label">Relation: </label>
                                                                            <input type="text" class="form-control" id="relation{{ $referee->id }}" name="relation" value="{{ $referee->relation }}" required>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="address_line1{{ $referee->id }}" class="form-label">Address Line 1: </label>
                                                                            <input type="text" class="form-control" id="address_line1{{ $referee->id }}" name="address_line1" value="{{ $referee->address_line1 }}" required>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="address_line2{{ $referee->id }}" class="form-label">Address Line 2: </label>
                                                                            <input type="text" class="form-control" id="address_line2{{ $referee->id }}" name="address_line2" value="{{ $referee->address_line2 }}">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="address_line3{{ $referee->id }}" class="form-label">Address Line 3: </label>
                                                                            <input type="text" class="form-control" id="address_line3{{ $referee->id }}" name="address_line3" value="{{ $referee->address_line3 }}">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="country{{ $referee->id }}" class="form-label">Country: </label>
                                                                            <input type="text" class="form-control" id="country{{ $referee->id }}" name="country" value="{{ $referee->country }}" required>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="province{{ $referee->id }}" class="form-label">Province: </label>
                                                                            <input type="text" class="form-control" id="province{{ $referee->id }}" name="province" value="{{ $referee->province }}" required>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="postal_code{{ $referee->id }}" class="form-label">Postal Code: </label>
                                                                            <input type="text" class="form-control" id="postal_code{{ $referee->id }}" name="postal_code" value="{{ $referee->postal_code }}" required>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="telephone{{ $referee->id }}" class="form-label">Telephone: </label>
                                                                            <input type="number" class="form-control" id="telephone{{ $referee->id }}" name="telephone" value="{{ $referee->telephone }}" required>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="fax{{ $referee->id }}" class="form-label">Fax No.: </label>
                                                                            <input type="text" class="form-control" id="fax{{ $referee->id }}" name="fax" value="{{ $referee->fax }}">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="email{{ $referee->id }}" class="form-label">Email: </label>
                                                                            <input type="email" class="form-control" id="email{{ $referee->id }}" name="email" value="{{ $referee->email }}" required>
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

                                                    <form action="{{ route('referee.destroy', $referee->id) }}" method="POST" style="display:inline-block;">
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
