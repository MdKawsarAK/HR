<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

namespace App\Http\Controllers;

use App\Models\HR\payroll\PayrollConfig;
use App\Models\HR\payroll\PayrollInvoice;
use App\Models\HR\payroll\PayrollInvoiceDetail;
use Illuminate\Support\Carbon;

class PayrollInvoiceController extends Controller
{
    public function generate($employeeId)
    {
        $configs = PayrollConfig::where('employee_id', $employeeId)->get();

        if ($configs->isEmpty()) {
            return back()->with('error', 'No payroll config found for this employee.');
        }

        $invoice = PayrollInvoice::create([
            'employee_id' => $employeeId,
            'created_at' => now(),
            'billed_at' => now(),
            'invoice_total' => 0
        ]);

        $total = 0;
        foreach ($configs as $config) {
            PayrollInvoiceDetail::create([
                'invoice_id' => $invoice->id,
                'item_id' => $config->payroll_item_id,
                'amount' => $config->amount
            ]);
            $total += $config->amount;
        }

        $invoice->update(['invoice_total' => $total]);

        return redirect()->route('pages.payroll.invoice.show', $invoice->id);
    }

        public function create()
    {
        return view("pages.payroll.create");
    }

    public function show($invoiceId)
    {
        $invoice = PayrollInvoice::with(['details.item', 'employee'])->findOrFail($invoiceId);
        return view('pages.payroll.invoice', compact('invoice'));
    }
}
