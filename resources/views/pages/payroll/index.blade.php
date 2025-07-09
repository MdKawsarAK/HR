@extends('layouts.master')

@section('page')
<div class="container">
    <h2 class="mb-4">Employee Bills</h2>

    <a href="{{ route('payroll.invoices.create') }}" class="btn btn-primary mb-3">+ Create New Bills</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Employee</th>
                <th>Billed Date</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoices as $invoice)
            <tr>
                <td>{{ $invoice->id }}</td>
                <td>{{ $invoice->employee->name ?? 'N/A' }}</td>
                <td>{{ $invoice->billed_at }}</td>
                <td>{{ $invoice->invoice_total }}</td>
                <td>
                    <a href="{{ route('payroll.invoices.show', $invoice->id) }}" class="btn btn-sm btn-info">View</a>
                    <a href="{{ route('payroll.invoices.edit', $invoice->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('payroll.invoices.destroy', $invoice->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this invoice?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
