<!DOCTYPE html>
<html>
<head>
    <title>Payroll Invoice</title>
</head>
<body>
    <h2>Payroll Invoice for {{ $invoice->employee->name ?? 'Employee' }}</h2>
    <p>Billed At: {{ $invoice->billed_at }}</p>
    <p>Created: {{ $invoice->created_at }}</p>

    <table border="1" cellpadding="5">
        <thead>
            <tr>
                <th>Salary Item</th>
                <th>Amount (৳)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoice->details as $detail)
                <tr>
                    <td>{{ $detail->item->name ?? 'N/A' }}</td>
                    <td>{{ number_format($detail->amount, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Total</th>
                <th>{{ number_format($invoice->invoice_total, 2) }}</th>
            </tr>
        </tfoot>
    </table>
</body>
</html>
