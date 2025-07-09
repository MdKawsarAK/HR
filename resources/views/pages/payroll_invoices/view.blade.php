@extends('layouts.master')
@section('page')
    <!-- Page Header -->
    <div class="card bg-primary mb-3 p-4">
        <div class="row">
            <div class="col-12 d-flex justify-content-between align-item-center ">
                <h3 class=" card-title text-white d-flex align-items-center  m-0">Create PayrollInvoice</h3>
                <a href="{{ route('payroll_invoices.index') }}" class="btn btn-light btn-sm" title="Back">
                    <i class="fa fa-arrow-left mr-1"></i> Back
                </a>
            </div>
        </div>
    </div> 
<div class="mb-2">
    <strong>Id:</strong> {{ $payrollInvoice->id }}
</div>
<div class="mb-2">
    <strong>Employee id:</strong> {{ $payrollInvoice->employee->name ?? $payrollInvoice->employee_id }}
</div>
<div class="mb-2">
    <strong>Created at:</strong> {{ $payrollInvoice->created_at }}
</div>
<div class="mb-2">
    <strong>Billed at:</strong> {{ $payrollInvoice->billed_at }}
</div>
<div class="mb-2">
    <strong>Invoice total:</strong> {{ $payrollInvoice->invoice_total }}
</div>

@endsection