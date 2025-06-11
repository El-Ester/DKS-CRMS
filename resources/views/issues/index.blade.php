@extends('layouts.app')

@section('content')
<h2>Diagnostic Cases</h2>
<a href="{{ route('issues.create') }}" class="btn btn-primary mb-2">Add New Case</a>

<table class="table">
    <thead>
        <tr>
            <th>Issue No</th>
            <th>Customer</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($issues as $issue)
            <tr>
                <td>{{ $issue->issue_number }}</td>
                <td>{{ $issue->customer_name }}</td>
                <td>{{ $issue->status->status_title ?? 'N/A' }}</td>
                <td>
                    <a href="{{ route('issues.show', $issue->issue_id) }}" class="btn btn-sm btn-info">View</a>
                    <a href="{{ route('issues.edit', $issue->issue_id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('issues.destroy', $issue->issue_id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
