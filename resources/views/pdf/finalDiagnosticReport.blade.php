<!DOCTYPE html>
<html>
<head>
    <title>Final Diagnostic Report</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        h2 { text-align: center; }
    </style>
</head>
<body>
    <h2>Final Diagnostic Report</h2>
    <p><strong>Case Number:</strong> {{ $case->issue_number }}</p>
    <p><strong>Diagnostic Date:</strong> {{ $case->diagnostic_date }}</p>
    <p><strong>Completion Date:</strong> {{ $case->completion_date }}</p>
    <p><strong>Service Engineer:</strong> {{ $case->service_engineer }}</p>
    <p><strong>Problem Verification:</strong> {{ $case->problem_verification }}</p>
    <p><strong>Work Description:</strong> {{ $case->work_description }}</p>
    <p><strong>Repair Cost:</strong> {{ $case->repair_cost }}</p>
</body>
</html>
