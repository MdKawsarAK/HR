<?php

namespace App\Http\Controllers;

use App\Models\payroll\PayrollItem;
use Illuminate\Http\Request;
use App\Models\Type;


class PayrollitemController extends Controller
{
    public function index()
    {
        $payrollitems = Payrollitem::orderBy('id','desc')->paginate(10);
        return view('pages.payrollitems.index', compact('payrollitems'));
    }

    public function create()
    {
        $types = \App\Models\Type::all();

        return view('pages.payrollitems.create', [
            'mode' => 'create',
            'payrollitem' => new Payrollitem(),
            'types' => $types,

        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('uploads', 'public');
        }
        Payrollitem::create($data);
        return redirect()->route('pages.payrollitems.index')->with('success', 'Successfully created!');
    }

    public function show(Payrollitem $payrollitem)
    {
        return view('pages.payrollitems.view', compact('payrollitem'));
    }

    public function edit(Payrollitem $payrollitem)
    {
        $types = \App\Models\Type::all();

        return view('pages.payrollitems.edit', [
            'mode' => 'edit',
            'payrollitem' => $payrollitem,
            'types' => $types,

        ]);
    }

    public function update(Request $request, Payrollitem $payrollitem)
    {
        $data = $request->all();
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('uploads', 'public');
        }
        $payrollitem->update($data);
        return redirect()->route('pages.payrollitems.index')->with('success', 'Successfully updated!');
    }

    public function destroy(Payrollitem $payrollitem)
    {
        $payrollitem->delete();
        return redirect()->route('pages.payrollitems.index')->with('success', 'Successfully deleted!');
    }
}