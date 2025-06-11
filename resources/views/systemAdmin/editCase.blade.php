<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/DKS_Logo_no.bg.png') }}" type="image/jpeg">
    <title>Edit Case</title>
    <link rel="stylesheet" href="{{ asset('css/editCase.css') }}">
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
    <h2>Edit Case for Case Number: {{ $case->issue_number }}</h2>

    <form action="{{ route('cases.update', $case->issue_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-row">
            <div class="form-group col-md-12">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label>Case Number</label>
                        <input type="text" class="form-control" value="{{ $case->issue_number }}" disabled>
                    </div>

                    <div class="col-md-3">
                        <label>Date</label>
                        <input type="date" name="issue_date" class="form-control"
                               value="{{ \Carbon\Carbon::parse($case->issue_date)->format('Y-m-d') }}">
                    </div>

                    <div class="col-md-3">
                        <label>Status</label>
                        <select name="status_id" class="form-select">
                            @foreach($statuses as $status)
                                <option value="{{ $status->status_id }}" {{ $case->status_id == $status->status_id ? 'selected' : '' }}>
                                    {{ $status->status_title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label>Added By DKS Staff</label>
                        <input type="text" class="form-control" value="{{ auth()->user()->user_name }}" readonly>
                        <input type="hidden" name="created_by_user_id" value="{{ auth()->user()->user_id }}">
                    </div>
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-12">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label>Customer Name</label>
                        <input type="text" name="customer_name" class="form-control" value="{{ $case->customer_name }}">
                    </div>

                    <div class="col-md-3">
                        <label>Company/Organisation</label>
                        <input type="text" name="company" class="form-control" value="{{ $case->company }}">
                    </div>

                    <div class="col-md-3">
                        <label>Contact Number</label>
                        <input type="text" name="contact_no" class="form-control" value="{{ $case->contact_no }}">
                    </div>

                    <div class="col-md-3">
                        <label>Customer Email</label>
                        <input type="email" name="customer_email" class="form-control" value="{{ $case->customer_email }}">
                    </div>
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-12">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label>Collected Item(s) (Model & S/N)</label>
                        <div id="collected-items">
                            @forelse ($case->items ?? [] as $item)
                                <input type="text" name="items[]" class="form-control mb-1" value="{{ $item->items_name }}">
                            @empty
                                <input type="text" name="items[]" class="form-control mb-1">
                            @endforelse
                        </div>
                        <button type="button" class="btn btn-sm btn-success mt-2" onclick="addItem()">Add New Item</button>
                        <button type="button" class="btn btn-sm btn-danger mt-2" onclick="removeItem()">Remove Item</button>
                    </div>

                    <div class="col-md-4">
                        <label>Problem Statement (Customer)</label>
                        <textarea name="problem_statement" class="form-control" rows="3">{{ $case->problem_statement }}</textarea>
                    </div>

                    <div class="col-md-4">
                        <label>Problem Verification (DKS Staff)</label>
                        <textarea name="problem_verification" class="form-control" rows="3">{{ $case->problem_verification }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <hr>

        <div class="form-group col-md-12">
            <div class="row g-3">
                <div class="col-md-4">
                    <label>Diagnostic Date</label>
                    <input type="date" name="diagnostic_date" class="form-control"
                           value="{{ $case->diagnostic_date ? $case->diagnostic_date->format('Y-m-d') : '' }}">
                </div>

                <div class="col-md-8">
                    <label>Work Description</label>
                    <textarea name="work_description" class="form-control" rows="3">{{ $case->work_description }}</textarea>
                </div>

                <div class="col-md-4">
                    <label>Repair Cost</label>
                    <div class="input-group">
                        <span class="input-group-text">RM</span>
                        <input type="text" name="repair_cost" class="form-control"
                            value="{{ number_format((float) $case->repair_cost, 2, '.', '') }}">
                    </div>
                </div>

                <div class="col-md-4">
                    <label>Completion Date</label>
                    <input type="date" name="completion_date" class="form-control"
                           value="{{ $case->completion_date ? $case->completion_date->format('Y-m-d') : '' }}">
                </div>

                <div class="col-md-4">
                    <label>Service Engineer</label>
                    <select name="user_id" class="form-select">
                        <option value="" disabled {{ is_null($case->user_id) ? 'selected' : '' }}>Select Service Engineer</option>
                        @foreach($users as $user)
                            <option value="{{ $user->user_id }}" {{ $case->user_id == $user->user_id ? 'selected' : '' }}>
                                {{ $user->user_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="d-flex gap-2 justify-content-end mt-4">
            <button type="submit" class="btn btn-primary">Update Case</button>
            <a href="{{ route('cases.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>

    <hr class="my-4">

    <form action="{{ route('cases.destroy', $case->issue_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this case? This action cannot be undone.');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete Case</button>
    </form>
</section>

<script>
    function addItem() {
        const container = document.getElementById('collected-items');
        const input = document.createElement('input');
        input.type = 'text';
        input.name = 'items[]';
        input.className = 'form-control mb-1';
        container.appendChild(input);
    }

    function removeItem() {
        const container = document.getElementById('collected-items');
        if (container.children.length > 1) {
            container.removeChild(container.lastElementChild);
        }
    }
</script>

</body>
</html>

@include('components.admin.footer')
