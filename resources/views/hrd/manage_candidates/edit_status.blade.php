<form action="{{ route('hrd.candidates.update_status', $application->id) }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="status">Status</label>
        <select name="status" id="status" class="form-control">
            <option value="pending" {{ $application->application_status == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="accepted" {{ $application->application_status == 'accepted' ? 'selected' : '' }}>Accepted</option>
            <option value="rejected" {{ $application->application_status == 'rejected' ? 'selected' : '' }}>Rejected</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary mt-3">Update Status</button>
</form>
