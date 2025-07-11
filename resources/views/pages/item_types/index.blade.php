@extends('layouts.master')

@section('page')
<div class="container py-4">
    <h3 class="mb-4">Payroll Bill List</h3>
    <a href="{{ route('payroll_bills.create') }}" class="btn btn-primary mb-3">Create Payroll Bill</a>

    <table class="table table-bordered" id="billsTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Employee</th>
                <th>Billed At</th>
                <th>Total</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($bills as $bill)
            <tr>
                <td>{{ $bill->id }}</td>
                <td>{{ $bill->employee->first_name ?? 'N/A' }} {{ $bill->employee->last_name ?? '' }}</td>
                <td>{{ $bill->billed_at }}</td>
                <td>{{ $bill->bill_total }}</td>
                <td>{{ $bill->status }}</td>
                <td>
                    <a href="{{ route('payroll_bills.show', $bill->id) }}" class="btn btn-sm btn-info">View</a>
                    <a href="{{ route('payroll_bills.edit', $bill->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('payroll_bills.destroy', $bill->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this bill?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<!-- Optional: DataTable -->
@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#billsTable').DataTable();
    });
</script>
@endpush
@endsection
