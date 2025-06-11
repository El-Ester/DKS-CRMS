<!DOCTYPE html>
<html>
<head>
    <title>Case Report</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        h2 { text-align: center; }
    </style>
</head>
<body>
    <h2>Case Report</h2>
    <p><strong>Case Number:</strong> {{ $case->issue_number }}</p>
    <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($case->issue_date)->format('Y-m-d') }}</p>
    <p><strong>Customer:</strong> {{ $case->customer_name }}</p>
    <p><strong>Company:</strong> {{ $case->company }}</p>
    <p><strong>Contact:</strong> {{ $case->contact_no }}</p>
    <p><strong>Email:</strong> {{ $case->customer_email }}</p>
    <p><strong>Problem Statement:</strong> {{ $case->problem_statement }}</p>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <title>Case Report</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        h2 { text-align: center; }
    </style>
</head>
<body>
    <h2>Case Report</h2>
    <p><strong>Case Number:</strong> {{ $case->issue_number }}</p>
    <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($case->issue_date)->format('Y-m-d') }}</p>
    <p><strong>Customer:</strong> {{ $case->customer_name }}</p>
    <p><strong>Company:</strong> {{ $case->company }}</p>
    <p><strong>Contact:</strong> {{ $case->contact_no }}</p>
    <p><strong>Email:</strong> {{ $case->customer_email }}</p>
    <p><strong>Problem Statement:</strong> {{ $case->problem_statement }}</p>
</body>
</html>
