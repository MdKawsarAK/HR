@extends('layouts.master')

@section('page')
<div class="container">
    <h3>Payroll Bill #{{ $Bill->id }}</h3>

    <p><strong>Employee:</strong> {{ $Bill->employee->first_name }} {{ $Bill->employee->last_name }}</p>
    <p><strong>Billed At:</strong> {{ $Bill->billed_at }}</p>
    <p><strong>Status:</strong> {{ $Bill->status }}</p>
    <p><strong>Total:</strong> {{ $Bill->bill_total }}</p>
    <p><strong>Remarks:</strong> {{ $Bill->remarks }}</p>

    <h5 class="mt-4">Bill Items</h5>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Bill ID</th>
                <th>Item ID</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
        @foreach($Bill->items as $item)
            <tr>
                <td>{{ $item->bill_id }}</td>
                <td>{{ $item->item_id }}</td>
                <td>{{ $item->amount }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <a href="{{ route('payroll.bills.index') }}" class="btn btn-secondary mt-3">Back to List</a>
</div>
@endsection
