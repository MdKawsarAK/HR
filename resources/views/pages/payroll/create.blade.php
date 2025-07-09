@extends('layouts.master')

@section('page')
<style>
    label {
        font-weight: 600;
    }
    select.form-select, input.form-control {
        background-color: #f9f9f9;
        border-radius: 8px;
        border: 1px solid #ccc;
    }
    .btn {
        border-radius: 6px;
    }
    h2, h5 {
        color: #2c3e50;
    }
    .form-section {
        background: #fff;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
        margin-bottom: 20px;
    }
</style>

<div class="container mt-4">
    <div class="form-section">
        <h2 class="mb-4">Create Payroll Bills</h2>

        <form action="{{ route('payroll.invoices.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="employee_id" class="form-label">Employee</label>
                <select name="employee_id" id="employee_id" class="form-select" required style="color: #333;">
                    <option value="">Select Employee</option>
                    @foreach ($employees as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="billed_month" class="form-label">Billing Month</label>
                <select name="billing_month" id="billing_month" class="form-select" required>
                    <option value="">Select Month</option>
                    @foreach(range(1, 12) as $m)
                        <option value="{{ $m }}">{{ \Carbon\Carbon::create()->month($m)->format('F') }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="month_count" class="form-label">Number of Months</label>
                <input type="number" name="month_count" id="month_count" class="form-control" value="1" min="1" required>
            </div>

            <hr>
            <h5>Payroll Items</h5>

            <div id="payroll-items">
                <div class="row mb-2 payroll-item">
                    <div class="col-md-6">
                        <select name="items[0][id]" class="form-select payroll-item-select" required>
                            <option value="">Select Item</option>
                            @foreach ($items as $item)
                                <option value="{{ $item->id }}">{{ $item->name }} ({{ $item->type->name }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <input type="number" name="items[0][amount]" class="form-control payroll-amount" placeholder="Amount" required>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger remove-item">X</button>
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-secondary mb-3" id="add-item">+ Add Item</button>

            <div class="mb-3">
                <label for="invoice_total" class="form-label">Total</label>
                <input type="number" name="invoice_total" id="invoice_total" class="form-control" readonly>
            </div>

            <button class="btn btn-primary" type="submit">Create Employee Bills</button>
        </form>
    </div>
</div>

<script>
let itemIndex = 1;

function calculateTotal() {
    let total = 0;
    let months = parseInt(document.getElementById('month_count').value) || 1;

    document.querySelectorAll('.payroll-amount').forEach(input => {
        let value = parseFloat(input.value);
        if (!isNaN(value)) {
            total += value;
        }
    });

    document.getElementById('invoice_total').value = (total * months).toFixed(2);
}

document.getElementById('add-item').addEventListener('click', function() {
    const container = document.getElementById('payroll-items');
    const clone = container.firstElementChild.cloneNode(true);

    clone.querySelectorAll('input, select').forEach(input => {
        input.name = input.name.replace(/\d+/, itemIndex);
        input.value = '';
    });

    container.appendChild(clone);
    itemIndex++;
});

document.addEventListener('click', function(e) {
    if (e.target.classList.contains('remove-item')) {
        const itemRow = e.target.closest('.payroll-item');
        if (document.querySelectorAll('.payroll-item').length > 1) {
            itemRow.remove();
            calculateTotal();
        }
    }
});

document.addEventListener('input', function(e) {
    if (e.target.classList.contains('payroll-amount') || e.target.id === 'month_count') {
        calculateTotal();
    }
});
</script>
@endsection
