@include('components.jppstm.header')
@include('components.jppstm.sidebar')

<section class="home-section bg-lightblue">
    <div class="home-content">
        <i class='bx bx-menu'></i>
        <span class="text text-black">Edit Job Details</span>
    </div>

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
            margin-top: 20px;
            padding: 20px;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1, h3 {
            color: #565656;
        }
        .text{
            font-weight: bold;
        }

        .form-label {
            font-weight: bold;
        }

        .form-control{
            margin-bottom: 20px;
        }

        .title, .description, .status{
            font-weight: bold;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #000000;
            margin-top: 20px;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #333;
            margin-bottom: 20px;
        }

        .btn-danger:hover {
            background-color: #bd2130;
        }

        .btn-warning {
            background-color: #ffc107;
            border-color: #333;
            margin-bottom: 20px;
        }

        .btn-secondary{
            background-color: #ff3e3e;
            border-color: #000000;
            margin-top: 20px;
        }

        .btn-secondary:hover{
            background-color: #c52a2a;
        }

        .btn-warning:hover {
            background-color: #e0a800;
        }

        table {
            margin-top: 20px;
        }

        table th {
            background-color: #007bff;
            color: white;
            text-align: left;
        }

        table td {
            text-align: left;
        }

        .alert-success {
            margin-top: 10px;
            padding: 10px;
            color: #155724;
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            border-radius: 4px;
        }
    </style>

<div class="container">
    <form action="{{ route('hiring.update', $job->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Job Title -->
        <div class="form-group">
            <label class="text" for="title">Job Title</label>
            <input type="text" name="title" id="title" value="{{ old('title', $job->title) }}" class="form-control" required>
        </div>

        <!-- Job Description -->
        <div class="form-group">
            <label class="text" for="description">Job Description</label>
            <textarea name="description" id="description" class="form-control" required>{{ old('description', $job->description) }}</textarea>
        </div>

        <!-- Payment -->
        <div class="form-group">
            <label class="text" for="payment_amount">Payment Amount</label>
            <input type="number" name="payment_amount" id="payment_amount" value="{{ old('payment_amount', $job->payment_amount) }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label class="text" for="payment_type">Payment Type</label>
            <select name="payment_type" id="payment_type" class="form-control" required>
                <option value="per_day" {{ $job->payment_type === 'per_day' ? 'selected' : '' }}>/ Day</option>
                <option value="per_month" {{ $job->payment_type === 'per_month' ? 'selected' : '' }}>/ Month</option>
                <option value="per_year" {{ $job->payment_type === 'per_year' ? 'selected' : '' }}>/ Year</option>
            </select>
        </div>

        <!-- Working Period -->
        <div class="form-group">
            <label class="text" for="working_period_amount">Working Period Amount</label>
            <input type="number" name="working_period_amount" id="working_period_amount" value="{{ old('working_period_amount', $job->working_period_amount) }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label class="text" for="working_period_type">Working Period Type</label>
            <select name="working_period_type" id="working_period_type" class="form-control" required>
                <option value="days" {{ $job->working_period_type === 'days' ? 'selected' : '' }}>Days</option>
                <option value="months" {{ $job->working_period_type === 'months' ? 'selected' : '' }}>Months</option>
                <option value="years" {{ $job->working_period_type === 'years' ? 'selected' : '' }}>Years</option>
            </select>
        </div>

            <div class="form-label">
                <label for="open-date">Open Date:</label>
                <input type="date" name="open_date" class="form-control" required>
            </div>

            <div class="form-label">
                <label for="close-date">Close Date:</label>
            <input type="date" name="close_date" class="form-control" required>
        </div>

        <!-- Status -->
        <div class="form-group">
            <label class="text" for="status">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="draft" {{ $job->status === 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="open" {{ $job->status === 'open' ? 'selected' : '' }}>Open</option>
                <option value="closed" {{ $job->status === 'closed' ? 'selected' : '' }}>Closed</option>
            </select>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Save Changes</button>
        <a href="{{ route('jppstm.manage_hiring.index') }}" class="btn btn-secondary">Cancel</a> <!-- Cancel button -->
    </form>
</div>

    @include('components.jppstm.footer')
