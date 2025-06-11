<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add a New Case</title>
    <link rel="icon" href="{{ asset('images/DKS_Logo_no.bg.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/AddCases.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body>
    @include('components.admin.header')
    @include('components.admin.sidebar')

    <section class="home-section">
        <h2>Add New Case</h2>

        <form action="{{ route('cases.store') }}" method="POST">
            @csrf

            <input type="hidden" name="user_id" value="{{ auth()->user()->user_id }}">

            <div class="form-row">
                <div class="form-group col-md-12">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label for="issue_number" class="form-label">Case Number</label>
                            <input type="text"
                                class="form-control"
                                id="issue_number"
                                name="issue_number"
                                value="{{ $generatedIssueNumber ?? '' }}"
                                readonly>
                        </div>
                        <div class="col-md-3">
                            <label for="issue_date" class="form-label">Date</label>
                            <input type="date" class="form-control @error('issue_date') is-invalid @enderror" id="issue_date" name="issue_date" value="{{ old('issue_date') }}" required>
                            @error('issue_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="status_id" class="form-label">Status</label>
                            <select class="form-select @error('status_id') is-invalid @enderror" id="status_id" name="status_id" required>
                                <option value="">-- Select Status --</option>
                                @foreach ($statuses as $status)
                                    <option value="{{ $status->status_id }}" {{ old('status_id') == $status->status_id ? 'selected' : '' }}>
                                        {{ $status->status_title }}
                                    </option>
                                @endforeach
                            </select>
                            @error('status_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Current DKS Staff</label>
                            <input type="text" class="form-control" value="{{ auth()->user()->user_name }}" readonly>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-row mt-3">
                <div class="form-group col-md-12">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label for="customer_name" class="form-label">Customer Name</label>
                            <input type="text" class="form-control @error('customer_name') is-invalid @enderror" id="customer_name" name="customer_name" value="{{ old('customer_name') }}" required>
                            @error('customer_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="company" class="form-label">Company/Organisation</label>
                            <input type="text" class="form-control @error('company') is-invalid @enderror" id="company" name="company" value="{{ old('company') }}" required>
                            @error('company')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="contact_no" class="form-label">Contact Number</label>
                            <input type="number" class="form-control @error('contact_no') is-invalid @enderror" id="contact_no" name="contact_no" value="{{ old('contact_no') }}" required>
                            @error('contact_no')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="customer_email" class="form-label">Customer Email</label>
                            <input type="email" class="form-control @error('customer_email') is-invalid @enderror" id="customer_email" name="customer_email" value="{{ old('customer_email') }}" required>
                            @error('customer_email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-row mt-3">
                <div class="form-group col-md-12">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Collected Item(s) (Model & S/N)</label>
                            <div id="collected-items">
                                @php $items = old('items', ['']); @endphp
                                @foreach ($items as $item)
                                    <input type="text" name="items[]" class="form-control mb-1" value="{{ $item }}">
                                @endforeach
                            </div>
                            <button type="button" class="btn btn-sm btn-success mt-2" onclick="addItem()">Add Item</button>
                            <button type="button" class="btn btn-sm btn-danger mt-2" onclick="removeItem()">Remove Item</button>
                        </div>

                        <div class="col-md-4">
                            <label for="problem_statement" class="form-label">Problem Statement (Customer)</label>
                            <textarea class="form-control @error('problem_statement') is-invalid @enderror" id="problem_statement" name="problem_statement" rows="3" required>{{ old('problem_statement') }}</textarea>
                            @error('problem_statement')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="problem_verification" class="form-label">Problem Verification (DKS Staff)</label>
                            <textarea class="form-control @error('problem_verification') is-invalid @enderror" id="problem_verification" name="problem_verification" rows="3">{{ old('problem_verification') }}</textarea>
                            @error('problem_verification')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Submit Case</button>
            </div>
        </form>
    </section>

    @include('components.admin.footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        @if(session('success'))
            toastr.success("{{ session('success') }}");
        @endif
        @if(session('error'))
            toastr.error("{{ session('error') }}");
        @endif
        @if(session('info'))
            toastr.info("{{ session('info') }}");
        @endif
        @if(session('warning'))
            toastr.warning("{{ session('warning') }}");
        @endif

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
            const items = container.querySelectorAll('input[name="items[]"]');
            if (items.length > 1) {
                container.removeChild(items[items.length - 1]);
            } else {
                toastr.warning("You must have at least one item field.");
            }
        }
    </script>
</body>
</html>
