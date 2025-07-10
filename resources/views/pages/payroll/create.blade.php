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
