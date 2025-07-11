@extends('layouts.master')

@section('page')
  <style>
    label {
    font-weight: 600;
    }

    select.form-control,
    input.form-control {
    background-color: #f9f9f9;
    border-radius: 8px;
    border: 1px solid #ccc;
    }

    .btn {
    border-radius: 6px;
    }

    h2,
    h5 {
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

    <div class="mb-3">
      <label for="employee_id" class="form-label">Employee</label>
      <select name="employee_id" id="employee_id" class="form-control" required>
      <option value="">Select Employee</option>
      @foreach ($employees as $employee)
      <option value="{{ $employee->id }}">{{ $employee->first_name . $employee->last_name }}</option>
    @endforeach
      </select>
    </div>

    <div class="mb-3">
      <label for="billed_month" class="form-label">Billing Date</label>
      <input id="bill-date" type="date" class="form-control">
      <!-- <select name="billing_month" id="billing_month" class="form-control" required>
            <option value="">Select Month</option>
            @foreach(range(1, 12) as $m)
              <option value="{{ $m }}">{{ \Carbon\Carbon::create()->month($m)->format('F') }}</option>
            @endforeach
          </select> -->
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
        <select name="items[0][id]" class="form-control payroll-item-select" required>
        <option value="">Select Item</option>
        @foreach ($items as $item)
      <option value="{{ $item->id }}">{{ $item->name }} ({{ $item->type->name }})</option>
      @endforeach
        </select>
      </div>
      <div class="col-md-4">
        <input type="number" name="items[0][amount]" class="form-control payroll-amount" placeholder="Amount"
        required>
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

    <button class="btn btn-primary" id="crate-btn">Create Employee Bills</button>
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

    document.getElementById('add-item').addEventListener('click', function () {
    const container = document.getElementById('payroll-items');
    const clone = container.firstElementChild.cloneNode(true);

    clone.querySelectorAll('input, select').forEach(input => {
      input.name = input.name.replace(/\d+/, itemIndex);
      input.value = '';
    });

    container.appendChild(clone);
    itemIndex++;
    });

    document.addEventListener('click', function (e) {
    if (e.target.classList.contains('remove-item')) {
      const itemRow = e.target.closest('.payroll-item');
      if (document.querySelectorAll('.payroll-item').length > 1) {
      itemRow.remove();
      calculateTotal();
      }
    }
    });



    document.addEventListener('input', function (e) {
    if (e.target.classList.contains('payroll-amount') || e.target.id === 'month_count') {
      calculateTotal();
    }
    });


    //collect data
    function collectFormData() {
    const formData = {
      items: [],
      others: {}
    };

    // Collect repeating item data (assuming class 'payroll-item')
    document.querySelectorAll('.payroll-item').forEach(item => {
      const itemData = {};
      item.querySelectorAll('input, select').forEach(input => {
      itemData[input.name] = input.value;
      });
      formData.items.push(itemData);
    });

    // Collect other fields (not inside .payroll-item)
    const otherFields = ['month_count', 'invoice_total'];
    otherFields.forEach(id => {
      const el = document.getElementById(id);
      if (el) {
      formData.others[id] = el.value;
      }
    });

    return formData;
    }


    //handel create invoices
    document.getElementById('crate-btn').addEventListener('click', () => {
    const data = collectFormData();
    const items = data.items;
    const others = data.others;
    const payload = {
      items,
      bill_total: data.others.invoice_total,


    }
    console.log(items, others);
    });

  </script>
@endsection








<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Create Invoice - HR Software</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }

    .invoice-box {
      background: #fff;
      padding: 30px;
      max-width: 900px;
      margin: auto;
      border-radius: 10px;
      border: 1px solid #dee2e6;
    }

    .logo {
      height: 50px;
    }

    .form-control {
      font-size: 0.9rem;
    }

    .table thead th {
      background-color: #f1f1f1;
    }

    .footer {
      border-top: 1px solid #ccc;
      margin-top: 30px;
      padding-top: 10px;
      text-align: center;
      font-size: 0.9rem;
      color: #6c757d;
    }
  </style>
</head>

<body>

  <div class="invoice-box mt-4">
    <!-- Header -->
    <div class="d-flex justify-content-between mb-4">
      <div>
        <img src="https://via.placeholder.com/120x50?text=LOGO" class="logo" alt="Logo">
        <h4 class="mt-2">Larana & Co</h4>
      </div>
      <div class="text-end">
        <p>123 Lorawan St, Zone City</p>
        <p>Email: info@laranaco.com</p>
        <p>Phone: +123-456-7890</p>
      </div>
    </div>

    <h3 class="fw-bold text-center mb-4">Create Invoice</h3>

    <!-- Customer & Invoice Info -->
    <form id="invoiceForm">
      <div class="row g-3 mb-4">
        <div class="col-md-4">
          <select name="customer_io" id="customer_id" class="form-select">
            <option value="">----------select customer--------</option>
            @foreach ($employees as $employee)
        <option value="{{ $employee->id }}">{{ $employee->first_name . $employee->last_name }}</option>
      @endforeach
          </select>
          <input type="text" name="customer_id" class="form-control" placeholder="Customer ID" required>
        </div>
        <div class="col-md-4">
          <input type="text" name="remark" class="form-control" placeholder="Remark">
        </div>
        <div class="col-md-4">
          <input type="text" name="payment_term" class="form-control" placeholder="Payment Term">
        </div>
        <div class="col-md-4">
          <input type="number" name="invoice_total" class="form-control" placeholder="Invoice Total">
        </div>
        <div class="col-md-4">
          <input type="number" name="paid_total" class="form-control" placeholder="Paid Total">
        </div>
        <div class="col-md-4">
          <input type="number" name="previous_due" class="form-control" placeholder="Previous Due">
        </div>
      </div>

      <!-- Add Items Section -->
      <h5 class="mb-3">Add Invoice Items</h5>
      <div class="row g-2 mb-2">
        <div class="col-md-2"><input type="text" id="invoice_id" class="form-control" placeholder="Invoice ID"></div>
        <div class="col-md-2"><input type="text" id="product_id" class="form-control" placeholder="Product ID"></div>
        <div class="col-md-2"><input type="number" id="price" class="form-control" placeholder="Price"></div>
        <div class="col-md-2"><input type="number" id="qty" class="form-control" placeholder="Qty"></div>
        <div class="col-md-2"><input type="number" id="discount" class="form-control" placeholder="Discount"></div>
        <div class="col-md-2"><input type="number" id="vat" class="form-control" placeholder="VAT"></div>
      </div>
      <div class="mb-4">
        <button type="button" class="btn btn-sm btn-primary" onclick="addItem()">Add Item</button>
      </div>

      <!-- Items Table -->
      <table class="table table-bordered" id="itemsTable">
        <thead>
          <tr>
            <th>Invoice ID</th>
            <th>Product ID</th>
            <th>Price</th>
            <th>Qty</th>
            <th>Discount</th>
            <th>VAT</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>

      <!-- Submit Button -->
      <div class="text-end mt-4">
        <button type="button" class="btn btn-success" onclick="submitInvoice()">Submit Invoice</button>
      </div>
    </form>

    <!-- Footer -->
    <div class="footer mt-5">
      &copy; 2025 HR Software. All rights reserved.
    </div>
  </div>

  <script>
    const items = [];

    function addItem() {
      const item = {
        invoice_id: document.getElementById("invoice_id").value,
        product_id: document.getElementById("product_id").value,
        price: parseFloat(document.getElementById("price").value) || 0,
        qty: parseFloat(document.getElementById("qty").value) || 0,
        discount: parseFloat(document.getElementById("discount").value) || 0,
        vat: parseFloat(document.getElementById("vat").value) || 0
      };
      items.push(item);
      renderItems();
      clearItemInputs();
    }

    function renderItems() {
      const tbody = document.querySelector("#itemsTable tbody");
      tbody.innerHTML = "";
      items.forEach(item => {
        const row = `
        <tr>
          <td>${item.invoice_id}</td>
          <td>${item.product_id}</td>
          <td>${item.price}</td>
          <td>${item.qty}</td>
          <td>${item.discount}</td>
          <td>${item.vat}</td>
        </tr>`;
        tbody.innerHTML += row;
      });
    }

    function clearItemInputs() {
      ["invoice_id", "product_id", "price", "qty", "discount", "vat"].forEach(id => {
        document.getElementById(id).value = "";
      });
    }

    function submitInvoice() {
      const form = document.getElementById("invoiceForm");
      const data = {
        customer_id: form.customer_id.value,
        remark: form.remark.value,
        payment_term: form.payment_term.value,
        invoice_total: form.invoice_total.value,
        paid_total: form.paid_total.value,
        previous_due: form.previous_due.value,
        items: items
      };

      console.log("Invoice Data:", JSON.stringify(data, null, 2));
      alert("Invoice submitted! Check the console for data.");
    }
  </script>

</body>

</html>