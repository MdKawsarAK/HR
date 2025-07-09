<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\HR\payroll\payrollInvoice;
use App\Models\HR\payroll\payrollInvoiceDetail;
use App\Models\HR\payroll\payrollItem;
use App\Models\HR\payroll\payrollItemType;
use App\Models\Employee;

class PayrollInvoiceController extends Controller
{
    /**
     * Display a listing of the payroll invoices.
     */
    public function index()
    {
        $invoices = PayrollInvoice::with('employee')->get();
        return view('pages.payroll.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new payroll invoice.
     */
    public function create()
    {

        $employees = Employee::all();
        $items = PayrollItem::with('type')->get();
        return view('pages.payroll.create', compact('employees', 'items'));
    }

    /**
     * Store a newly created payroll invoice in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'billed_at' => 'required|date',
            'invoice_total' => 'required|numeric',
            'items' => 'required|array',
            'items.*.id' => 'required|exists:payroll_items,id',
            'items.*.amount' => 'required|numeric',
        ]);

        DB::beginTransaction();
        try {
            $invoice = new PayrollInvoice();
            $invoice->employee_id = $request->employee_id;
            $invoice->created_at = now();
            $invoice->billed_at = $request->billed_at;
            $invoice->invoice_total = $request->invoice_total;
            $invoice->save();

            foreach ($request->items as $item) {
                $detail = new PayrollInvoiceDetail();
                $detail->invoice_id = $invoice->id;
                $detail->item_id = $item['id'];
                $detail->amount = $item['amount'];
                $detail->save();
            }

            DB::commit();
            return redirect()->route('payroll.invoices.index')->with('success', 'Invoice created successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified payroll invoice.
     */
    public function show($id)
    {
        $invoice = PayrollInvoice::with(['employee', 'details.item.type'])->findOrFail($id);
        return view('pages.payroll.show', compact('invoice'));
    }

    /**
     * Show the form for editing the specified payroll invoice.
     */
    public function edit($id)
    {
        $invoice = PayrollInvoice::with('details.item.type')->findOrFail($id);
        $employees = Employee::all();
        $items = PayrollItem::with('type')->get();
        return view('pages.payroll.edit', compact('invoice', 'employees', 'items'));
    }

    /**
     * Update the specified payroll invoice in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'billed_at' => 'required|date',
            'invoice_total' => 'required|numeric',
            'items' => 'required|array',
            'items.*.id' => 'required|exists:payroll_items,id',
            'items.*.amount' => 'required|numeric',
        ]);

        DB::beginTransaction();
        try {
            $invoice = PayrollInvoice::findOrFail($id);
            $invoice->employee_id = $request->employee_id;
            $invoice->billed_at = $request->billed_at;
            $invoice->invoice_total = $request->invoice_total;
            $invoice->save();

            // Delete old details
            PayrollInvoiceDetail::where('invoice_id', $invoice->id)->delete();

            // Insert new details
            foreach ($request->items as $item) {
                $detail = new PayrollInvoiceDetail();
                $detail->invoice_id = $invoice->id;
                $detail->item_id = $item['id'];
                $detail->amount = $item['amount'];
                $detail->save();
            }

            DB::commit();
            return redirect()->route('payroll.invoices.index')->with('success', 'Invoice updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified payroll invoice from storage.
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            PayrollInvoiceDetail::where('invoice_id', $id)->delete();
            PayrollInvoice::destroy($id);
            DB::commit();
            return redirect()->route('payroll.invoices.index')->with('success', 'Invoice deleted.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
}
