<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: DejaVu Sans; }
        h2 { text-align: center; }
    </style>
</head>
<body>
    <h2>Case Report: {{ $issue->issue_number }}</h2>
    <p><strong>Customer:</strong> {{ $issue->customer_name }}</p>
    <p><strong>Status:</strong> {{ $issue->status->status_title }}</p>
    <p><strong>Problem:</strong> {{ $issue->problem_statement }}</p>
    <p><strong>Solution:</strong> {{ $issue->work_description }}</p>
    <p><strong>Engineer:</strong> {{ $issue->user->user_full_name }}</p>
</body>
</html>
