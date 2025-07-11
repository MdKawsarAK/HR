@extends('layouts.master')

<!-- @section('page')
<div class="container">
    <h2 class="mb-4">Employee Bills</h2>

    <a href="{{ route('payroll.bills.create') }}" class="btn btn-primary mb-3">+ Create New Bills</a>

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
            @foreach ($Bills as $Bill)
            <tr>
                <td>{{ $Bill->id }}</td>
                <td>{{ $Bill->employee->name ?? 'N/A' }}</td>
                <td>{{ $Bill->billed_at }}</td>
                <td>{{ $Bill->Bill_total }}</td>
                <td>
                    <a href="{{ route('payroll.Bills.show', $Bill->id) }}" class="btn btn-sm btn-info">View</a>
                    <a href="{{ route('payroll.Bills.edit', $Bill->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('payroll.Bills.destroy', $Bill->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this Bill?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection -->
 <!-- Adjust based on your layout -->

@section('page')
<div class="container">
    <h3 class="mb-4">All Payroll Bills</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('payroll.bills.create') }}" class="btn btn-primary mb-3">+ Create New Bill</a>

    <table class="table table-bordered">
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
        @foreach($bills as $bill)
            <tr>
                <td>{{ $bill->id }}</td>
                <td>{{ $bill->employee->first_name }} {{ $bill->employee->last_name }}</td>
                <td>{{ $bill->billed_at }}</td>
                <td>{{ $bill->bill_total }}</td>
                <td>{{ $bill->status }}</td>
                <td>
                    <a href="{{ route('payroll.bills.show', $bill->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('payroll.bills.edit', $bill->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('payroll.bills.destroy', $bill->id) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('Are you sure to delete this bill?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
