<?php

use App\Models\payroll\PayrollConfig;
use App\Models\payroll\PayrollInvoice;
use App\Models\payroll\PayrollInvoiceDetail;
use Illuminate\Support\Carbon;

class PayrollInvoiceController extends Controller
{
    public function generate($personId)
    { 
        $configs = PayrollConfig::where('person_id', $personId)->get();

        if ($configs->isEmpty()) {
            return back()->with('error', 'No salary config found.');
        }

        $invoice = PayrollInvoice::create([
            'person_id' => $personId,
            'created_at' => now(),
            'billed_at' => now(),
            'invoice_total' => 0,
        ]);

        $total = 0;
        foreach ($configs as $config) {
            PayrollInvoiceDetail::create([
                'invoice_id' => $invoice->id,
                'item_id' => $config->payroll_item_id,
                'amount' => $config->amount,
            ]);
            $total += $config->amount;
        }

        $invoice->update(['invoice_total' => $total]);

        return redirect()->route('payroll.invoice.show', $invoice->id);
    }

    public function show($invoiceId)
    {
        $invoice = PayrollInvoice::with(['details.item', 'person'])->findOrFail($invoiceId);
        return view('payroll.invoice', compact('invoice'));
    }
}
