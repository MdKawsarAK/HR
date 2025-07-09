@extends('layouts.master')

@section('page')
<div class="container">
    <h2 class="mb-4">Edit Payroll Invoice #{{ $invoice->id }}</h2>

    <form action="{{ route('payroll.invoices.update', $invoice->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="employee_id" class="form-label">Employee</label>
            <select name="employee_id" id="employee_id" class="form-select" required>
                @foreach ($employees as $employee)
                    <option value="{{ $employee->id }}" {{ $employee->id == $invoice->employee_id ? 'selected' : '' }}>
                        {{ $employee->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="billed_at" class="form-label">Billed Date</label>
            <input type="datetime-local" name="billed_at" class="form-control"
                value="{{ \Carbon\Carbon::parse($invoice->billed_at)->format('Y-m-d\TH:i') }}" required>
        </div>

        <hr>
        <h5>Payroll Items</h5>

        <div id="payroll-items">
            @foreach ($invoice->details as $index => $detail)
            <div class="row mb-2 payroll-item">
                <div class="col-md-6">
                    <select name="items[{{ $index }}][id]" class="form-select" required>
                        @foreach ($items as $item)
                            <option value="{{ $item->id }}" {{ $item->id == $detail->item_id ? 'selected' : '' }}>
                                {{ $item->name }} ({{ $item->type->name }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <input type="number" name="items[{{ $index }}][amount]" class="form-control"
                        value="{{ $detail->amount }}" required>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-danger remove-item">X</button>
                </div>
            </div>
            @endforeach
        </div>

        <button type="button" class="btn btn-secondary mb-3" id="add-item">+ Add Item</button>

        <div class="mb-3">
            <label for="invoice_total" class="form-label">Total</label>
            <input type="number" name="invoice_total" id="invoice_total" class="form-control"
                value="{{ $invoice->invoice_total }}" required>
        </div>

        <button class="btn btn-primary" type="submit">Update Invoice</button>
    </form>
</div>

<script>
let itemIndex = {{ $invoice->details->count() }};

document.getElementById('add-item').addEventListener('click', function () {
    const container = document.getElementById('payroll-items');
    const clone = container.firstElementChild.cloneNode(true);

    clone.querySelectorAll('input, select').forEach(input => {
        input.name = input.name.replace(/\[\d+\]/, `[${itemIndex}]`);
        input.value = '';
    });

    container.appendChild(clone);
    itemIndex++;
});

document.addEventListener('click', function (e) {
    if (e.target.classList.contains('remove-item')) {
        const row = e.target.closest('.payroll-item');
        if (document.querySelectorAll('.payroll-item').length > 1) {
            row.remove();
        }
    }
});
</script>
@endsection
