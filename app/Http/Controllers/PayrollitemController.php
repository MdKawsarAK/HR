<?php

namespace App\Http\Controllers;

use App\Models\PayrollItem;
use Illuminate\Http\Request;
use App\Models\Type;


class PayrollItemController extends Controller
{
    public function index()
    {
        $payrollItems = PayrollItem::orderBy('id','desc')->paginate(10);
        return view('pages.payrollItems.index', compact('payrollItems'));
    }

    public function create()
    {
        $types = \App\Models\Type::all();

        return view('pages.payrollItems.create', [
            'mode' => 'create',
            'payrollItem' => new PayrollItem(),
            'types' => $types,

        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('uploads', 'public');
        }
        PayrollItem::create($data);
        return redirect()->route('payrollItems.index')->with('success', 'Successfully created!');
    }

    public function show(PayrollItem $payrollItem)
    {
        return view('pages.payrollItems.view', compact('payrollItem'));
    }

    public function edit(PayrollItem $payrollItem)
    {
        $types = \App\Models\Type::all();

        return view('pages.payrollItems.edit', [
            'mode' => 'edit',
            'payrollItem' => $payrollItem,
            'types' => $types,

        ]);
    }

    public function update(Request $request, PayrollItem $payrollItem)
    {
        $data = $request->all();
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('uploads', 'public');
        }
        $payrollItem->update($data);
        return redirect()->route('payrollItems.index')->with('success', 'Successfully updated!');
    }

    public function destroy(PayrollItem $payrollItem)
    {
        $payrollItem->delete();
        return redirect()->route('payrollItems.index')->with('success', 'Successfully deleted!');
    }
}