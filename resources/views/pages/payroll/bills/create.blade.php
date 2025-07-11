<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create Payroll Bill - HR Software</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container-box {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 30px;
            max-width: 900px;
            margin: 40px auto;
        }

        .logo {
            height: 50px;
        }

        .footer {
            border-top: 1px solid #ddd;
            margin-top: 40px;
            padding-top: 10px;
            font-size: 0.9rem;
            color: #777;
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="container-box">
        <!-- Header -->
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

        <h3 class="text-center fw-bold mb-4">Create Payroll Bill</h3>

        <form id="BillForm">
            <!-- Bill Info -->
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <select name="employee_id" id="employee_id" class="form-select">
                        <option value="">----------select customer--------</option>
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->first_name . $employee->last_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <input type="date" class="form-control" name="created_at" placeholder="Created At" required>
                </div>
                <div class="col-md-4">
                    <input type="date" class="form-control" name="billed_at" placeholder="Billed At" required>
                </div>
                <div class="col-md-4">
                    <input type="number" class="form-control" name="bill_total" placeholder="Bill Total" required>
                </div>
                <div class="col-md-4">
                    <select name="status" class="form-select">
                        <option value="Pending">Pending</option>
                        <option value="Paid">Paid</option>
                        <option value="Overdue">Overdue</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="remarks" placeholder="Remarks">
                </div>
            </div>

            <!-- Item Inputs -->
            <h5 class="mb-3">Add Bill Items</h5>
            <div class="row g-2 mb-3">
                <div class="col-md-3">
                    <input type="text" class="form-control" id="bill_id" placeholder="Bill ID">
                </div>
                <div class="col-md-3">
                    <select name="employee_id" id="employee_id" class="form-select">
                        <option value="">----------select item--------</option>
                        @foreach ($items as $item)
                            <option value="{{ $item->id }}">{{ $item->first_name . $employee->last_name }}</option>
                        @endforeach
                    </select>
                    <!-- <input type="text" class="form-control" id="item_id" placeholder="Item ID"> -->
                </div>
                <div class="col-md-3"><input type="number" class="form-control" id="amount" placeholder="Amount"></div>
                <div class="col-md-3"> <button type="button" class="btn btn-primary btn-sm mb-4" onclick="addItem()">Add
                        Item</button>
                </div>
            </div>

            <!-- Item Table -->
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Bill ID</th>
                        <th>Item ID</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody id="itemsTable"></tbody>
            </table>

            <!-- Submit -->
            <div class="text-end mt-4">
                <button type="button" class="btn btn-success" onclick="submitBill()">Submit Bills</button>
            </div>
        </form>

        <!-- Footer -->
        <div class="footer">
            &copy; 2025 HR Software. All rights reserved.
        </div>
    </div>

    <script>
        const items = [];

        function addItem() {
            const bill_id = document.getElementById("bill_id").value;
            const item_id = document.getElementById("item_id").value;
            const amount = parseFloat(document.getElementById("amount").value) || 0;

            if (!bill_id || !item_id || amount <= 0) {
                alert("Please enter valid item details.");
                return;
            }

            const item = { bill_id, item_id, amount };
            items.push(item);
            renderItems();
            updateTotal();
            clearInputs();
        }

        function renderItems() {
            const tbody = document.getElementById("itemsTable");
            tbody.innerHTML = "";
            items.forEach(item => {
                tbody.innerHTML += `
        <tr>
          <td>${item.bill_id}</td>
          <td>${item.item_id}</td>
          <td>${item.amount.toFixed(2)}</td>
        </tr>`;
            });
        }

        function updateTotal() {
            const total = items.reduce((sum, item) => sum + item.amount, 0);
            document.querySelector('[name="bill_total"]').value = total.toFixed(2);
        }

        function clearInputs() {
            document.getElementById("bill_id").value = "";
            document.getElementById("item_id").value = "";
            document.getElementById("amount").value = "";
        }

        function submitBill() {
            const form = document.getElementById("invoiceForm");

            const data = {
                employee_id: form.employee_id.value,
                created_at: form.created_at.value,
                billed_at: form.billed_at.value,
                bill_total: parseFloat(form.bill_total.value),
                status: form.status.value,
                remarks: form.remarks.value,
                items: items
            };

            console.log("Invoice JSON:", JSON.stringify(data, null, 2));
            alert("Invoice submitted! Check the console for output.");
        }
    </script>



</body>

</html>