@extends('layouts.master')

@section('page')
<div class="container"><h2>
    Payroll Invoice for
    {{ $invoice->employee->first_name ?? 'Unknown' }}
    {{ $invoice->employee->last_name ?? '' }}
</h2>


    <p><strong>Employee:</strong> {{ $invoice->employee->name }}</p>
    <p><strong>Billed Date:</strong> {{ $invoice->billed_at }}</p>
    <p><strong>Created At:</strong> {{ $invoice->created_at }}</p>
    <p><strong>Total:</strong> {{ $invoice->invoice_total }}</p>


    <hr>
    <h5>Items</h5>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Item</th>
                <th>Type</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoice->details as $detail)
            <tr>
                <td>{{ $detail->item->name }}</td>
                <td>{{ $detail->item->type->name }}</td>
                <td>{{ $detail->amount }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('payroll.invoices.index') }}" class="btn btn-secondary mt-3">Back to List</a>
@endsection

DROP TABLE IF EXISTS `test`.`core_invoices`;
CREATE TABLE  `test`.`core_invoices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) unsigned NOT NULL,
  `created_at` datetime NOT NULL,
  `remark` varchar(45) DEFAULT NULL,
  `payment_term` varchar(45) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `invoice_total` float NOT NULL,
  `paid_total` float NOT NULL,
  `previous_due` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;