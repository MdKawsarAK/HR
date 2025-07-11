<?php

namespace App\Http\Controllers;

use App\Models\Payroll\PayrollBill;
use App\Models\Payroll\PayrollBillItem;
use App\Models\Payroll\Employee;
use App\Models\Payroll\PayrollItem;
use Illuminate\Http\Request;

class PayrollBillController extends Controller
{
    // Show list of bills (index)
    public function index()
    {
        $bills = PayrollBill::with('items', 'employee')->orderByDesc('id')->get();
        return view('pages.payroll.bills.index', compact('bills'));
    }

    // Show the form to create a new Bill
    public function create()
    {
        $employees = Employee::all();
        $items = PayrollItem::all();
        return view('pages.payroll.bills.create', compact('employees', 'items'));
    }

    // Store the submitted Bill with items
    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'created_at' => 'required|date',
            'billed_at' => 'required|date',
            'bill_total' => 'required|numeric',
            'status' => 'required|string',
            'remarks' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.bill_id' => 'required|string',
            'items.*.item_id' => 'required|string',
            'items.*.amount' => 'required|numeric',
        ]);

        // Create Bill
        $Bill = PayrollBill::create($validated);

        // Save items
        foreach ($validated['items'] as $item) {
            $item['payroll_Bill_id'] = $Bill->id;
            PayrollItem::create($item);
        }

        return redirect()->route('pages.payroll.bills.index')->with('success', 'Payroll Bill created successfully.');
    }

    // Show a single Bill
    public function show($id)
    {
        $Bill = PayrollBill::with('items', 'employee')->findOrFail($id);
        return view('pages.payroll.bills.show', compact('Bill'));
    }

    // Edit view
    public function edit($id)
    {
        $Bill = PayrollBill::with('items')->findOrFail($id);
        $employees = Employee::all();
        $items = PayrollItem::all();
        return view('pages.payroll.bills.edit', compact('Bill', 'employees', 'items'));
    }

    // Update logic
    public function update(Request $request, $id)
    {
        $Bill = PayrollBill::findOrFail($id);

        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'created_at' => 'required|date',
            'billed_at' => 'required|date',
            'bill_total' => 'required|numeric',
            'status' => 'required|string',
            'remarks' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.bill_id' => 'required|string',
            'items.*.item_id' => 'required|string',
            'items.*.amount' => 'required|numeric',
        ]);

        $Bill->update($validated);

        // Remove old items and add new
        $Bill->items()->delete();
        foreach ($validated['items'] as $item) {
            $item['payroll_Bill_id'] = $Bill->id;
            PayrollItem::create($item);
        }

        return redirect()->route('pages.payroll.bills.index')->with('success', 'Payroll Bill updated successfully.');
    }

    // Delete Bill
    public function destroy($id)
    {
        $Bill = PayrollBill::findOrFail($id);
        $Bill->delete();

        return redirect()->route('pages.payroll.bills.index')->with('success', 'Payroll Bill deleted.');
    }
}
