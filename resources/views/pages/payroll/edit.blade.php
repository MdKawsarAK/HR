@extends('layouts.master')

@section('page')
<div class="container-box bg-white p-4 rounded shadow-sm mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <img src="https://via.placeholder.com/120x50?text=LOGO" alt="Logo" class="logo">
            <h4 class="mt-2">HR Management System</h4>
        </div>
        <div class="text-end">
            <p>123 Corporate Blvd, Office 10</p>
            <p>Email: hr@company.com</p>
            <p>Phone: +123-456-7890</p>
        </div>
    </div>

    <h3 class="text-center fw-bold mb-4">Edit Payroll Bill</h3>

    <form action="{{ route('payroll.bills.update', $Bill->id) }}" method="POST" id="BillForm">
        @csrf
        @method('PUT')

        <!-- Bill Info -->
        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <select name="employee_id" id="employee_id" class="form-select" required>
                    <option value="">-- Select Employee --</option>
                    @foreach ($employees as $employee)
                        <option value="{{ $employee->id }}" {{ $employee->id == $Bill->employee_id ? 'selected' : '' }}>
                            {{ $employee->first_name }} {{ $employee->last_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <input type="date" class="form-control" name="created_at" value="{{ $Bill->created_at->format('Y-m-d') }}" required>
            </div>
            <div class="col-md-4">
                <input type="date" class="form-control" name="billed_at" value="{{ $Bill->billed_at->format('Y-m-d') }}" required>
            </div>
            <div class="col-md-4">
                <input type="number" class="form-control" name="bill_total" id="bill_total" value="{{ $Bill->bill_total }}" required readonly>
            </div>
            <div class="col-md-4">
                <select name="status" class="form-select">
                    @foreach(['Pending', 'Paid', 'Overdue'] as $status)
                        <option value="{{ $status }}" {{ $Bill->status === $status ? 'selected' : '' }}>{{ $status }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control" name="remarks" value="{{ $Bill->remarks }}" placeholder="Remarks">
            </div>
        </div>

        <!-- Item Inputs -->
        <h5 class="mb-3">Edit Bill Items</h5>
        <div class="row g-2 mb-3">
            <div class="col-md-3">
                <input type="text" class="form-control" id="bill_id" placeholder="Bill ID">
            </div>
            <div class="col-md-3">
                <select id="item_id" class="form-select">
                    <option value="">-- Select Item --</option>
                    @foreach($items as $item)
                        <option value="{{ $item->id }}">{{ $item->name ?? ('Item #' . $item->id) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <input type="number" class="form-control" id="amount" placeholder="Amount">
            </div>
            <div class="col-md-3 d-flex align-items-start">
                <button type="button" class="btn btn-primary btn-sm" onclick="addItem()">Add Item</button>
            </div>
        </div>

        <!-- Item Table -->
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Bill ID</th>
                    <th>Item ID</th>
                    <th>Amount</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="itemsTable"></tbody>
        </table>

        <input type="hidden" name="items" id="items_json">

        <!-- Submit -->
        <div class="text-end mt-4">
            <button type="submit" class="btn btn-success">Update Bill</button>
            <a href="{{ route('payroll.bills.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

<script>
    let items = @json($Bill->items->map(fn($i) => [
        'bill_id' => $i->bill_id,
        'item_id' => $i->item_id,
        'amount' => $i->amount
    ]));

    function addItem() {
        const bill_id = document.getElementById("bill_id").value;
        const item_id = document.getElementById("item_id").value;
        const amount = parseFloat(document.getElementById("amount").value);

        if (!bill_id || !item_id || amount <= 0) {
            alert("Please enter valid item details.");
            return;
        }

        items.push({ bill_id, item_id, amount });
        renderItems();
        clearInputs();
    }

    function removeItem(index) {
        items.splice(index, 1);
        renderItems();
    }

    function renderItems() {
        const tbody = document.getElementById("itemsTable");
        const totalField = document.getElementById("bill_total");
        tbody.innerHTML = "";
        let total = 0;

        items.forEach((item, index) => {
            total += parseFloat(item.amount);
            tbody.innerHTML += `
                <tr>
                    <td>${item.bill_id}</td>
                    <td>${item.item_id}</td>
                    <td>${item.amount.toFixed(2)}</td>
                    <td><button type="button" class="btn btn-sm btn-danger" onclick="removeItem(${index})">Remove</button></td>
                </tr>`;
        });

        totalField.value = total.toFixed(2);
        document.getElementById('items_json').value = JSON.stringify(items);
    }

    function clearInputs() {
        document.getElementById("bill_id").value = "";
        document.getElementById("item_id").value = "";
        document.getElementById("amount").value = "";
    }

    document.addEventListener('DOMContentLoaded', renderItems);
</script>
@endsection
